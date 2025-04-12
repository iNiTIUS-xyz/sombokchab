<?php

namespace Modules\Refund\Http\Services;

use Illuminate\Mail\SentMessage;
use Mail;
use Modules\Refund\Entities\RefundRequest;
use Modules\Refund\Mail\RefundTrackStatusMail;
use Modules\User\Entities\User;

class RefundMailServices{
    public function __construct(public RefundRequest $request, private $data, private ?RefundMailServices $instance = null)
    {
    }

    private function approved(): ?SentMessage
    {
        $user = User::select("id","email")->find($this->request?->user_id);

        $data = [
            'message' => get_static_option("refund_request_approved_mail_body"),
            'subject' => get_static_option("refund_request_approved_mail_subject")
        ];

        return Mail::to($user->email)->send(new RefundTrackStatusMail($data));
    }

    private function declined(): ?SentMessage
    {
        $user = User::select("id","email")->find($this->request?->user_id);

        $data = [
            'message' => get_static_option("refund_request_declined_mail_body"),
            'subject' => get_static_option("refund_request_declined_mail_subject")
        ];

        return Mail::to($user->email)->send(new RefundTrackStatusMail($data));
    }

    private function readyForPickup(): ?SentMessage
    {
        $user = User::select("id","email")->find($this->request?->user_id);

        $data = [
            'message' => get_static_option("refund_request_ready_for_pickup_mail_body"),
            'subject' => get_static_option("refund_request_ready_for_pickup_mail_subject")
        ];

        return Mail::to($user->email)->send(new RefundTrackStatusMail($data));
    }

    private function cancelByDeliveryMan(): ?SentMessage
    {
        $user = User::select("id","email")->find($this->request?->user_id);
        $messages = get_static_option("refund_request_cancel_mail_body");
        $reason_table = "<table><thead><tr><th>". __('Reason') ."</th></tr></thead><tbody>";

        foreach($this->data['reasons'] as $reason){
            $reason_table .= "<tr><td>". $reason["reason"] ."</td></tr>";
        }

        $reason_table .=  "</tbody></table>";

        $messages = str_replace("{reason}",$reason_table,$messages);

        return Mail::to($user->email)->send(new RefundTrackStatusMail([
            'message' => $messages,
            'subject' => get_static_option("refund_request_cancel_mail_subject")
        ]));
    }

    private function pickedUp(): ?SentMessage
    {
        $user = User::select("id","email")->find($this->request?->user_id);

        $data = [
            'message' => get_static_option("refund_request_picked_up_mail_body"),
            'subject' => get_static_option("refund_request_picked_up_mail_subject")
        ];

        return Mail::to($user->email)->send(new RefundTrackStatusMail($data));
    }

    private function cancel($reasons): ?SentMessage
    {
        $user = User::select("id","email")->find($this->request?->user_id);
        $messages = get_static_option("refund_request_cancel_mail_body");
        $reason_table = "<table><thead><tr><th>". __('Reason') ."</th></tr></thead><tbody>";

        foreach($reasons as $reason){
            $reason_table .= "<tr><td>". $reason["reason"] ."</td></tr>";
        }

        $reason_table .=  "</tbody></table>";

        $messages = str_replace("{reason}",$reason_table,$messages);

        return Mail::to($user->email)->send(new RefundTrackStatusMail([
            'message' => $messages,
            'subject' => get_static_option("refund_request_cancel_mail_subject")
        ]));
    }

    private function verifyProduct(): ?SentMessage
    {
        $user = User::select("id","email")->find($this->request?->user_id);

        $data = [
            'message' => get_static_option("refund_request_verify_product_mail_body"),
            'subject' => get_static_option("refund_request_verify_product_mail_subject")
        ];

        return Mail::to($user->email)->send(new RefundTrackStatusMail($data));
    }

    private function onTheWay(): ?SentMessage
    {
        $user = User::select("id","email")->find($this->request?->user_id);

        $data = [
            'message' => get_static_option("refund_request_on_the_way_mail_body"),
            'subject' => get_static_option("refund_request_on_the_way_mail_subject")
        ];

        return Mail::to($user->email)->send(new RefundTrackStatusMail($data));
    }
    
    private function productReturned(){
        $user = User::select("id","email")->find($this->request?->user_id);

        $data = [
            'message' => get_static_option("refund_request_picked_up_mail_body"),
            'subject' => get_static_option("refund_request_returned_mail_subject")
        ];

        return Mail::to($user->email)->send(new RefundTrackStatusMail($data));
    }
    
    private function paymentProcessing(){
        $user = User::select("id","email")->find($this->request?->user_id);

        $data = [
            'message' => get_static_option("refund_request_payment_processing_mail_body"),
            'subject' => get_static_option("refund_request_payment_processing_mail_subject")
        ];

        return Mail::to($user->email)->send(new RefundTrackStatusMail($data));
    }
    
    private function paymentReturned(): ?SentMessage
    {
        $user = User::select("id","email")->find($this->request?->user_id);
        $table = "<table><thead><tr><th>". __("Cause") ."</th><th>". __("Amount") ."</th></tr></thead><tbody>";

        foreach($this->data['deducted_amount'] ?? [] as $deductedAmount){
            $deductedAmount = (object) $deductedAmount;

            $table .= "<tr><td>". $deductedAmount->reason ."</td><td>". float_amount_with_currency_symbol($deductedAmount->amount) ."</td></tr>";
        }

        $table .= "<tr><td>". __("Refund amount") ."</td><td>". float_amount_with_currency_symbol($this->data['refund_fee'] ?? 0) ."</td></tr>";
        $table .= "</tbody></table>";

        $data = [
            'message' => str_replace("@deduction_amount_table",$table,get_static_option("refund_request_payment_transferred_mail_body")),
            'subject' => get_static_option("refund_request_payment_transferred_mail_subject")
        ];

        return Mail::to($user->email)->send(new RefundTrackStatusMail($data));
    }
    
    private function refundCompleted(): ?SentMessage
    {
        $user = User::select("id","email")->find($this->request?->user_id);

        $data = [
            'message' => get_static_option("refund_request_payment_completed_mail_body"),
            'subject' => get_static_option("refund_request_payment_completed_mail_subject")
        ];

        return Mail::to($user->email)->send(new RefundTrackStatusMail($data));
    }

    public static function sendMail(RefundRequest $request,string $status,array | object $data = []): string|SentMessage|null
    {
        // first i need to initialize this class for making class object
        $init = self::init($request,$data);
        // now hare is the main thing we need to check RefundRequest status type
        return match ($status){
            "approved" => $init->approved(),
            "declined" => $init->declined(),
            "ready_for_pickup" => $init->readyForPickup(),
            "canceled_by_delivery_man","cancel" => $init->cancelByDeliveryMan(),
            "picked_up" => $init->pickedUp(),
//            "cancel" => $init->cancel(),
            "verify_product" => $init->verifyProduct(),
            "product_returned" => $init->productReturned(),
            "payment_processing" => $init->paymentProcessing(),
            "payment_returned" => $init->paymentReturned(),
            "payment_completed" => $init->refundCompleted(),
            default => ""
        };
    }

    private static function init($request, $data): RefundMailServices
    {
        $instance = new self($request, $data);

        if(is_null($instance->instance)){
            $instance->instance = $instance;
        }

        return $instance;
    }
}