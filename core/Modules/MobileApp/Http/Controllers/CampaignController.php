<?php

namespace Modules\MobileApp\Http\Controllers;

use Modules\Campaign\Entities\Campaign;

use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Modules\MobileApp\Entities\MobileCampaign;
use Modules\MobileApp\Http\Resources\Api\CampaignResource;

class CampaignController extends Controller
{
    public function index()
    {


        $selectedCampaigns = MobileCampaign::pluck('campaign_ids')->toArray();

        // dd($selectedCampaigns);

        $campaigns = Campaign::with("campaignImage")
            ->where("status", "publish")
            ->whereDate("end_date", '>', Carbon::now())->get();

        return CampaignResource::collection($campaigns);
    }
}
