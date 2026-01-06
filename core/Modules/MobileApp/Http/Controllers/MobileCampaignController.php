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
        $campaigns = Campaign::latest()->get();
        $selectedCampaign = MobileCampaign::first();

        return view("mobileapp::mobile-campaign.create", compact('campaigns', 'selectedCampaign'));
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'campaign_ids' => 'required|array',
                'limit' => 'required|integer',
            ]);

            DB::beginTransaction();

            MobileCampaign::updateOrCreate(
                ['id' => 1],
                [
                    'campaign_ids' => json_encode($request->campaign_ids),
                    'limit' => $request->limit,
                ]
            );

            DB::commit();

            return back()->with([
                'alert-type' => 'success',
                'message' => 'Campaign updated successfully.',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with([
                'alert-type' => 'error',
                'message' => 'Something went wrong. Please try again.',
            ]);
        }
    }
}
