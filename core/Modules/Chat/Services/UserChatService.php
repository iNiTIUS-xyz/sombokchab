<?php

namespace Modules\Chat\Services;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use InvalidArgumentException;
use JetBrains\PhpStorm\NoReturn;
use Modules\Chat\Entities\LiveChat;
use Modules\Chat\Entities\LiveChatMessage;
use Modules\Chat\Events\LivechatUserMessageEvent;
use Modules\Chat\Events\LivechatVendorMessageEvent;
use Modules\Product\Entities\Product;
use Modules\User\Entities\User;
use Modules\Vendor\Entities\Vendor;
use Storage;
use Str;

class UserChatService
{
    private $liveChat = null;
    private $livechatQuery = null;
    private $lastMessage = null;
    private $productData = null;
    private $vendorData = null;
    private array $message = [];
    private string $filename = '';
    private $instance;
    private array $allowedFilesExtension = ['jped','jpg','png','pdf','gif'];
    public const FOLDER_PATH = 'assets/uploads/media-uploader/live-chat/';

    private static function init(): UserChatService
    {
        $init = new self();

        if(is_null($init->instance)){
            $init->instance = $init;

            return $init;
        }

        return $init;
    }

    // check if this user has already charted with vendor or not
    // if user already made any chat with vendor then displays old data and if not then creates new record
    private function recordIsExistsOrNot($userId, $vendorId){
        $this->livechatQuery = LiveChat::where("user_id", $userId)->where("vendor_id",$vendorId);
        return $this->livechatQuery->count();
    }

    // this method will return instance of livechat table
    // check if record is already in a database then return that and if not then create new one and return this instance
    private function livechatInstance(int $userId, int $vendorId){
        if($this->recordIsExistsOrNot($userId, $vendorId) > 0){
            return $this->livechatQuery->first();
        }

        return LiveChat::create([
            "user_id" => $userId,
            "vendor_id" => $vendorId
        ]);
    }

    // create new livestreaming record
    private function sendMessage(array|object $data){
        $this->lastMessage = LiveChatMessage::create($data);

        return $this->lastMessage;
    }

    private function fetch_user_info($user_id){
        if(gettype($user_id) == 'integer'){
            $this->userData = User::select("id","image","name")
                ->with("profile_image")->find($user_id);

            return $this->userData;
        }

        if(is_null($user_id)){
            return null;
        }

        // now throw exception
        throw new InvalidArgumentException("Invalid vendor id this id should be integer " . gettype($user_id) . ' given at line:'. __LINE__ . " File: ". __FILE__);
    }

    private function fetch_vendor_info(?int $vendor_id): Vendor|array|null
    {
        if(gettype($vendor_id) == 'integer'){
            $this->vendorData = Vendor::select("id","image_id","business_name","username")
                ->with("logo")->find($vendor_id);

            return $this->vendorData;
        }

        if(is_null($vendor_id)){
            return null;
        }

        // now throw exception
        throw new InvalidArgumentException("Invalid vendor id this id should be integer " . gettype($vendor_id) . ' given at line:'. __LINE__ . " File: ". __FILE__);
    }

    private function updateUnSeen($livechat_id, $type): void
    {
        LiveChatMessage::where("live_chat_id", $livechat_id)
            ->when($type == 0, function ($query) {
                $query->where("from_user", 2);
            })->when($type == 1, function ($query) {
                $query->where("from_user", 1);
            })->update([
                "is_seen" => 1
            ]);
    }

    public static function fetch(int $user_id,int $vendor_id,$from,int|string $type = 'all',int $limit = 20): LiveChat
    {
        $data = null;
        $instance = self::init();

        // this method will fetch the latest message from message table according-to-user_id and vendor_id
        $livechat = LiveChat::where("user_id", $user_id)->where("vendor_id", $vendor_id)->first();

        // now get a message from livechat messages
        $instance->updateUnSeen($livechat->id,$from);
        $liveChatMessages = LiveChatMessage::where("live_chat_id", $livechat->id)
            ->when($type == 0, function ($query){
                $query->where("is_seen", 0);
            })
            ->latest('id')->paginate($limit);

        $liveChatMessages = $liveChatMessages->reverse();
        $livechat->pagination = $liveChatMessages;

        // check data variable is not empty
        // now append livestreaming
        $livechat->messages = $liveChatMessages;
        $livechat->user = $instance->fetch_user_info($livechat->user_id);
        $livechat->vendor = $instance->fetch_vendor_info($livechat->vendor_id);

        // now return livestreaming collections and if vendor not empty append vendor information
        return $livechat;
    }

