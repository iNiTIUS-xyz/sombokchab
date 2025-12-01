<?php

namespace Modules\Order\Traits;

use Log;
use Str;
use Hash;
use Crypt;
use stdClass;
use Exception;
use Modules\User\Entities\User;
use App\Http\Services\Commission;
use Modules\Order\Entities\Order;
use App\Action\RegistrationAction;
use Illuminate\Support\Facades\DB;
use Modules\Order\Entities\SubOrder;
use Modules\Order\Entities\OrderTrack;
use Modules\Order\Entities\OrderAddress;
use Gloudemans\Shoppingcart\Facades\Cart;
use Modules\Order\Services\ApiCartServices;
use Modules\Order\Services\OrderTaxService;
use Modules\Order\Entities\OrderPaymentMeta;
use Modules\Order\Entities\SubOrderCommission;
use Modules\TaxModule\Entities\TaxClassOption;
use Modules\Wallet\Http\Services\WalletService;
use Modules\Order\Services\CheckoutCouponService;
use Modules\Order\Services\PaymentGatewayService;
use Modules\Order\Services\OrderShippingChargeService;
use Modules\TaxModule\Services\CalculateTaxBasedOnCustomerAddress;
use Modules\Inventory\Http\Services\Frontend\FrontendInventoryService;

trait OrderTrait
{
    use StoreOrderTrait, OrderMailTrait;

    protected static function cartInstanceName(): string
    {
        return "default";
    }

    public static function groupByColumn(): string
    {
        return "options.vendor_id";
    }

    protected static function isVendorMailable(): bool
    {
        return true;
    }

    protected static function isAdminMailable(): bool
    {
        return true;
    }

    protected static function isUserMailable(): bool
    {
        return true;
    }

    protected static function isMailSendWithQueue(): bool
    {
        return true;
    }

    protected static function groupByCartContent($cartContent)
    {
        return $cartContent->groupBy(self::groupByColumn());
    }

    private static function cartContent($request = null, $type = null)
    {
        if ($type == 'pos') {
            return Cart::instance(self::cartInstanceName())->content();
        }
        return (is_null($type) || is_null($request)) ? Cart::instance(self::cartInstanceName())->content() : ApiCartServices::prepareRequestDataForCartContent($request);
    }

