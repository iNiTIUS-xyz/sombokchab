<?php

namespace Modules\Attributes\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attributes\Entities\Brand;
use Modules\Attributes\Http\Requests\BrandStoreRequest;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller {

    public function index(): Renderable {
        $brands = Brand::query()
            ->with(["logo", "banner"])
            ->latest()
            ->get();

        return view('attributes::backend.brand.index', compact('brands'));
    }

    // public function store(BrandStoreRequest $request) {
    //     $data = $request->validated();
    //     $data['slug'] = strtolower(str_replace(' ', '-', $request->name));

    //     $brandExit = Brand::query()
    //         ->where('name', $request->name)
    //         ->first();

    //     if ($brandExit) {
    //         return back()->with([
    //             'alert-type' => 'error',
    //             'message'    => __('Brand already exist with this name.'),
    //         ]);
    //     }

    //     $brand = Brand::create($data);
    //     return $brand
    //     ? back()->with([
    //         'message'    => 'Brand Created Successfully.',
    //         'alert-type' => 'success',
    //     ])
    //     : back()->with([
    //         'message'    => 'Brand Creation Failed.',
    //         'alert-type' => 'error',
    //     ]);
    // }

    public function store(Request $request)
    {
        // 🔒 Manual validation
        $validator = Validator::make($request->all(), [
            'name'            => 'required|string|max:255',
            'name_km'         => 'required|string|max:255',
            'description'     => 'required|string',
            'description_km'  => 'required|string',
            'banner_id'       => 'required|integer',
            'image_id'        => 'nullable|integer',
            'title'           => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        /* ===============================
        * SLUG GENERATION
        * =============================== */
        $baseSlug = strtolower(str_replace(' ', '-', $request->name));
        $slug = $baseSlug;

        $count = Brand::where('slug', 'LIKE', $baseSlug . '%')->count();

        if ($count > 0) {
            $slug = $baseSlug . '-' . ($count + 1);
        }

        $data['slug'] = $slug;

        $brand = Brand::create($data);

        return $brand
            ? back()->with([
                'message'    => 'Brand Created Successfully.',
                'alert-type' => 'success',
            ])
            : back()->with([
                'message'    => 'Brand Creation Failed.',
                'alert-type' => 'error',
            ]);
    }


    // public function update(BrandStoreRequest $request) {
    //     $data = $request->validated();
    //     $data['slug'] = strtolower(str_replace(' ', '-', $request->name));

    //     $brandExit = Brand::query()
    //         ->where('id', '!=', $request->id)
    //         ->where('name', $request->name)
    //         ->first();

    //     if ($brandExit) {
    //         return back()->with([
    //             'alert-type' => 'error',
    //             'message'    => __('Brand already exist with this name.'),
    //         ]);
    //     }

    //     $brand = Brand::findOrFail($request->id)->update($data);

    //     return $brand
    //     ? back()->with([
    //         'message'    => 'Brand Updated Successfully.',
    //         'alert-type' => 'success',
    //     ])
    //     : back()->with([
    //         'message'    => 'Brand Updating Failed.',
    //         'alert-type' => 'error',
    //     ]);
    // }

    public function update(Request $request)
    {
        // Manual validation
        $validator = Validator::make($request->all(), [
            'id'              => 'required|exists:brands,id',
            'name'            => 'required|string|max:255',
            'name_km'         => 'required|string|max:255',
            'description'     => 'required|string',
            'description_km'  => 'required|string',
            'banner_id'       => 'required|integer',
            'image_id'        => 'nullable|integer',
            'title'           => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        /* ===============================
        * SLUG GENERATION
        * =============================== */
        $baseSlug = strtolower(str_replace(' ', '-', $request->name));
        $slug = $baseSlug;

        // Exclude current brand from slug check
        $count = Brand::where('id', '!=', $request->id)
            ->where('slug', 'LIKE', $baseSlug . '%')
            ->count();

        if ($count > 0) {
            $slug = $baseSlug . '-' . ($count + 1);
        }

        $data['slug'] = $slug;

        $brand = Brand::findOrFail($request->id)->update($data);

        return $brand
            ? back()->with([
                'message'    => 'Brand Updated Successfully.',
                'alert-type' => 'success',
            ])
            : back()->with([
                'message'    => 'Brand Updating Failed.',
                'alert-type' => 'error',
            ]);
    }

    public function destroy(Brand $item) {
        return $item->delete()
        ? back()->with([
            'message'    => 'Brand Deleted Successfully.',
            'alert-type' => 'success',
        ])
        : back()->with([
            'message'    => 'Brand Deleting Failed.',
            'alert-type' => 'error',
        ]);
    }

    public function bulk_action(Request $request): bool {
        $units = Brand::whereIn('id', $request->ids)->get();
        foreach ($units as $unit) {
            $unit->delete();
        }
        return true;
    }
}
