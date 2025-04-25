<?php

namespace App\Helpers;

use App\PaymentGateway;
use Xgenious\Paymentgateway\Facades\XgPaymentGateway;

class PaymentGatewayCredential
{
    public static function site_global_currency(){
        return  get_static_option('site_global_currency');
    }

    public static function exchange_rate_usd_to_usd(){
        $global_currency = get_static_option('site_global_currency');
        $usd_exchange_rate = get_static_option('site_' . strtolower($global_currency) . '_to_usd_exchange_rate');
        $checked_currency_rate = empty($usd_exchange_rate) ? 83 : $usd_exchange_rate;
        return $checked_currency_rate;
    }

    public static function exchange_rate_usd_to_inr(){

        $global_currency = get_static_option('site_global_currency');
        $inr_exchange_rate = get_static_option('site_' . strtolower($global_currency) . '_to_inr_exchange_rate');
        $checked_currency_rate = empty($inr_exchange_rate) ? 83 : $inr_exchange_rate;
        return $checked_currency_rate;
    }

    public static function exchange_rate_usd_to_ngn(){
        $global_currency = get_static_option('site_global_currency');
        $ngn_exchange_rate = get_static_option('site_' . strtolower($global_currency) . '_to_ngn_exchange_rate');
        $checked_currency_rate = empty($ngn_exchange_rate) ? 83 : $ngn_exchange_rate;
        return $checked_currency_rate;
    }

    public static function exchange_rate_usd_to_idr(){
        $global_currency = get_static_option('site_global_currency') ?? "IDR";
        $idr_exchange_rate = get_static_option('site_' . strtolower($global_currency) . '_to_idr_exchange_rate');
        $checked_currency_rate = empty($idr_exchange_rate) ? 83 : $idr_exchange_rate;
        return $checked_currency_rate;
    }

    public static function exchange_rate_usd_to_zar(){
        return get_static_option('site_usd_to_zar_exchange_rate');
    }

    public static function exchange_rate_usd_to_brl(){
        $global_currency = get_static_option('site_global_currency');
        $brl_exchange_rate = get_static_option('site_' . strtolower($global_currency) . '_to_brl_exchange_rate');
        $checked_currency_rate = empty($brl_exchange_rate) ? 83 : $brl_exchange_rate;
        return $checked_currency_rate;
    }

    public static function exchange_rate_usd_to_myr(){
        $global_currency = get_static_option('site_global_currency');
        $myr_exchange_rate = get_static_option('site_' . strtolower($global_currency) . '_to_myr_exchange_rate');
        $checked_currency_rate = empty($myr_exchange_rate) ? 83 : $myr_exchange_rate;
        return $checked_currency_rate;
    }


