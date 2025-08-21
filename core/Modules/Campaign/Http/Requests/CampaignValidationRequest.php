<?php

namespace Modules\Campaign\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CampaignValidationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'campaign_name' => 'required|string|max:191',
            'campaign_subtitle' => 'required|string',
            'image' => 'required|string',
            'status' => 'required|string',
            'campaign_start_date' => 'required|date',
            'campaign_end_date' => 'required|date|after:campaign_start_date',
            'product_id' => 'required|array|min:1',
            'product_id.*' => 'required|exists:products,id',
            'campaign_price' => 'required|array|min:1',
            'campaign_price.*' => 'required|numeric|min:0',
            'units_for_sale' => 'required|array|min:1',
            'units_for_sale.*' => 'required|integer|min:0',
            'start_date' => 'required|array|min:1',
            'start_date.*' => 'required|date',
            'end_date' => 'required|array|min:1',
            'end_date.*' => 'required|date|after:start_date.*',
            'admin_id' => 'nullable',
            'vendor_id' => 'nullable',
            'type' => 'nullable',
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge(
            [
                'title' => $this->campaign_name,
                'subtitle' => $this->campaign_subtitle,
                'image' => $this->image,
                'status' => $this->status,
                'slug' => strtolower(str_replace(' ', '-', $this->campaign_name)),
            ] + $this->how_is_the_owner()
        );
    }

    public function authorize()
    {
        return true;
    }

    private function userId()
    {
        return Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : \Auth::guard('vendor')->user()->id;
    }

    private function getGuardName(): string
    {
        return Auth::guard('admin')->check() ? 'admin' : 'vendor';
    }

    private function how_is_the_owner(): array
    {
        $arr = [];

        if ($this->getGuardName() == 'admin') {
            $arr = [
                'admin_id' => $this->userId(),
                'vendor_id' => null,
                'type' => $this->getGuardName(),
            ];
        } else {
            $arr = [
                'admin_id' => null,
                'vendor_id' => $this->userId(),
                'type' => $this->getGuardName(),
            ];
        }

        return $arr;
    }
}