    protected static function orderProcess($request, $type = null): array
    {

        $cartContent = self::cartContent($request, $type);
        $groupedData = self::groupByCartContent($cartContent);

        $total_amount = 0;
        $shippingTaxClass = new stdClass();

        if ($type != 'pos') {

            $shippingTaxClass = TaxClassOption::where("class_id", get_static_option("shipping_tax_class"))->sum("rate");
            $shippingCost = OrderShippingChargeService::getShippingCharge($request["shipping_cost"]);

            $shippingCostTemp = 0;

            foreach ($shippingCost["vendor"] ?? [] as $s_cost) {
                $shippingCostTemp += calculatePrice($s_cost->cost, $shippingTaxClass, "shipping");
            }

            $shippingCostTemp += calculatePrice($shippingCost["admin"]?->cost ?? 0, $shippingTaxClass, "shipping") ?? 0;

            $totalShippingCharge = $shippingCostTemp;
        } else {

            $shippingTaxClass = TaxClassOption::where("class_id", get_static_option("shipping_tax_class"))->sum("rate");
            $shippingCost = OrderShippingChargeService::getShippingCharge($request["shipping_cost"]);
            $shippingCostTemp = 0;

            foreach ($shippingCost["vendor"] ?? [] as $s_cost) {
                $shippingCostTemp += calculatePrice($s_cost->cost, $shippingTaxClass, "shipping");
            }

            $shippingCostTemp += calculatePrice($shippingCost["admin"]?->cost ?? 0, $shippingTaxClass, "shipping") ?? 0;

            $totalShippingCharge = $shippingCostTemp;
        }

        $order = self::storeOrder($request, $type);

        $uniqueNumber = self::uniqueOrderNumber($order->id);

        if ($type != 'pos') {
            $orderAddress = self::storeOrderShippingAddress($request, $order->id);
        } else {
            $orderAddress = self::storeOrderShippingAddress($request->validated(), $order->id);
        }

        self::storeOrderTrack($order->id, "ordered", auth('web')?->user()?->id ?? 0, 'users');

        $taxPercentage = $type == 'pos' ? get_static_option("default_shopping_tax") :
            (int) OrderTaxService::taxAmount($orderAddress->country_id, $orderAddress->state_id ?? null, $orderAddress->city ?? null);

        $tax = CalculateTaxBasedOnCustomerAddress::init();
        $uniqueProductIds = $cartContent->pluck("id")->unique()->toArray();

        $price_type = "";
        $taxProducts = collect([]);
        if (CalculateTaxBasedOnCustomerAddress::is_eligible()) {
            $taxProducts = $tax
                ->productIds($uniqueProductIds)
                ->customerAddress(
                    ($type == "pos" ? get_static_option("pos_tax_country") : $request['country_id']),
                    ($type == "pos" ? get_static_option("pos_tax_state") : $request['state_id'] ?? null),
                    ($type == "pos" ? get_static_option("pos_tax_city") : $request['city'] ?? null)
                )->generate();

            $price_type = "billing_address";
        } elseif (CalculateTaxBasedOnCustomerAddress::is_eligible_inclusive()) {
            $price_type = "inclusive_price";
        } else {
            $price_type = "zone_wise_tax";
        }

        $totalTaxAmount = 0;

        foreach ($groupedData as $key => $data) {
            $subOrderTotal = 0;

            $vendor_id = $key;

            $subOrderShippingCost = $totalShippingCharge;

            $orderItem = [];
            $orderTotalAmount = 0;
            $subOrderTaxAmount = 0;

            foreach ($data as $cart) {
                // $variantId = $cart->options['variant_id'] ?? null;
                $variantId = $cart->options->variant_id ?? null;

                $total_amount += $cart->price * $cart->qty;
                $orderTotalAmount += $cart->price * $cart->qty;
                $subOrderTotal += $cart->price * $cart->qty;

                // check a data type here
                if (is_object($cart->options)) {
                    $cart->options = (array) $cart->options;
                }

                $cart->options['vendor_id'] = $key;

                if ($price_type == "billing_address" && $taxProducts->isNotEmpty()) {
                    $taxAmount = $taxProducts->find($cart->id) ?? (object) [];
                    $taxAmount = calculateOrderedPrice($cart->price, $taxAmount->tax_options_sum_rate ?? 0, $price_type);
                } elseif ($price_type == "inclusive_price") {
                    $taxAmount = calculateOrderedPrice($cart->price, $cart->options['tax_options_sum_rate'] ?? 0, $price_type);
                } else {
                    $taxAmount = 0;
                }

                $orderItem[] = [
                    "sub_order_id" => 0,
                    "order_id" => $order->id,
                    "product_id" => (int) $cart->id,
                    "variant_id" => $variantId ?? null,
                    "quantity" => (int) $cart->qty,
                    "price" => $cart->price,
                    "sale_price" => $cart->options['regular_price'] ?? 0,
                    "tax_amount" => $taxAmount,
                    "tax_type" => $price_type,
                ];

                if ($price_type == "inclusive_price") {
                    $subOrderTaxAmount = 0;
                } elseif ($price_type == "billing_address") {
                    $subOrderTaxAmount += $taxAmount * (int) $cart->qty;
                }

                $totalTaxAmount += $taxAmount * (int) $cart->qty;
            }

            if ($price_type != "billing_address" && $price_type != "inclusive_price") {
                $subOrderTaxAmount = $orderTotalAmount * $taxPercentage / 100;
            }

            $vendor_id = $vendor_id == "admin" ? null : $vendor_id;

            $subOrder = self::storeSubOrder($order->id, $vendor_id, $subOrderTotal, $subOrderShippingCost, $subOrderTaxAmount, $price_type, $orderAddress->id ?? null);

            self::createSubOrderCommission($subOrderTotal, $subOrder->id, $vendor_id);

            for ($i = 0, $length = count($orderItem ?? []); $i < $length; $i++) {
                $orderItem[$i]["sub_order_id"] = $subOrder->id;
            }

            self::storeSubOrderItem($orderItem);
        }

        $coupon_amount = CheckoutCouponService::calculateCoupon((object) $request, $total_amount, $cartContent, 'DISCOUNT');
        $orderSubTotal = ($total_amount - $coupon_amount);

        if ($price_type == "zone_wise_tax") {
            $totalTaxAmount = ($orderSubTotal * $taxPercentage) / 100;
        }

        $tShippingCharge = SubOrder::query()
            ->where('order_id', $order->id)
            ->sum('shipping_cost');

        $finalAmount = $orderSubTotal + $totalTaxAmount + $tShippingCharge;

        $orderPaymentMeta = self::storePaymentMeta($order->id, $total_amount, $coupon_amount, $tShippingCharge, $totalTaxAmount, $finalAmount);

        if (($request['payment_gateway'] == 'Wallet' && auth('web')->check()) && moduleExists("Wallet")) {
            WalletService::updateUserWallet(auth('web')->user()?->id, $finalAmount, false, 'balance', $order->id, checkBalance: true);
        }

        FrontendInventoryService::updateInventory($order->id);

        return $orderPaymentMeta ? [
            "success" => true,
            "type" => "success",
            "order_id" => $order->id,
            "total_amount" => $finalAmount,
            "tested" => encrypt($order->payment_status),
            "secrete_key" => Hash::make($order->transaction_id),
            "invoice_number" => $order->invoice_number,
            "invoice_number" => $order->invoice_number,
            "created_at" => $order->created_at->format("Y-m-d H:i:s"),
        ] : [
            "success" => false,
            "type" => "danger",
            "order_id" => null,
        ];
    }

