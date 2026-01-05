<?php

namespace Modules\MobileApp\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Campaign\Entities\Campaign;
use Modules\MobileApp\Entities\MobileCampaign;

class MobileCampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth:admin"]);
    }

    public function index()
    {
        $campaigns = Campaign::select('title as name', 'id')->get();
        $selectedCampaign = MobileCampaign::pluck('campaign_id');
        $selectedCampaignIds = json_decode($selectedCampaign);

        return view("mobileapp::mobile-campaign.create", compact('campaigns', 'selectedCampaignIds'));
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                "campaign" => 'required'
            ]);

            MobileCampaign::truncate();

            DB::beginTransaction();

            foreach ($request->campaign as $campaign) {

                MobileCampaign::firstOrCreate([
                    'campaign_id' => $campaign
                ]);
            }

            DB::commit();

            return back()->with(["alert-type" => 'success', 'message' => "Campaign updated successfully."]);
        } catch (\Throwable $e) {

            return back()->with(["alert-type" => 'error', 'message' => "Something went wrong. Please try again."]);
        }
    }
}
