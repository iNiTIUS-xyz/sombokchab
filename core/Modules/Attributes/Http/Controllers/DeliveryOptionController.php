<?php

namespace Modules\Attributes\Http\Controllers;

use App\Helpers\FlashMsg;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attributes\Entities\DeliveryOption;
use Illuminate\Validation\Rule;

class DeliveryOptionController extends Controller
{

    public function index(): Renderable
    {
        $delivery_manages = DeliveryOption::query()
            ->latest()
            ->get();

        return view('attributes::backend.delivery-option.index', compact('delivery_manages'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:191|unique:delivery_options,title',
            'title_km' => 'required|string|max:191|unique:delivery_options,title_km',
            'sub_title' => 'required|string|max:191',
            'sub_title_km' => 'required|string|max:191',
            'icon' => 'required|string|max:191'
        ]);

        $option = DeliveryOption::create($data);

        return $option
            ? back()->with(FlashMsg::create_succeed('Delivery Option'))
            : back()->with(FlashMsg::create_failed('Delivery Option'));
    }

    public function update(Request $request): RedirectResponse
    {
        $id = $request->id;

        $data = $request->validate([
            'title' => [
                'required',
                'string',
                'max:191',
                Rule::unique('delivery_options', 'title')->ignore($id)
            ],
            'title_km' => [
                'required',
                'string',
                'max:191',
                Rule::unique('delivery_options', 'title_km')->ignore($id)
            ],
            'sub_title' => 'required|string|max:191',
            'sub_title_km' => 'required|string|max:191',
            'icon' => 'required|string|max:191'
        ]);

        $option = DeliveryOption::findOrFail($id);
        $updated = $option->update($data);

        return $updated
            ? back()->with(FlashMsg::update_succeed('Delivery Option'))
            : back()->with(FlashMsg::update_failed('Delivery Option'));
    }

    public function destroy(DeliveryOption $item): RedirectResponse
    {
        return $item->delete()
            ? back()->with(FlashMsg::delete_succeed('Product Unit'))
            : back()->with(FlashMsg::delete_failed('Product Unit'));
    }

    public function bulk_action(Request $request): bool
    {
        $units = DeliveryOption::whereIn('id', $request->ids)->get();
        foreach ($units as $unit) {
            $unit->delete();
        }
        return true;
    }
}
