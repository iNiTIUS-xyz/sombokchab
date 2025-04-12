<?php

namespace Modules\Chat\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Cache;
use Exception;
use Illuminate\Http\Request;
use JetBrains\PhpStorm\NoReturn;
use Modules\Chat\Entities\LiveChat;
use Modules\Chat\Http\Requests\FetchChatRecordRequest;
use Modules\Chat\Http\Requests\MessageSendRequest;
use Modules\Chat\Http\Resources\LivechatVendorListResource;
use Modules\Chat\Services\UserChatService;

class UserChatApiController extends Controller
{
    public function index()
    {
        $vendor_chat_list = LiveChat::with(["livechatMessage" => function ($query){
                $query->orderByDesc("id")->limit(1);
            },"vendor:id,business_name","vendor.logo","user",
        ])
        ->withCount("vendor_unseen_msg","user_unseen_msg")
        ->where("user_id", auth("sanctum")->id())
        ->orderByDesc('vendor_unseen_msg_count')
        ->paginate(get_static_option("default_pagination_limit") ?? 20);

        $arr = "";

        foreach($vendor_chat_list->pluck("vendor.id") as $id) {
            $arr .= "vendor_id_". $id .": false,";
        }

        return LivechatVendorListResource::collection($vendor_chat_list);
    }

    public function fetch_user_chat_record(Request $request){
        $data = $request->all();

        // now remove first 8 character form vendors id
        // first need to check the vendor id length the length should be gater then 8 charecter
        if(str($data["vendor_id"] ?? "")->length() <= 11){
            return response()->json([
                "msg" => __("Invalid vendor id"),
                "status" => 'failed'
            ], 422);
        }

        $data["vendor_id"] = $this->trimString($data["vendor_id"]);

        return UserChatService::fetch(auth("sanctum")->user()->id,$data["vendor_id"],from: 2);
    }

    public function isVendorActive($id){
        $id = $this->trimString($id);

        $cache = Cache::has('vendor_is_online_' . $id);

        return response()->json([
            "msg" => __($cache ? "Active" : "In Active"),
            "key" => $cache ? "active" : "in-active",
        ]);
    }

    /**
     * @throws Exception
     */
    #[NoReturn]
    public function message_send(MessageSendRequest $request){
        $data = $request->all();
        // now remove first 8 character form vendors id
        // first need to check the vendor id length the length should be gater then 8 charecter
        if(str($data["vendor_id"] ?? "")->length() <= 11){
            return response()->json([
                "msg" => __("Invalid vendor id"),
                "status" => 'failed'
            ], 422);
        }

        $data["vendor_id"] = $this->trimString($data["vendor_id"]);

        // send message
        return UserChatService::send(
            auth('sanctum')->user()->id,
            $data["vendor_id"],
            $request->message,
            1,
            $request->file,
            $request->product_id ?? null,
            'json'
        );
    }

    private function trimString($string, $start = 8, $end = 11){
        return substr($string,$start, str($string)->length() - $end);
    }
}