    public static function get_paypal_credential() : object
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'paypal')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);
        $mode = $paypal_credential_from_database->test_mode;

        $checked_client_id = $mode == 1 ? $decoded->sandbox_client_id : $decoded->live_client_id;
        $checked_client_secret = $mode == 1 ? $decoded->sandbox_client_secret : $decoded->live_client_secret;
        $checked_app_id = $mode == 1 ? $decoded->sandbox_app_id : $decoded->live_app_id;
        $test_mode = $paypal_credential_from_database->test_mode == 1;

        $paypal = XgPaymentGateway::paypal();
        $paypal->setClientId($checked_client_id);
        $paypal->setClientSecret($checked_client_secret);
        $paypal->setAppId($checked_app_id);
        $paypal->setCurrency(self::site_global_currency());
        $paypal->setEnv($test_mode);
        $paypal->setExchangeRate(self::exchange_rate_usd_to_inr());

        return $paypal;
    }

    public static function get_paytm_credential() : object
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'paytm')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);

        $merchant_id = $decoded->merchant_mid ?? '';
        $merchant_key = $decoded->merchant_key ?? '';
        $merchant_website = $decoded->merchant_website ?? '';
        $channel = $decoded->channel ?? '';
        $industry_type = $decoded->industry_type ?? '';
        $test_mode = $paypal_credential_from_database->test_mode;

        $paytm = XgPaymentGateway::paytm();
        $paytm->setMerchantId($merchant_id);
        $paytm->setMerchantKey($merchant_key);
        $paytm->setMerchantWebsite($merchant_website);
        $paytm->setChannel($channel);
        $paytm->setIndustryType($industry_type);
        $paytm->setCurrency(self::site_global_currency());
        $paytm->setEnv($test_mode);
        $paytm->setExchangeRate(self::exchange_rate_usd_to_inr());

        return $paytm;
    }

    public static function get_stripe_credential() : object
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'stripe')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);

        $public_key = $decoded->public_key ?? '';
        $secret_key = $decoded->secret_key ?? '';
        $test_mode = $paypal_credential_from_database->test_mode;

        $stripe = XgPaymentGateway::stripe();
        $stripe->setSecretKey($secret_key);
        $stripe->setPublicKey($public_key);
        $stripe->setCurrency(self::site_global_currency());
        $stripe->setEnv($test_mode);
        $stripe->setExchangeRate(self::exchange_rate_usd_to_inr());

        return $stripe;
    }

    public static function get_razorpay_credential() : object
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'razorpay')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);

        $api_key = $decoded->api_key ?? '';
        $api_secret = $decoded->api_secret ?? '';
        $test_mode = $paypal_credential_from_database->test_mode;

        $razorpay = XgPaymentGateway::razorpay();
        $razorpay->setApiKey($api_key);
        $razorpay->setApiSecret($api_secret);
        $razorpay->setCurrency(self::site_global_currency());
        $razorpay->setEnv($test_mode);
        $razorpay->setExchangeRate(self::exchange_rate_usd_to_inr());

        return $razorpay;
    }

    public static function get_paystack_credential() : object
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'paystack')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);

        $public_key = $decoded->public_key ?? '';
        $secret_key = $decoded->secret_key ?? '';
        $marchant_email = $decoded->merchant_email ?? '';

        $test_mode = $paypal_credential_from_database->test_mode;

        $paystack = XgPaymentGateway::paystack();
        $paystack->setPublicKey($public_key);
        $paystack->setSecretKey($secret_key);
        $paystack->setMerchantEmail($marchant_email);
        $paystack->setCurrency(self::site_global_currency());
        $paystack->setEnv($test_mode);
        $paystack->setExchangeRate(self::exchange_rate_usd_to_ngn());

        return $paystack;
    }

    public static function get_mollie_credential() : object
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'mollie')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);
        $public_key = $decoded->public_key ?? '';
        $test_mode = $paypal_credential_from_database->test_mode;

        $mollie = XgPaymentGateway::mollie();
        $mollie->setApiKey($public_key);
        $mollie->setCurrency(self::site_global_currency());
        $mollie->setEnv($test_mode);
        $mollie->setExchangeRate(self::exchange_rate_usd_to_inr());

        return $mollie;
    }

    public static function get_flutterwave_credential() : object
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'flutterwave')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);

        $public_key = $decoded->public_key ?? '';
        $secret_key = $decoded->secret_key ?? '';
        $test_mode = $paypal_credential_from_database->test_mode;

        $flutterwave = XgPaymentGateway::flutterwave();
        $flutterwave->setPublicKey($public_key);
        $flutterwave->setSecretKey($secret_key);
        $flutterwave->setCurrency(self::site_global_currency());
        $flutterwave->setEnv($test_mode);
        $flutterwave->setExchangeRate(self::exchange_rate_usd_to_ngn());

        return $flutterwave;
    }

    public static function get_midtrans_credential() : object
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'midtrans')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);

        $server_key = $decoded->server_key ?? '';
        $client_key = $decoded->server_key ?? '';
        $test_mode = $paypal_credential_from_database->test_mode;

        $midtrans = XgPaymentGateway::midtrans();
        $midtrans->setClientKey($client_key);
        $midtrans->setServerKey($server_key);
        $midtrans->setCurrency(self::site_global_currency());
        $midtrans->setEnv($test_mode);
        $midtrans->setExchangeRate(self::exchange_rate_usd_to_idr());

        return $midtrans;
    }

    public static function get_payfast_credential() : object
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'payfast')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);

        $merchant_id = $decoded->merchant_id ?? '';
        $merchant_key = $decoded->merchant_key ?? '';
        $passphrase = $decoded->passphrase ?? '';
        $test_mode = $paypal_credential_from_database->test_mode;

        $payfast = XgPaymentGateway::payfast();
        $payfast->setMerchantId($merchant_id);
        $payfast->setMerchantKey($merchant_key);
        $payfast->setPassphrase($passphrase);
        $payfast->setCurrency(self::site_global_currency());
        $payfast->setEnv($test_mode);
        $payfast->setExchangeRate((float)self::exchange_rate_usd_to_inr());

        return $payfast;
    }

    public static function get_cashfree_credential() : object
    {

        $paypal_credential_from_database = PaymentGateway::where('name', 'cashfree')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);

        $app_id = $decoded->app_id ?? '';
        $secret_key = $decoded->secret_key ?? '';
        $test_mode = $paypal_credential_from_database->test_mode;

        $cashfree = XgPaymentGateway::cashfree();
        $cashfree->setAppId($app_id);
        $cashfree->setSecretKey($secret_key);
        $cashfree->setCurrency(self::site_global_currency());
        $cashfree->setEnv($test_mode);
        $cashfree->setExchangeRate(self::exchange_rate_usd_to_inr());

        return $cashfree;
    }

    public static function get_instamojo_credential() : object
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'instamojo')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);

        $client_id = $decoded->client_id ?? '';
        $client_secret = $decoded->client_secret ?? '';
        $test_mode = $paypal_credential_from_database->test_mode;

        $instamojo = XgPaymentGateway::instamojo();
        $instamojo->setClientId($client_id);
        $instamojo->setSecretKey($client_secret);
        $instamojo->setCurrency(self::site_global_currency());
        $instamojo->setEnv($test_mode);
        $instamojo->setExchangeRate(self::exchange_rate_usd_to_inr());

        return $instamojo;
    }

    public static function get_mercadopago_credential() : object
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'mercadopago')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);

        $client_id = $decoded->client_id ?? '';
        $client_secret = $decoded->client_secret ?? '';
        $test_mode = $paypal_credential_from_database->test_mode;

        $mercadopago = XgPaymentGateway::mercadopago();
        $mercadopago->setClientId($client_id);
        $mercadopago->setClientSecret($client_secret);
        $mercadopago->setCurrency(self::site_global_currency());
        $mercadopago->setEnv($test_mode);
        $mercadopago->setExchangeRate(self::exchange_rate_usd_to_brl());

        return $mercadopago;
    }

    public static function get_squareup_credential() : object
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'squareup')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);

        $location_id = $decoded->location_id ?? '';
        $access_token = $decoded->access_token ?? '';
        $setApplicationId = $decoded->setApplicationId ?? '';
        $test_mode = $paypal_credential_from_database->test_mode;

        $squareup = XgPaymentGateway::squareup();
        $squareup->setLocationId($location_id);
        $squareup->setAccessToken($access_token);
        $squareup->setApplicationId($setApplicationId);
        $squareup->setCurrency(self::site_global_currency());
        $squareup->setEnv($test_mode);
        $squareup->setExchangeRate(self::exchange_rate_usd_to_inr());

        return $squareup;
    }

    public static function get_cinetpay_credential() : object
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'cinetpay')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);

        $setAppKey = $decoded->apiKey ?? '';
        $setSiteId = $decoded->site_id ?? '';
        $test_mode = $paypal_credential_from_database->test_mode;

        $cinetpay = XgPaymentGateway::cinetpay();
        $cinetpay->setAppKey($setAppKey);
        $cinetpay->setSiteId($setSiteId);
        $cinetpay->setCurrency(self::site_global_currency());
        $cinetpay->setEnv($test_mode);
        $cinetpay->setExchangeRate(self::exchange_rate_usd_to_inr());

        return $cinetpay;
    }

    public static function get_paytabs_credential() : object
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'paytabs')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);

        $setProfileId = $decoded->profile_id ?? '';
        $setRegion = $decoded->region ?? '';
        $setServerKey = $decoded->server_key ?? '';
        $test_mode = $paypal_credential_from_database->test_mode;

        $paytabs = XgPaymentGateway::paytabs();
        $paytabs->setProfileId($setProfileId);
        $paytabs->setRegion($setRegion);
        $paytabs->setServerKey($setServerKey);
        $paytabs->setCurrency(self::site_global_currency());
        $paytabs->setEnv($test_mode);
        $paytabs->setExchangeRate(self::exchange_rate_usd_to_usd());

        return $paytabs;
    }

    public static function get_billplz_credential() : object
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'billplz')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);

        $setKey = $decoded->key ?? '';
        $setVersion = $decoded->version ?? '';
        $setXsignature = $decoded->x_signature ?? '';
        $setCollectionName = $decoded->collection_name ?? '';
        $test_mode = $paypal_credential_from_database->test_mode == 1;

        $billplz = XgPaymentGateway::billplz();
        $billplz->setKey($setKey);
        $billplz->setVersion($setVersion);
        $billplz->setXsignature($setXsignature);
        $billplz->setCollectionName($setCollectionName);
        $billplz->setCurrency(self::site_global_currency());
        $billplz->setEnv($test_mode);
        $billplz->setExchangeRate(self::exchange_rate_usd_to_myr());

        return $billplz;
    }

    public static function get_zitopay_credential() : object
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'zitopay')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);

        $setUsername = $decoded->username ?? '';
        $test_mode = $paypal_credential_from_database->test_mode;

        $zitopay = XgPaymentGateway::zitopay();
        $zitopay->setUsername($setUsername);
        $zitopay->setCurrency(self::site_global_currency());
        $zitopay->setEnv($test_mode);
        $zitopay->setExchangeRate(self::exchange_rate_usd_to_inr()); // if INR not set as currency

        return $zitopay;
    }

    public static function get_toyyibpay_credential()
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'toyyibpay')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);

        $setSecretKey = $decoded->client_secret ?? '';
        $setCategoryCode = $decoded->category_code ?? '';
        $test_mode = $paypal_credential_from_database->test_mode;

        $toyyibpay = XgPaymentGateway::toyyibpay();
        $toyyibpay->setUserSecretKey($setSecretKey);
        $toyyibpay->setCategoryCode($setCategoryCode);
        $toyyibpay->setEnv($test_mode);
        $toyyibpay->setCurrency(self::site_global_currency());
        $toyyibpay->setExchangeRate(self::exchange_rate_usd_to_inr()); //only support MYR Currency

        return $toyyibpay;
    }

    public static function get_pagali_credential()
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'pagali')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);

        $page_id = $decoded->page_id ?? '';
        $entity_id = $decoded->entity_id ?? '';
        $test_mode = $paypal_credential_from_database->test_mode;

        $pagali = XgPaymentGateway::pagalipay();
        $pagali->setPageId($page_id);
        $pagali->setEntityId($entity_id);
        $pagali->setEnv($test_mode);
        $pagali->setCurrency(self::site_global_currency());

        return $pagali;
    }

    public static function get_authorizenet_credential()
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'authorizenet')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);

        $merchant_login_id = $decoded->merchant_login_id ?? '';
        $merchant_transaction_id = $decoded->merchant_transaction_id ?? '';
        $test_mode = $paypal_credential_from_database->test_mode;

        $authorizenet = XgPaymentGateway::authorizenet();
        $authorizenet->setMerchantLoginId($merchant_login_id);
        $authorizenet->setMerchantTransactionId($merchant_transaction_id);
        $authorizenet->setEnv($test_mode);

        return $authorizenet;
    }

    /**
     * @return mixed
     */
    public static function get_siteways_credential(): mixed
    {
        $paypal_credential_from_database = PaymentGateway::where('name', 'siteways')->first();
        $decoded = json_decode($paypal_credential_from_database->credentials);

        $siteways_brand_id = $decoded->siteways_brand_id ?? '';
        $siteways_api_key = $decoded->siteways_api_key ?? '';

        $sitesway = XgPaymentGateway::sitesway();
        $sitesway->setBrandId($siteways_brand_id);
        $sitesway->setApiKey($siteways_api_key);
        $sitesway->setCurrency(self::site_global_currency());

        return $sitesway;
    }

    /**
     * @return mixed
     */
    public static function get_transactionclud_credential(): mixed
    {
        $transactionclud_credential_from_database = PaymentGateway::where('name', 'transactionclud')->first();
        $decoded = json_decode($transactionclud_credential_from_database->credentials);

        $apiKey = $decoded->api_key ?? "";
        $apiPassword = $decoded->api_password ?? "";
        $productId = $decoded->product_id ?? "";

        $transactionclud = XgPaymentGateway::transactionclud();
        $transactionclud->setApiLogin($apiKey);
        $transactionclud->setApiPassword($apiPassword);
        $transactionclud->setProductID($productId);
        $transactionclud->setEnv((bool) $transactionclud_credential_from_database->test_mode);
        $transactionclud->setCurrency(self::site_global_currency());

        return $transactionclud;
    }

    public static function get_wipay_credential()
    {
        $wipay_credential_from_database = PaymentGateway::where('name', 'wipay')->first();
        $decoded = json_decode($wipay_credential_from_database->credentials);

        $accountNumber = $decoded->account_number ?? "";
        $accountApi = $decoded->account_api ?? "";
        $feeStructure = $decoded->fee_structure ?? "";
        $countryCode = $decoded->country_code ?? "";

        $wipay = XgPaymentGateway::wipay();
        $wipay->setAccountNumber($accountNumber);
        $wipay->setApiPassword($accountApi);
        $wipay->setFeeStructure($feeStructure);
        $wipay->setCountryCode($countryCode);
        $wipay->setEnv((bool) $wipay_credential_from_database->test_mode);
        $wipay->setCurrency(self::site_global_currency());

        return $wipay;
    }

    public static function get_kinetpay_credential()
    {
        $wipay_credential_from_database = PaymentGateway::where('name', 'kinetpay')->first();
        $decoded = json_decode($wipay_credential_from_database->credentials);

        $merchant_key = $decoded->merchant_key ?? "";
        $bank = $decoded->bank ?? "";

        $kineticpay = XgPaymentGateway::kineticpay();
        $kineticpay->setMerchantKey($merchant_key);
        $kineticpay->setBank($bank);
        $kineticpay->setCurrency(self::site_global_currency());
        $kineticpay->setEnv(true);

        return $kineticpay;
    }

    public static function get_senangpay_credential()
    {
        $wipay_credential_from_database = PaymentGateway::where('name', 'senangpay')->first();
        $decoded = json_decode($wipay_credential_from_database->credentials);

        $merchant_id = $decoded->senangpay_set_merchant_id ?? "";
        $secret_key = $decoded->senangpay_set_secret_key ?? "";
        $recurring_id = $decoded->recurring_id ?? "";

        $senangpay = XgPaymentGateway::senangpay();
        $senangpay->setMerchantId($merchant_id);
        $senangpay->setSecretKey($secret_key);
        $senangpay->setRecurringId($recurring_id);
        $senangpay->setEnv((bool) $wipay_credential_from_database->test_mode);
        $senangpay->setHashMethod('sha256');
        $senangpay->setCurrency(self::site_global_currency());

        return $senangpay;
    }

    public static function get_saltpay_credential()
    {
        $wipay_credential_from_database = PaymentGateway::where('name', 'saltpay')->first();
        $decoded = json_decode($wipay_credential_from_database->credentials);

        $merchant_id = $decoded->marchent_id ?? "";
        $secret_key = $decoded->secret_key ?? "";

        $saltpay = XgPaymentGateway::saltpay();
        $saltpay->setMerchantId($merchant_id);
        $saltpay->setSecretKey($secret_key);
        $saltpay->setPaymentGatewayId(16);
        $saltpay->setEnv(true);
        $saltpay->setCurrency(self::site_global_currency());

        return $saltpay;
    }

    public static function get_iyzipay_credential()
    {
        $iyzipay_credential_from_database = PaymentGateway::where('name', 'iyzipay')->first();
        $decoded = json_decode($iyzipay_credential_from_database->credentials);

        $secretKey = $decoded->iyzipay_set_secret_key ?? "";
        $api_key = $decoded->iyzipay_set_api_key ?? "";

        $iyzipay = XgPaymentGateway::iyzipay();
        $iyzipay->setSecretKey($secretKey);
        $iyzipay->setApiKey($api_key);
        $iyzipay->setEnv($iyzipay_credential_from_database->test_mode ?? false);
        $iyzipay->setCurrency(self::site_global_currency());

        return $iyzipay;
    }

    public static function get_awdpay_credential(){
        $awdpay_credential_from_database = PaymentGateway::where('name', 'awdpay')->first();
        $decoded = json_decode($awdpay_credential_from_database->credentials);

        $secretKey = $decoded->private_key ?? "";
        $logo_url = $decoded->logo_url ?? "";

        $awdpay = XgPaymentGateway::awdpay();
        $awdpay->setPrivateKey($secretKey);
        $awdpay->setLogoUrl($logo_url);
        $awdpay->setCurrency(self::site_global_currency());
        $awdpay->setEnv($awdpay_credential_from_database->test_mode ?? false);
        $awdpay->setExchangeRate(self::exchange_rate_usd_to_inr());
        return $awdpay;
    }

    public static function get_sslcommerz_credential(){
        $sslcommerz_credential_from_database = PaymentGateway::where('name', 'sslcommerz')->first();
        $decoded = json_decode($sslcommerz_credential_from_database->credentials);

        $store_id = $decoded->store_id ?? "";
        $store_passwd = $decoded->store_passwd ?? "";

        $sslcommerz = XgPaymentGateway::sslcommerz();
        $sslcommerz->setStoreId($store_id);
        $sslcommerz->setStorePasswd($store_passwd);
        $sslcommerz->setCurrency(self::site_global_currency());
        $sslcommerz->setEnv($sslcommerz_credential_from_database->test_mode ?? false);
        $sslcommerz->setExchangeRate(self::exchange_rate_usd_to_inr());
        return $sslcommerz;
    }
    
    // In PaymentGatewayCredential.php (or your equivalent file):
    public static function get_abapayway_credential() : object
    {
        // 1) Grab the `abapayway` row from `payment_gateways` table
        $gateway = PaymentGateway::where('name', 'abapayway')->firstOrFail();

        // 2) Decode JSON credentials
        $creds = json_decode($gateway->credentials);
        $mode  = $gateway->test_mode; // 1 => sandbox, 0 => live

        $merchant_id = $creds->merchant_id ?? '';
        $api_key     = $creds->api_key     ?? '';
        // If there's an "api_user" in credentials, you can fetch that too.

        // 3) Create an AbaPayway instance
        //    (assuming Xgenious\Paymentgateway\Base\Gateways\AbaPayway)
        $abapayway = XgPaymentGateway::abapayway();
        $abapayway->setMerchantId($merchant_id);
        $abapayway->setApiKey($api_key);

        // 4) Set the environment: 
        //    If test_mode=1 => sandbox, else live
        $abapayway->setEnv($mode == 1);

        // 5) Set currency & exchange rate if needed
        $abapayway->setCurrency(self::site_global_currency());
        $abapayway->setExchangeRate(self::exchange_rate_usd_to_inr());

        return $abapayway;
    }

    public static function get_acledapay_credential(): object
    {
        // 1) Fetch the `acledapay` row from `payment_gateways` table
        $gateway = PaymentGateway::where('name', 'acledapay')->firstOrFail();

        // 2) Decode JSON credentials
        $creds = json_decode($gateway->credentials);
        $mode  = $gateway->test_mode; // 1 => sandbox, 0 => live

        $merchant_id = $creds->merchant_id ?? '';
        $secret     = $creds->secret ?? '';
        $login_id    = $creds->login_id ?? '';
        $password    = $creds->password ?? '';

        // {"merchant_id":"VMtz5hy8QFxgmq06576jycISzGg=","login_id":"sombokchab","password":"sombokchab","secret":"123456"}
        // 3) Create an AcledaPay instance
        $acledaPay = XgPaymentGateway::acledapay();
        $acledaPay->setMerchantId($merchant_id);
        $acledaPay->setApiKey($secret);
        $acledaPay->setLoginId($login_id);
        $acledaPay->setPassword($password);

        // 4) Set the environment (sandbox/live)
        $acledaPay->setEnv($mode == 1);

        // 5) Set currency & exchange rate if needed
        $acledaPay->setCurrency(self::site_global_currency());
        $acledaPay->setExchangeRate(self::exchange_rate_usd_to_inr());

        return $acledaPay;
    }



}
