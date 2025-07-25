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
use Illuminate\Routing\Controller;
use Modules\Campaign\Entities\Campaign;
use Modules\Campaign\Entities\CampaignProduct;
use Modules\Campaign\Http\Requests\CampaignValidationRequest;
use Modules\Campaign\Http\Services\GlobalCampaignService;
use Modules\Product\Entities\Product;
use Throwable;

class CampaignController extends Controller
{
    const BASE_URL = 'campaign::backend.';

    public function index()
    {
        $all_campaigns = GlobalCampaignService::fetch_campaigns(); //Campaign::with("campaignImage")->get();

        return view(self::BASE_URL . 'all', compact('all_campaigns'));
    }

    public function create(): View|Factory|Application
    {
        return GlobalCampaignService::renderCampaignProduct(self::BASE_URL);
    }

    public function store(CampaignValidationRequest $request)
    {
        $data = $request->validated();

        try {
            $existCampaign = Campaign::query()
                ->where('title', $request->title)
                ->first();

            if ($existCampaign) {
                return back()->with([
                    'type' => 'danger',
                    'msg' => __('Campaign already exist with this title.')
                ]);
            }

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

    public function edit($item): Application|Factory|View
    {
        return GlobalCampaignService::renderCampaignProduct(self::BASE_URL, $item);
    }

    public function update(CampaignValidationRequest $request)
    {
        $data = $request->validated();

        $existCampaign = Campaign::query()
            ->where('id', '!=', $request->id)
            ->where('title', $request->title)
            ->first();

        if ($existCampaign) {
            return back()->with([
                'type' => 'danger',
                'msg' => __('Campaign already exist with this title.')
            ]);
        }


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