    private static function createSubOrderCommission($sub_total, $sub_order_id, $vendor_id)
    {
        $commission = Commission::get($sub_total, $vendor_id);

        return SubOrderCommission::create($commission + [
            "sub_order_id" => $sub_order_id,
            "vendor_id" => $vendor_id ? $vendor_id : null,
        ]);
    }

    public static function sendOrder($request)
    {
        //
    }

    public static function testOrder($request, $type = null)
    {
        $order_process = self::orderProcess($request, $type);
        if ($type != 'pos') {
            if (isset($request['create_account']) && $request['create_account']) {
                $registration_action = new RegistrationAction();
                $user = $registration_action->createUser($request);
                $user_id = optional($user)->id;

                if (isset($order_process['order_id'])) {
                    $order_data = Order::find($order_process['order_id']);

                    if (!empty($order_data)) {

                        $order_data->update([
                            'user_id' => $user_id,
                        ]);
                    }
                }
            }
            if ($request["payment_gateway"] == 'cash_on_delivery') {

                self::sendOrderMail(order_process: $order_process, request: $request);
                WalletService::updateWallet($order_process["order_id"]);

                Cart::instance(self::cartInstanceName())->destroy();
            } elseif ($request["payment_gateway"] == 'manual_payment') {

                self::sendOrderMail(order_process: $order_process, request: $request);
                WalletService::updateWallet($order_process["order_id"]);

                Cart::instance(self::cartInstanceName())->destroy();
            } elseif ($request["payment_gateway"] == 'Wallet') {

                self::sendOrderMail(order_process: $order_process, request: $request);
                WalletService::updateWallet($order_process["order_id"]);

                Cart::instance(self::cartInstanceName())->destroy();
            } else {

                Cart::instance(self::cartInstanceName())->destroy();

                return (new PaymentGatewayService)->payment_with_gateway($request['payment_gateway'], $request, $order_process["order_id"], number_format($order_process['total_amount'], 2));
            }
        } else {

            if (!empty($request->selected_customer ?? '') && $request->send_email == 'on') {
                self::sendOrderMail(order_process: $order_process, request: $request, type: 'pos');
            }

            WalletService::updateWallet($order_process["order_id"]);
            //todo:: add order amount from pending balance to main balance
            WalletService::completeOrderAmount($order_process["order_id"]);
            //todo:: add wallet history that mean's transaction history

            //todo:: now update into database
            Order::where("id", $order_process["order_id"])->update([
                "order_status" => 'complete',
                "payment_status" => 'complete',
            ]);

            OrderTrack::insert([
                ['order_id' => $order_process["order_id"], 'updated_by' => auth("admin")->id(), 'table' => 'admin', 'name' => 'picked_by_courier'],
                ['order_id' => $order_process["order_id"], 'updated_by' => auth("admin")->id(), 'table' => 'admin', 'name' => 'on_the_way'],
                ['order_id' => $order_process["order_id"], 'updated_by' => auth("admin")->id(), 'table' => 'admin', 'name' => 'ready_for_pickup'],
                ['order_id' => $order_process["order_id"], 'updated_by' => auth("admin")->id(), 'table' => 'admin', 'name' => 'delivered'],
            ]);

            DB::commit();
            Cart::instance(self::cartInstanceName())->destroy();

            $selectedCustomer = User::with("userCountry", "userState", "userCity")->find($request->selected_customer ?? 0);
            if ($order_process["order_id"]) {
                return response()->json([
                    "msg" => __("Purchase complete"),
                    "type" => "success",
                    "order_details" => [
                        "site_info" => [
                            "name" => get_static_option("site_title"),
                            "email" => get_static_option("site_global_email"),
                            "website" => env("app_url"),
                        ],
                        "customer" => [
                            "name" => $request->selected_customer ? $selectedCustomer->name : __("Walk in customer"),
                            "phone" => $request->selected_customer ? $selectedCustomer->phone : "No Number",
                            "email" => $request->selected_customer ? $selectedCustomer->email : null,
                            "country" => $request->selected_customer ? $selectedCustomer?->userCountry?->name ?? "" : null,
                            "state" => $request->selected_customer ? $selectedCustomer?->userState?->name ?? "" : null,
                            "city" => $request->selected_customer ? $selectedCustomer?->userCity?->name ?? "" : null,
                            "address" => $request->selected_customer ? $selectedCustomer?->address ?? "" : null,
                        ],
                        "invoice_number" => $order_process['invoice_number'],
                        "date" => $order_process["created_at"],
                        "order_id" => $order_process['order_id'],
                    ],
                ]);
            } else {
                return response()->json([
                    "msg" => __("Purchase failed"),
                    "type" => "error",
                    "order_details" => [],
                ]);
            }
        }

        return redirect()->route('frontend.order.payment.success', $order_process['order_id']);
    }

