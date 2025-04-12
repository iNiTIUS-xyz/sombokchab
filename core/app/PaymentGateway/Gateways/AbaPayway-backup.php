<?php

namespace App\PaymentGateway\Gateways;

use App\PaymentGateway\PaymentGatewayBase;
use Illuminate\Support\Facades\Session;

class AbaPayway extends PaymentGatewayBase
{
    protected $merchant_id;
    protected $api_key;
    
    /**
     * ABA PayWay constructor
     * (No official PHP SDK like PayPal, so we won't do an ApiContext here.)
     */
    public function __construct()
    {
        // If you need to load config from a file, do it here.
        // e.g., $this->merchant_id = config('payway.merchant_id');
        // or just let user set via setter methods.
    }

    /**
     * Set Merchant ID
     */
    public function setMerchantId($merchant_id)
    {
        $this->merchant_id = $merchant_id;
        return $this;
    }

    /**
     * Set API Key (Hash Key)
     */
    public function setApiKey($api_key)
    {
        $this->api_key = $api_key;
        return $this;
    }

    /**
     * Return the gateway name
     */
    public function gateway_name()
    {
        return 'abapayway';
    }

    /**
     * Decide the currency to use (similar to PayPal)
     */
    public function charge_currency()
    {
        if (in_array(self::global_currency(), $this->supported_currency_list())) {
            return self::global_currency();
        }
        return "USD";
    }

    /**
     * Format the amount
     */
    public function charge_amount($amount)
    {
        // If your global currency is supported, return as-is
        if (in_array(self::global_currency(), $this->supported_currency_list())) {
            return $amount;
        }
        // Otherwise convert to USD (or something else) if you have that logic
        return self::get_amount_in_usd($amount);
    }

    /**
     * List of supported currencies
     */
    public function supported_currency_list()
    {
        // According to PayWay, typically "USD" and "KHR".
        // Add more if their docs say so.
        return ['USD', 'KHR'];
    }

    /**
     * Charge Customer
     *
     * @param array $args
     *  - amount
     *  - description
     *  - item_name
     *  - ipn_url (where user is returned after payment or callback)
     *  - cancel_url (where to go if user cancels)
     *  - payment_track (an ID you store in session)
     *  - anything else you need
     * @return string (a redirect URL)
     */
    public function charge_customer($args)
{
    if ($args['amount'] < 1) {
        abort(500, __('minimum payable amount is 1'));
    }

    // Prepare all your payload logic as before...
    $currency       = $this->charge_currency();
    $charge_amount  = $this->charge_amount($args['amount']);
    $merchantId     = $this->merchant_id;
    $apiKey         = $this->api_key;
    $order_id       = $args['payment_track'] ?? 'ORDER-'.time();

    $payload = [
        'merchant_id' => $merchantId,
        'order_id'    => $order_id,
        'amount'      => $charge_amount,
        'currency'    => $currency,
        'return_url'  => $args['ipn_url'],
        'cancel_url'  => $args['cancel_url'],
    ];

    // Generate signature
    $signature_string = $merchantId.$order_id.$charge_amount.$currency.$apiKey;
    $signature = hash('sha256', $signature_string);
    $payload['signature'] = $signature;

    // Store in session if needed
    Session::put('abapayway_payment_id', $order_id);
    Session::put('abapayway_track', $order_id);

    // Decide endpoint
    $payway_endpoint = $this->env 
        ? 'https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/purchase'
        : 'https://checkout.payway.com.kh/api/payment-gateway/v1/payments/purchase';

    // Build HTML with a form that auto-submits:
    $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Redirecting...</title></head><body onload="document.forms[0].submit();">';
    $html .= '<form action="'.$payway_endpoint.'" method="POST">';

    foreach ($payload as $key => $value) {
        $html .= '<input type="hidden" name="'.htmlspecialchars($key).'" value="'.htmlspecialchars($value).'"/>';
    }

    $html .= '</form><p>Redirecting to ABA PayWay...</p></body></html>';

    // Return this HTML as a response
    return response($html);
}


    /**
     * IPN Response
     *
     * @param array $args
     *   - request => the HTTP request
     *   - cancel_url => where to redirect if something fails
     *   - success_url => optional success redirect
     * @return mixed
     */
    public function ipn_response($args)
    {
        // 1) Retrieve data from session
        $payment_id = Session::get('abapayway_payment_id');
        $payway_track = Session::get('abapayway_track');

        // 2) Clear session
        Session::forget(['abapayway_payment_id','abapayway_track']);

        // 3) Get request data
        $request = $args['request'];
        // Typically, PayWay will send back 'order_id', 'status', 'signature', etc.
        $status         = $request->get('status');         // e.g. "success"
        $receivedSig    = $request->get('signature');
        $returnedOrder  = $request->get('order_id');
        $transaction_id = $request->get('transaction_id'); // if provided

        // 4) Re-build the signature for verification
        // Typically: merchant_id + order_id + status + apiKey
        $sig_str = $this->merchant_id.$returnedOrder.$status.$this->api_key;
        $calcSig = hash('sha256', $sig_str);

        // 5) Check signature
        if ($calcSig !== $receivedSig) {
            // Signature mismatch => potential fraud
            return redirect()->to($args['cancel_url']);
        }

        // 6) Check status
        if ($status === 'success') {
            // Payment completed
            return $this->verified_data([
                'transaction_id' => $transaction_id ?? $payment_id,
            ]);
        }

        // Payment canceled or failed
        return redirect()->to($args['cancel_url']);
    }
}