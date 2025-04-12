<?php

namespace Modules\Chat\Http\Controllers;

use Cache;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use JetBrains\PhpStorm\NoReturn;
use Modules\Chat\Entities\LiveChat;
use Modules\Chat\Http\Requests\FetchChatRecordRequest;
use Modules\Chat\Http\Requests\MessageSendRequest;
use Modules\Chat\Services\UserChatService;

class ChatController extends Controller
{
    public function index()
    {
        $user_chat_list = LiveChat::with("vendor.logo","user")
            ->withCount("vendor_unseen_msg","user_unseen_msg")
            ->where("user_id", auth("web")->id())
            ->orderByDesc('vendor_unseen_msg_count')
            ->get();

        $arr = "";

        foreach($user_chat_list->pluck("vendor.id") as $id) {
            $arr .= "vendor_id_". $id .": false,";
        }

        $arr = rtrim($arr,",");

        return view("chat::user.index",compact('user_chat_list','arr'));
    }

    public function fetch_user_chat_record(FetchChatRecordRequest $request){
        $data = $request->validated();
        $requestForm = $data['request_from'] ?? false;

        $data = UserChatService::fetch($data["user_id"],$data["vendor_id"],from: 2);
        $currentUserType = "user";

        if($requestForm != 'dashboard'){
            return view('chat::messages',compact('data','currentUserType'));
        }

        $body = view('chat::messages',compact('data','currentUserType'))->render();
        $header = view("chat::user.message-header", compact('data'))->render();

        return response()->json([
            "body" => $body,
            "header" => $header
        ]);
    }

    public function isVendorActive($id){
        $cache = Cache::has('vendor_is_online_' . $id);

        return response()->json([
            "msg" => __($cache ? "Active" : "In Active"),
            "key" => $cache ? "active" : "in-active"
        ]);
    }

    /**
     * @throws Exception
     */
    #[NoReturn]
    public function message_send(MessageSendRequest $request){
        // send message
        return UserChatService::send(
            auth('web')->id(),
            $request->vendor_id,
            $request->message,
            1,
            $request->file,
                $request->product_id ?? null
        );
    }
}
