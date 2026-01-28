<?php

namespace App\PaymentGateway\Gateways;

use App\PaymentGateway\PaymentGatewayBase;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class AcledaPay extends PaymentGatewayBase
{
    protected $merchant_id;
    protected $api_key;
    protected $login_id;
    protected $password;
    protected $is_sandbox = true;

    public function __construct()
    {
        // Configuration can be loaded here if needed
    }

    public function setMerchantId($merchant_id)
    {
        $this->merchant_id = $merchant_id;
        return $this;
    }

    public function setApiKey($api_key)
    {
        $this->api_key = $api_key;
        return $this;
    }

    public function setLoginId($login_id)
    {
        $this->login_id = $login_id;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setEnv($is_sandbox)
    {
        $this->is_sandbox = (bool) $is_sandbox;
        return $this;
    }

    public function gateway_name()
    {
        return 'acledapay';
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

    public function charge_customer($args)
    {
        if ($args['amount'] < 1) {
            abort(500, __('Minimum payable amount is 1'));
        }

        $client = new Client();
        $charge_amount = number_format((float)$args['amount'], 2, '.', '');
        $order_id = $args['payment_track'] ?? 'ORDER-' . time();
        $currency = $this->charge_currency();
        $base_url = $this->is_sandbox ? 'https://epaymentuat.acledabank.com.kh' : 'https://epayment.acledabank.com.kh';
        $txid = substr($order_id, 0, 16);
        $hash_message = $this->merchant_id . $this->login_id . $this->password . $txid;
        $hash = strtoupper(hash_hmac('sha512', $hash_message, $this->api_key));

        $sessionRequest = [
            'loginId' => $this->login_id,
            'password' => $this->password,
            'merchantID' => $this->merchant_id,
            'hash' => $hash,
            'xpayTransaction' => [
                'txid' => $txid,
                'purchaseAmount' => $charge_amount,
                'purchaseCurrency' => $currency,
                'purchaseDate' => gmdate('d-m-Y'),
                'purchaseDesc' => $args['description'] ?? 'Transaction',
                'invoiceid' => $txid,
                'item' => 1,
                'quantity' => 1,
                'expiryTime' => 5,
                'paymentCard' => 1,
            ]
        ];

        $response = $client->post($base_url . '/SOMBOKCHAB/XPAYConnectorServiceInterfaceImplV2/XPAYConnectorServiceInterfaceImplV2RS/openSessionV2', [
            'json' => $sessionRequest
        ]);

        $sessionResponse = json_decode($response->getBody(), true);
        if ($sessionResponse['result']['code'] !== 0) {
            abort(500, __('Failed to initiate transaction'));
        }

        $session_id = $sessionResponse['result']['sessionid'];
        $payment_token = $sessionResponse['result']['xTran']['paymentTokenid'];

        $payway_endpoint = $base_url . '/SOMBOKCHAB/paymentPage.jsp';
        $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Redirecting...</title></head><body onload="document.forms[0].submit();">';
        $html .= '<form action="' . $payway_endpoint . '" method="POST">';

        $payload = [
            'merchantID' => $this->merchant_id,
            'sessionid' => $session_id,
            'paymenttokenid' => $payment_token,
            'description' => $args['description'] ?? 'Transaction',
            'expirytime' => 5,
            'amount' => $charge_amount,
            'quantity' => 1,
            'item' => 1,
            'invoiceid' => $txid,
            'currencytype' => $currency,
            'transactionID' => $txid,
            'successUrlToReturn' => $args['ipn_url'],
            'errorUrl' => $args['cancel_url']
        ];

        foreach ($payload as $key => $value) {
            $html .= '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '"/>';
        }

        $html .= '</form><p>Redirecting to ACLEDA Pay...</p></body></html>';
        return response($html);
    }

    public function ipn_response(array $args = [])
    {
        $status = $args['_paymentresult'] ?? null;
        $transaction_id = $args['_transactionid'] ?? null;
        $result_code = $args['_resultCode'] ?? null;

        if ($status === 'SUCCESS' && $result_code == 0) {
            return $this->verified_data([
                'transaction_id' => $transaction_id,
                'status' => 'completed'
            ]);
        }

        return $this->verified_data([
            'status' => 'failed'
        ]);
    }
}