    /**
     * @throws Exception
     */
    #[NoReturn]
    public static function send(int $user_id,int $vendor_id,?string $message,int $messageFrom,$file = null,?int $product_id = null, $responseType = 'html'): View|Factory|array|string|Application|null
    {
        // this method will send a message and also store to livechat message table in database
        // message column value should be a json format when product id is not empty
        // after done all action then run an event for pusher
        // response should be boolean
        // to create an instance of this class
        $instance = self::init();
        $instance->liveChat = $instance->livechatInstance($user_id, $vendor_id);
        // this message property will store an array
        $instance->message["message"] = $message;
        // assign product information to product value if product not exists then store null
        $instance->message["product"] = $product_id ? $instance->prepareProductDetails($product_id) : null;
        // now check the need to upload file for checking and uploading file then call storeFile method
        // this condition will check file is not empty if empty then do not call storeFile method
        if(!empty($file)){
            // remember if you call this method, then this method should store file and this method couldn't be work without file
            $instance->storeFile($file);
        }
        // this method will store livechat message
        $message = $instance->storeMessage($messageFrom);
        // hare will be fired an event for pusher

        // this event will fire if from user is vendor
        $instance->fireEvent($message, $instance->liveChat, $messageFrom);

        return $instance->sendResponse($message, $instance->liveChat, $messageFrom, $responseType);
    }

    private function sendResponse($message, $livechat, $messageFrom, $responseType){
        // this condition will check responseType if response type is json then return json but this is not a good method to return early
        if($responseType == 'json'){
            return [
                "message" => $message
            ];
        }

        if($messageFrom == 2){
            return view("chat::components.vendor.message", [
                "data" => $livechat,
                "message" => $message
            ])->render();
        }elseif($messageFrom == 1){
            $user_image = render_image($livechat->user?->profile_image, defaultImage: true);
            $vendor_image = render_image($livechat->vendor?->logo, defaultImage: true);

            return view("chat::components.user-message", [
                "message" => $message,
                "userimage" => $user_image,
                "vendorimage" => $vendor_image
            ]);
        }
    }

    public function fireEvent($message, $livechat, $messageFrom): void
    {
        if($messageFrom == 2){
            $user_image = render_image($livechat->user?->profile_image, defaultImage: true);
            $vendor_image = render_image($livechat->vendor?->logo, defaultImage: true);

            $messageBlade = view("chat::components.user-message", [
                "message" => $message,
                "userimage" => $user_image,
                "vendorimage" => $vendor_image
            ]);

            event(new LivechatVendorMessageEvent(
                $messageBlade,
                $message,
                $livechat,
                $livechat->user_id,
                $livechat->vendor_id,
            ));
        }elseif($messageFrom == 1){
            $bladeMessage = view("chat::components.vendor.message", [
                "data" => $livechat,
                "message" => $message
            ])->render();

            event(new LivechatUserMessageEvent(
                $bladeMessage,
                $message,
                $livechat,
                $livechat->user_id,
                $livechat->vendor_id,
            ));
        }
    }

    private function storeMessage(int $from_user): LiveChatMessage
    {
        return LiveChatMessage::create([
            'live_chat_id' => $this->liveChat?->id,
            'message' => $this->message,
            'file' => $this->filename,
            'from_user' => $from_user,
            'is_seen' => 0
        ]);
    }

    /**
     * @throws Exception
     */
    private function storeFile($file) : void
    {
        $extension = $file->extension();

        // Check if the file extension is allowed
        $imageExtension=['jpeg','jpg','png','gif'];
        if (!in_array($extension, $this->allowedFilesExtension)) {
            throw new Exception('The file you have uploaded with '. $extension .' extension are not allowed.');
        }

        $filename = time() .'-'. Str::uuid() . '.' . $extension;
        if(in_array($extension,$imageExtension)){
            $image = Image::make($file);

            Storage::disk('asset_path')->put(self::FOLDER_PATH.$filename,(string) $image->encode());
        }else{
            $file->move(self::FOLDER_PATH, $filename);
        }


        $this->filename = $filename;
    }

    private function prepareProductDetails($product_id): array {
        $product = $this->getProductDetails($product_id);

        return [
            'name' => $product->name,
            'category' => $product?->category?->name,
            'brand' => $product?->brand?->name,
            'image' => render_image($product?->image, render_type: 'path'),
            'sku' => $product->inventory?->sku
        ];
    }

    private function getProductDetails($product_id): Model|Collection|_IH_Product_C|Product|Builder|array|_IH_Product_QB|null
    {
        // check product id is null or not and also check product is integer or not if not integer then throw exception
        if(!is_null($product_id) && (gettype($product_id) == 'integer')){
            // now query to product table then get product from product table
            $this->productData = Product::select("id","name","image_id","brand_id")
                ->without("badge","uom","uom.unit")
                ->with("brand","category")
                ->find($product_id);

            return $this->productData;
        }

        if(is_null($product_id)){
            return null;
        }

        // now throw exception
        throw new InvalidArgumentException("Invalid product id this id should be integer " . gettype($product_id) . ' given at line:' . __LINE__ . ' File: '. __FILE__);
    }
}