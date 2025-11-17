<?php

namespace Modules\Attributes\Http\Controllers;

use App\Helpers\FlashMsg;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attributes\Entities\Brand;
use Modules\Attributes\Http\Requests\BrandStoreRequest;

class BrandController extends Controller
{

    public function index(): Renderable
    {
        $brands = Brand::query()
            ->with(["logo", "banner"])
            ->latest()
            ->get();

        return view('attributes::backend.brand.index', compact('brands'));
    }

    public function store(BrandStoreRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = strtolower(str_replace(' ', '-', $request->name));

        $brandExit = Brand::query()
            ->where('name', $request->name)
            ->first();

        if ($brandExit) {
            return back()->with([
                'type' => 'danger',
                'msg' => __('Brand already exist with this name.')
            ]);
        }

        $brand = Brand::create($data);
        return $brand
            ? back()->with(FlashMsg::create_succeed('Brand'))
            : back()->with(FlashMsg::create_failed('Brand'));
    }

    public function update(BrandStoreRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = strtolower(str_replace(' ', '-', $request->name));

        $brandExit = Brand::query()
            ->where('id', '!=', $request->id)
            ->where('name', $request->name)
            ->first();

        if ($brandExit) {
            return back()->with([
                'type' => 'danger',
                'msg' => __('Brand already exist with this name.')
            ]);
        }

        $brand = Brand::findOrFail($request->id)->update($data);

        return $brand
            ? back()->with(FlashMsg::update_succeed('Brand'))
            : back()->with(FlashMsg::update_failed('Brand'));
    }

    public function destroy(Brand $item)
    {
        return $item->delete()
            ? back()->with(FlashMsg::delete_succeed('Brand'))
            : back()->with(FlashMsg::delete_failed('Brand'));
    }

    public function bulk_action(Request $request): bool
    {
        $units = Brand::whereIn('id', $request->ids)->get();
        foreach ($units as $unit) {
            $unit->delete();
        }
        return true;
    }
}
