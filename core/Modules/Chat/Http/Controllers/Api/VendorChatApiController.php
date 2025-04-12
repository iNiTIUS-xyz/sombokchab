<?php

namespace Modules\Chat\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;
use Modules\Chat\Entities\LiveChat;
use Modules\Chat\Http\Requests\FetchChatRecordRequest;
use Modules\Chat\Http\Requests\MessageSendRequest;
use Modules\Chat\Http\Resources\LivechatUserListResource;
use Modules\Chat\Services\UserChatService;

class VendorChatApiController extends Controller
{
    public function index()
    {
        $vendor_chat_list = LiveChat::with("vendor","user")
            ->withCount("vendor_unseen_msg","user_unseen_msg")
            ->where("vendor_id", auth("sanctum")->user()->id)
            ->orderByDesc('user_unseen_msg_count')
            ->get();

        $arr = "";

        foreach($vendor_chat_list->pluck("user.id") as $id){
            $arr .= "user_id_". $id .": false,";
        }

        $arr = rtrim($arr,",");

        return LivechatUserListResource::collection($vendor_chat_list);
    }

    public function fetch_chat_record(Request $request){
        $data = $request->all();


        // now remove first 8 character form vendors id
        // first need to check the vendor id length the length should be gater then 8 charecter
        if(str($data["user_id"] ?? "")->length() <= 11){
            return response()->json([
                "msg" => __("Invalid user id"),
                "status" => 'failed'
            ], 422);
        }

        $data["user_id"] = $this->trimString($data["user_id"]);

        return UserChatService::fetch($data["user_id"],auth('sanctum')->user()->id,from: 1);
    }

    /**
     * @throws Exception
     */
    #[NoReturn]
    public function message_send(MessageSendRequest $request){
        $data = $request->all();

        // now remove first 8 character form vendors id
        // first need to check the vendor id length the length should be gater then 8 charecter
        if(str($data["user_id"] ?? "")->length() <= 11){
            return response()->json([
                "msg" => __("Invalid user id"),
                "status" => 'failed'
            ], 422);
        }

        $data["user_id"] = $this->trimString($data["user_id"]);

        return UserChatService::send(
            $data["user_id"],
            auth('sanctum')->user()->id,
            $request->message,2,
            $request->file,
            $request->product_id ?? null,
            'json'
        );
    }

    private function trimString($string, $start = 8, $end = 11){
        return substr($string,$start, str($string)->length() - $end);
    }
}
