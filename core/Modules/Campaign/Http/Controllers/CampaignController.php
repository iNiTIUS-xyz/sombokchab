<?php

namespace Modules\Campaign\Http\Controllers;

use DB;
use Throwable;
use App\Helpers\FlashMsg;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Product\Entities\Product;
use Illuminate\Contracts\View\Factory;
use Modules\Campaign\Entities\Campaign;
use Modules\Campaign\Entities\CampaignProduct;
use Modules\Campaign\Http\Services\GlobalCampaignService;
use Modules\Campaign\Http\Requests\CampaignValidationRequest;

class CampaignController extends Controller
{
    const BASE_URL = 'campaign::backend.';

    public function index()
    {
        $all_campaigns = GlobalCampaignService::fetch_campaigns(); //Campaign::with("campaignImage")->get();

        return view(self::BASE_URL . 'all', compact('all_campaigns'));
    }

    public function create()
    {
        return GlobalCampaignService::renderCampaignProduct(self::BASE_URL);
    }


    public function store(CampaignValidationRequest $request)
    {
        $data = $request->validated();

        try {
            $existCampaign = Campaign::query()
                ->where('title', $request->campaign_name)
                ->first();

            if ($existCampaign) {
                return back()->with([
                    'type' => 'danger',
                    'msg' => __('Campaign already exist with this title.')
                ]);
            }

            DB::beginTransaction();

            // Prepare campaign data
            $campaignData = [
                'title' => $data['campaign_name'],
                'title_km' => $data['campaign_name_km'],
                'subtitle' => $data['campaign_subtitle'],
                'subtitle_km' => $data['campaign_subtitle_km'],
                'image' => $data['image'],
                'status' => $data['status'],
                'start_date' => $data['campaign_start_date'],
                'end_date' => $data['campaign_end_date'],
                'slug' => Str::slug($data['campaign_name']),
                'admin_id' => $data['admin_id'] ?? null,
                'vendor_id' => $data['vendor_id'] ?? null,
                'type' => $data['type'] ?? null,
            ];

            $campaign = Campaign::create($campaignData);

            if ($campaign->id) {
                // Prepare products data
                $productsData = [
                    'product_id' => $request->product_id,
                    'campaign_price' => $request->campaign_price,
                    'units_for_sale' => $request->units_for_sale,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                ];

                GlobalCampaignService::insertCampaignProducts($campaign->id, $productsData);
            }

            DB::commit();

            return back()->with(FlashMsg::create_succeed('Campaign'));
        } catch (Throwable $th) {
            DB::rollBack();
            \Log::error('Campaign creation failed: ' . $th->getMessage());

            return back()->with(FlashMsg::create_failed('Campaign'));
        }
    }

    public function edit($item)
    {
        return GlobalCampaignService::renderCampaignProduct(self::BASE_URL, $item);
    }

    public function update(CampaignValidationRequest $request)
    {
        $data = $request->validated();

        $existCampaign = Campaign::query()
            ->where('id', '!=', $request->id)
            ->where('title', $request->campaign_name)
            ->first();

        if ($existCampaign) {
            return back()->with([
                'type' => 'danger',
                'msg' => __('Campaign already exist with this title.')
            ]);
        }

        DB::beginTransaction();


        try {

            $campaignData = [
                'title' => $data['campaign_name'],
                'title_km' => $data['campaign_name_km'],
                'subtitle' => $data['campaign_subtitle'],
                'subtitle_km' => $data['campaign_subtitle_km'],
                'image' => $data['image'],
                'status' => $data['status'],
                'start_date' => $data['campaign_start_date'],
                'end_date' => $data['campaign_end_date'],
                'slug' => Str::slug($data['campaign_name']),
            ];

            Campaign::findOrFail($request->id)->update($campaignData);

            $productsData = [
                'product_id' => $request->product_id,
                'campaign_price' => $request->campaign_price,
                'units_for_sale' => $request->units_for_sale,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ];

            if ($request->id) {

                CampaignProduct::whereIn('id', $request->campaign_product_id)->delete();

                $productsData = [
                    'product_id' => $request->product_id,
                    'campaign_price' => $request->campaign_price,
                    'units_for_sale' => $request->units_for_sale,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                ];

                GlobalCampaignService::insertCampaignProducts($request->id, $productsData);
            }

            DB::commit();

            return back()->with(FlashMsg::update_succeed('Campaign'));
        } catch (Throwable $th) {
            DB::rollBack();
            return back()->with(FlashMsg::update_failed('Campaign'));
        }
    }

    public function destroy(Campaign $item)
    {
        try {
            DB::beginTransaction();
            $products = $item->products;
            if ($products->count()) {
                foreach ($products as $product) {
                    $product->delete();
                }
            }
            $item_deleted = $item->delete();
            DB::commit();

            return back()->with($item_deleted ? ['msg' => __('Successfully deleted campaign'), 'type' => 'success'] : ['msg' => __('Failed to delete, Something went wrong.'), 'type' => 'danger']);
        } catch (Throwable $th) {
            DB::rollBack();

            return back()->with(['msg' => __('Failed to delete campaign'), 'type' => 'danger']);
        }
    }

    public function statusChanage(Request $request, $id)
    {
        Campaign::findOrFail($id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with([
            'msg' => __('Campaign status changed successfully.'),
            'type' => 'success',
        ]);
    }

    public function bulk_action(Request $request)
    {
        try {
            DB::beginTransaction();
            Campaign::whereIn('id', $request->ids)->delete();
            CampaignProduct::whereIn('campaign_id', $request->ids)->delete();
            DB::commit();

            return 'ok';
        } catch (Throwable $th) {
            DB::rollBack();

            return false;
        }
    }

    public function getProductPrice(Request $request)
    {
        $price = Product::findOrFail($request->id)->price;

        return response()->json(['price' => $price], 200);
    }

    public function deleteProductSingle(Request $request)
    {
        $delete = (bool) CampaignProduct::findOrFail($request->id)->delete();

        return back()->with([
            'type' => $delete ? 'success' : 'danger',
            'msg' => $delete ? __('Successfully deleted') : __('Failed to delete'),
        ]);
    }
}
