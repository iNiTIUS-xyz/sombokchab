<?php

namespace Modules\Attributes\Http\Controllers;

use App\Helpers\FlashMsg;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attributes\Entities\Unit;

class UnitController extends Controller
{

    public function index(): Renderable
    {
        $product_units = Unit::all();
        return view('attributes::backend.unit.index', compact('product_units'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:191|unique:units'
        ]);

        $unit = Unit::create(['name' => sanitize_html($request->name)]);
        return $unit
            ? back()->with(FlashMsg::create_succeed('Product Unit'))
            : back()->with(FlashMsg::create_failed('Product Unit'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|exists:units',
        ]);

        $unit = Unit::findOrFail($request->id)->update([
            'name' => $request->name
        ]);

        return $unit
            ? back()->with(FlashMsg::update_succeed('Product Unit'))
            : back()->with(FlashMsg::update_failed('Product Unit'));
    }

    public function destroy(Unit $item): RedirectResponse
    {
        return $item->delete()
            ? back()->with(FlashMsg::delete_succeed('Product Unit'))
            : back()->with(FlashMsg::delete_failed('Product Unit'));
    }

    public function bulk_action(Request $request): bool
    {
        $units = Unit::whereIn('id', $request->ids)->get();
        foreach ($units as $unit) {
            $unit->delete();
        }
        return true;
    }
}
