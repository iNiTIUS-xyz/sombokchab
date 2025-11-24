<?php

namespace Modules\Attributes\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\Attributes\Entities\DeliveryOption;

class DeliveryOptionController extends Controller {

    public function index(): Renderable {
        $delivery_manages = DeliveryOption::query()
            ->latest()
            ->get();

        return view('attributes::backend.delivery-option.index', compact('delivery_manages'));
    }

    public function store(Request $request): RedirectResponse {
        $data = $request->validate([
            'title'        => 'required|string|max:191|unique:delivery_options,title',
            'title_km'     => 'required|string|max:191|unique:delivery_options,title_km',
            'sub_title'    => 'required|string|max:191',
            'sub_title_km' => 'required|string|max:191',
            'icon'         => 'required|string|max:191',
        ]);

        $option = DeliveryOption::create($data);

        return $option
        ? back()->with([
            'message'    => 'Delivery Option Created Successfully.',
            'alert-type' => 'success',
        ])
        : back()->with([
            'message'    => 'Delivery Option Creation Failed.',
            'alert-type' => 'error',
        ]);
    }

    public function update(Request $request): RedirectResponse {
        $id = $request->id;

        $data = $request->validate([
            'title'        => [
                'required',
                'string',
                'max:191',
                Rule::unique('delivery_options', 'title')->ignore($id),
            ],
            'title_km'     => [
                'required',
                'string',
                'max:191',
                Rule::unique('delivery_options', 'title_km')->ignore($id),
            ],
            'sub_title'    => 'required|string|max:191',
            'sub_title_km' => 'required|string|max:191',
            'icon'         => 'required|string|max:191',
        ]);

        $option = DeliveryOption::findOrFail($id);
        $updated = $option->update($data);

        return $updated
        ? back()->with([
            'message'    => 'Delivery Option Updated Successfully.',
            'alert-type' => 'success',
        ])
        : back()->with([
            'message'    => 'Delivery Option Updating Failed.',
            'alert-type' => 'error',
        ]);
    }

    public function destroy(DeliveryOption $item): RedirectResponse {
        return $item->delete()
        ? back()->with([
            'message'    => 'Delivery Option Deleted Successfully.',
            'alert-type' => 'success',
        ])
        : back()->with([
            'message'    => 'Delivery Option Deleting Failed.',
            'alert-type' => 'error',
        ]);
    }

    public function bulk_action(Request $request): bool {
        $units = DeliveryOption::whereIn('id', $request->ids)->get();
        foreach ($units as $unit) {
            $unit->delete();
        }
        return true;
    }
}