    public static function apiOrder($request): mixed
    {
        Log::info("api order", $request);

        $order = self::orderProcess($request, "api");

        if ($order["success"]) {
            OrderAddress::where("order_id", $order["order_id"])->first();
        }

        if ($request["payment_gateway"] == 'cash_on_delivery') {

            self::sendOrderMail(order_process: $order, request: $request);

            WalletService::updateWallet($order["order_id"]);
        } elseif ($request["payment_gateway"] == 'paytm') {
            return (new PaymentGatewayService)->payment_with_gateway($request['payment_gateway'], $request, $order["order_id"], round($order['total_amount'], 0));
        } elseif ($request["payment_gateway"] == 'manual_payment') {
            if ($request['transaction_attachment'] ?? false) {
                $image = request()->file('transaction_attachment');
                $image_extension = $image->extension();
                $image_name_with_ext = $image->getClientOriginalName();

                $image_name = pathinfo($image_name_with_ext, PATHINFO_FILENAME);
                $image_name = strtolower(Str::slug($image_name));
                $image_db = $image_name . time() . '.' . $image_extension;

                $path = 'assets/uploads/payment_attachments/';
                $image->move($path, $image_db);

                OrderPaymentMeta::where("order_id", $order["order_id"])->update([
                    "payment_attachments" => $image_db,
                ]);
            }

            self::sendOrderMail(order_process: $order, request: $request);
            WalletService::updateWallet($order["order_id"]);
        }

        return $order + ["hash" => \Hash::make(json_encode($order)), "hash-two" => Crypt::encryptString(json_encode($order))];
    }

    protected static function prepareOrderForVendor($vendor_id, $order_id, $total_amount, $shipping_cost, $tax_amount, $order_address_id): array
    {
        return [
            "order_id" => $order_id,
            "vendor_id" => $vendor_id,
            "total_amount" => $total_amount,
            "shipping_cost" => $shipping_cost,
            "tax_amount" => $tax_amount,
            "order_address_id" => $order_address_id,
        ];
    }
    protected static function prepareOrderForAdmin($sub_order_id, $order_id, $product_id, $variant_id, $quantity, $price, $sale_price): array
    {
        return [
            "sub_order_id" => $sub_order_id,
            "order_id" => $order_id,
            "product_id" => $product_id,
            "variant_id" => $variant_id,
            "quantity" => $quantity,
            "price" => $price,
            "sale_price" => $sale_price,
        ];
    }
}
