<?php

namespace Modules\Attributes\Http\Controllers;

use App\Helpers\FlashMsg;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Attributes\Entities\Unit;
use Illuminate\Contracts\Support\Renderable;

class UnitController extends Controller
{

    public function index(): Renderable
    {
        $product_units = Unit::query()
            ->latest()
            ->get();

        return view('attributes::backend.unit.index', compact('product_units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191|unique:units',
            'name_km' => 'required|string|max:191|unique:units'
        ]);

        $unit = Unit::create([
            'name' => sanitize_html($request->name),
            'name_km' => sanitize_html($request->name_km)
        ]);
        return $unit
            ? back()->with(FlashMsg::create_succeed('Product Unit'))
            : back()->with(FlashMsg::create_failed('Product Unit'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:units,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('units', 'name')->ignore($request->id),
            ],
            'name_km' => [
                'required',
                'string',
                'max:255',
                Rule::unique('units', 'name_km')->ignore($request->id),
            ],
        ]);

        $unit = Unit::findOrFail($request->id)->update([
            'name' => $request->name,
            'name_km' => $request->name_km
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
