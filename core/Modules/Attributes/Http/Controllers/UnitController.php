<?php

namespace Modules\Attributes\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\Attributes\Entities\Unit;

class UnitController extends Controller {

    public function index(): Renderable {
        $product_units = Unit::query()
            ->latest()
            ->get();

        return view('attributes::backend.unit.index', compact('product_units'));
    }

    public function store(Request $request) {
        $request->validate([
            'name'    => 'required|string|max:191|unique:units',
            'name_km' => 'required|string|max:191|unique:units',
        ]);

        $unit = Unit::create([
            'name'    => sanitize_html($request->name),
            'name_km' => sanitize_html($request->name_km),
        ]);
        return $unit
        ? back()->with([
            'message'    => 'Product Unit Created Successfully.',
            'alert-type' => 'success',
        ])
        : back()->with([
            'message'    => 'Product Unit Creation Failed.',
            'alert-type' => 'error',
        ]);
    }

    public function update(Request $request) {
        $request->validate([
            'id'      => 'required|exists:units,id',
            'name'    => [
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
            'name'    => $request->name,
            'name_km' => $request->name_km,
        ]);

        return $unit
        ? back()->with([
            'message'    => 'Product Unit Updated Successfully.',
            'alert-type' => 'success',
        ])
        : back()->with([
            'message'    => 'Product Unit Updating Failed.',
            'alert-type' => 'error',
        ]);
    }

    public function destroy(Unit $item): RedirectResponse {
        return $item->delete()
        ? back()->with([
            'message'    => 'Product Unit Deleted Successfully.',
            'alert-type' => 'success',
        ])
        : back()->with([
            'message'    => 'Product Unit Deleting Failed.',
            'alert-type' => 'error',
        ]);
    }

    public function bulk_action(Request $request): bool {
        $units = Unit::whereIn('id', $request->ids)->get();
        foreach ($units as $unit) {
            $unit->delete();
        }
        return true;
    }
}
