<?php

namespace App\PaymentGateway\Gateways;

use App\PaymentGateway\PaymentGatewayBase;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AbaPayway extends PaymentGatewayBase
{
    protected $merchant_id;
    protected $api_key;
    protected $env = true; // true => sandbox, false => production

    public function __construct()
    {
        // If needed, load config here:
        // $this->merchant_id = config('payway.merchant_id');
        // $this->api_key = config('payway.api_key');
        // $this->env = config('payway.sandbox_mode') ? true : false;
    }

    /**
     * Set Merchant ID
     */
    public function setMerchantId($merchant_id)
    {
        $this->merchant_id = trim($merchant_id);
        return $this;
    }

    /**
     * Set API Key (the "public_key" from docs)
     */
    public function setApiKey($api_key)
    {
        $this->api_key = trim($api_key);
        return $this;
    }

    /**
     * Return the Gateway Name
     */
    public function gateway_name()
    {
        return 'abapayway';
    }

    /**
     * Decide the currency to use (if you have a global system).
     */
    public function charge_currency()
    {
        // If your global currency is in the list, use it; else fallback to USD
        if (in_array(self::global_currency(), $this->supported_currency_list())) {
            return self::global_currency();
        }
        return 'USD';
    }

    /**
     * Format or convert the amount if needed
     */
    public function charge_amount($amount)
    {
        if (in_array(self::global_currency(), $this->supported_currency_list())) {
            return number_format((float) $amount, 2, '.', '');
        }
        return number_format((float) self::get_amount_in_usd($amount), 2, '.', '');
    }

    public function supported_currency_list()
    {
        return ['USD', 'KHR'];
    }

    public function charge_customer($args)
    {
        // 1) Basic validations
        if (! isset($args['amount']) || $args['amount'] < 0.01) {
            abort(400, 'Invalid or missing amount');
        }

        // 2) Prepare mandatory fields
        $req_time    = gmdate('YmdHis'); // in UTC, e.g. "20230403121059"
        $merchant_id = $this->merchant_id;
        $tran_id     = $args['tran_id'] ?? ('TXN-' . time());
        $amount      = $this->charge_amount($args['amount']);
        $currency    = $args['currency'] ?? $this->charge_currency();

        // 3) Prepare optional fields (some might be empty)
        $firstname             = $args['firstname'] ?? '';
        $lastname              = $args['lastname'] ?? '';
        $email                 = $args['email'] ?? '';
        $phone                 = $args['phone'] ?? '';
        $type                  = $args['type'] ?? 'purchase';   // "purchase" or "pre-auth"
        $payment_option        = $args['payment_option'] ?? ''; // "cards", "abapay", etc.
        $return_url            = 'aHR0cHM6Ly9zb21ib2tjaGFiLmNvbS9hYmEtcGF5d2F5LWlwbg==';
        // $return_url            = $args['return_url'] ?? 'aHR0cHM6Ly9zb21ib2tjaGFiLmNvbS9hYmEtcGF5d2F5LWlwbg==';
        $cancel_url            = $args['cancel_url'] ?? 'https://sombokchab.com';
        $continue_success_url  = $args['continue_success_url'] ?? '';
        $return_deeplink       = $args['return_deeplink'] ?? '';
        $shipping              = $args['shipping'] ?? ''; // numeric
        $items_array           = $args['items'] ?? [];    // array => will be JSON => base64
        $items                 = base64_encode(json_encode($items_array));
        $custom_fields_obj     = $args['custom_fields'] ?? [];
        $custom_fields         = base64_encode(json_encode($custom_fields_obj));
        $return_params_obj     = $args['return_params'] ?? [];
        $return_params         = base64_encode(json_encode($return_params_obj));
        $payout_obj            = $args['payout'] ?? [];
        $payout                = base64_encode(json_encode($payout_obj));
        $lifetime              = $args['lifetime'] ?? ''; // in minutes
        $additional_params_obj = $args['additional_params'] ?? [];
        $additional_params     = base64_encode(json_encode($additional_params_obj));
        $google_pay_token      = $args['google_pay_token'] ?? '';

        // 4) Build the HMAC "base string" in EXACT order from docs
        $b4hash = $req_time
            . $merchant_id
            . $tran_id
            . $amount
            . $items
            . $shipping
            . $firstname
            . $lastname
            . $email
            . $phone
            . $type
            . $payment_option
            . $return_url
            . $cancel_url
            . $continue_success_url
            . $return_deeplink
            . $currency
            . $custom_fields
            . $return_params
            . $payout
            . $lifetime
            . $additional_params
            . $google_pay_token;

        // 5) Compute HMAC-SHA512, then base64-encode
        // Docs say: $hash = base64_encode(hash_hmac('sha512', $b4hash, $api_key, true));
        $hash = base64_encode(
            hash_hmac('sha512', $b4hash, $this->api_key, true)
        );

        // 6) Build the final payload array
        // Everything in the doc is multipart/form-data; we’ll do hidden inputs for an HTML form
        $payload = [
            'req_time'             => $req_time,
            'merchant_id'          => $merchant_id,
            'tran_id'              => $tran_id,
            'firstname'            => $firstname,
            'lastname'             => $lastname,
            'email'                => $email,
            'phone'                => $phone,
            'type'                 => $type,
            'payment_option'       => $payment_option,
            'items'                => $items, // base64-encoded JSON
            'shipping'             => $shipping,
            'amount'               => $amount,
            'currency'             => $currency,
            'return_url'           => $return_url,
            'cancel_url'           => $cancel_url,
            'continue_success_url' => $continue_success_url,
            'return_deeplink'      => $return_deeplink,
            'custom_fields'        => $custom_fields,
            'return_params'        => $return_params,
            'view_type'            => $args['view_type'] ?? '', // optional: "hosted_view"/"popup"
            'payout'               => $payout,
            'lifetime'             => $lifetime,
            'additional_params'    => $additional_params,
            'google_pay_token'     => $google_pay_token,
            'hash'                 => $hash, // required
        ];

        // 7) Log the hash details for debugging “Wrong Hash” errors
        Log::info('[ABA PayWay] Payload Data:', $payload);
        Log::info('[ABA PayWay] b4hash = ' . $b4hash);
        Log::info('[ABA PayWay] Computed hash = ' . $hash);

        // 8) Store relevant data in session if you want (tran_id, etc.)
        Session::put('abapayway_tran_id', $tran_id);

        // 9) Endpoint
        $endpoint = $this->env
            ? 'https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/purchase'
            : 'https://checkout.payway.com.kh/api/payment-gateway/v1/payments/purchase';

        // 10) Build an HTML form that posts as multipart/form-data
        $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Redirecting...</title></head>'
            . '<body onload="document.forms[0].submit();">'
            . '<form action="' . $endpoint . '" method="POST" enctype="multipart/form-data">';

        foreach ($payload as $key => $value) {
            // Convert all to strings, ensuring no array types
            $val = is_scalar($value) ? (string) $value : '';
            $html .= '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($val) . '">';
        }

        $html .= '</form><p>Redirecting to ABA PayWay...</p></body></html>';

        return response($html);
    }

    /**
     * Optional IPN/Callback Handler
     *
     * The new docs do not clearly specify how (or if) PayWay sends an IPN
     * signature for verification. You might rely on 'return_url' or
     * 'continue_success_url' in the request above. If there's a separate
     * doc for verifying the callback, implement it here.
     */
    public function ipn_response($args = [])
    {
        Log::info('[ABA PayWay] IPN Response:', $args);
        // This part is speculative, as the new docs do not show an IPN signature.
        // Adjust to your use case. Typically you'd read:
        // - $request = $args['request'] ?? request();
        // - Check some status field, transaction ID, etc.
        // - Possibly compare with your session or database to confirm success.
        return 'Not implemented (depends on official callback spec).';
    }
}
