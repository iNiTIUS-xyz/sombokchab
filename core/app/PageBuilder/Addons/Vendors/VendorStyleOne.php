<?php

namespace App\PageBuilder\Addons\Vendors;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\PageBuilderBase;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Modules\Vendor\Entities\Vendor;

class VendorStyleOne extends PageBuilderBase
{
    public function preview_image(): string
    {
        return 'vendors/01.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $vendors = Vendor::select('business_name', 'id')->where('status_id', 1)->get();

        $output .= NiceSelect::get([
            'name' => 'blogs',
            'multiple' => true,
            'label' => __('Shops'),
            'placeholder' =>  __('Select Shop'),
            'options' => $vendors->pluck('business_name', 'id'),
            'value' => $widget_saved_values['blogs'] ?? null,
            'info' => __('Select shop(s) or for all shops leave it empty')
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render(): string
    {
        $all_settings = $this->get_settings();
        // get all vendor lists
        $vendors = Vendor::with('logo', 'cover_photo')
            ->withCount('vendorProductRating')
            ->withAvg('vendorProductRating', 'rating')
            ->where('status_id', 1)
            ->whereIn('id', $all_settings['blogs'])
            ->inRandomOrder()->limit(12)->get();

        return $this->renderBlade("vendor.vendor-style-one", compact('vendors'));
    }

    public function addon_title(): array|string|Translator|Application|null
    {
        return __("Shops Style: 01");
    }
}
