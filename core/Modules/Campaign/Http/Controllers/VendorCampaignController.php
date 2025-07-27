<?php

namespace Modules\Campaign\Http\Controllers;

use App\Helpers\FlashMsg;
use DB;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Campaign\Entities\Campaign;
use Modules\Campaign\Entities\CampaignProduct;
use Modules\Campaign\Http\Requests\CampaignValidationRequest;
use Modules\Campaign\Http\Services\GlobalCampaignService;
use Modules\Product\Entities\Product;
use Throwable;

class VendorCampaignController extends Controller
{
    const BASE_URL = 'campaign::vendor.';

    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    public function index()
    {
        $all_campaigns = GlobalCampaignService::fetch_campaigns();

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
            DB::beginTransaction();
            $campaign = Campaign::create($data);

            if ($campaign->id) {
                GlobalCampaignService::insertCampaignProducts($campaign->id, $data['products']);
            }

            DB::commit();

            return back()->with(FlashMsg::create_succeed('Campaign'));
        } catch (Throwable $th) {
            DB::rollBack();

            return back()->with(FlashMsg::create_failed('Campaign'));
        }
    }

    public function edit($item)
    {
        return GlobalCampaignService::renderCampaignProduct(self::BASE_URL, $item);
    }

    public function update(CampaignValidationRequest $request): RedirectResponse
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            Campaign::findOrFail($request->id)->update($data);
            GlobalCampaignService::updateCampaignProducts($request->id, $data);

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

            return back()->with(FlashMsg::delete_succeed('Campaign'));
        } catch (Throwable $th) {
            DB::rollBack();

            return false;
        }
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

    public function getProductPrice(Request $request): JsonResponse
    {
        $price = Product::findOrFail($request->id)->price;

        return response()->json(['price' => $price], 200);
    }

    public function deleteProductSingle(Request $request): bool
    {
        return (bool) CampaignProduct::findOrFail($request->id)->delete();
    }
}
