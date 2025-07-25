<?php

namespace Modules\Attributes\Http\Controllers;

use App\Helpers\FlashMsg;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Attributes\Entities\Color;

class ColorController extends Controller
{
    private const BASE_PATH = 'attributes::backend.color.';


    public function index(): Factory|View
    {
        $product_colors = Color::all();
        return view(self::BASE_PATH . 'all-color', compact('product_colors'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'color_code' => 'required|string|max:191',
            // 'slug' => 'nullable|string|max:191',
        ]);

        $colorExit = Color::query()
            ->where('name', $request->name)
            ->first();

        if ($colorExit) {
            return back()->with([
                'type' => 'danger',
                'msg' => __('Color already exist with this name.')
            ]);
        }

        $sluggable_text = $request->slug == null ? Str::slug(trim($request->name)) : Str::slug($request->slug);
        $slug = createslug($sluggable_text, model_name: 'Color', is_module: true, module_name: 'Attributes');
        $data['slug'] = $slug;

        $product_color = Color::create([
            'name' => $request->name,
            'color_code' => $request->color_code,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
        ]);

        return $product_color
            ? back()->with(FlashMsg::create_succeed('Product Color'))
            : back()->with(FlashMsg::create_failed('Product Color'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'color_code' => 'required|string|max:191',
            // 'slug' => 'nullable|string|max:191',
        ]);

        $colorExit = Color::query()
            ->where('id', '!=', $request->id)
            ->where('name', $request->name)
            ->first();

        if ($colorExit) {
            return back()->with([
                'type' => 'danger',
                'msg' => __('Color already exist with this name.')
            ]);
        }


        $product_color = Color::findOrFail($request->id);

        if ($product_color->slug != $request->slug) {
            $sluggable_text = Str::slug($request->slug ?? $request->name);
            $new_slug = createslug($sluggable_text, 'Color', true, 'Attributes');
            $request['slug'] = $new_slug;
        }

        $product_color = $product_color->update([
            'name' => $request->name,
            'color_code' => $request->color_code,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
        ]);

        return $product_color
            ? back()->with(FlashMsg::update_succeed('Product Color'))
            : back()->with(FlashMsg::update_failed('Product Color'));
    }

    public function destroy($id): RedirectResponse
    {
        $product_color = Color::findOrFail($id);

        return $product_color->delete()
            ? back()->with(FlashMsg::delete_succeed('Product Color'))
            : back()->with(FlashMsg::delete_failed('Product Color'));
    }

    public function bulk_action(Request $request): JsonResponse
    {
        $all_product_colors = Color::whereIn('id', $request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
