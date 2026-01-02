<?php

namespace App\PageBuilder\Addons\Campaign;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\PageBuilderBase;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Modules\Campaign\Entities\Campaign;

class CampaignStyleTwo extends PageBuilderBase
{
    public function preview_image(): string
    {
        return 'campaign/campaign-style-two.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $campaigns = Campaign::query()
            ->where('status', 'publish')
            // ->whereNull('vendor_id')
            ->latest('id')
            ->pluck('title', 'id')
            ->toArray();

        // Section title
        $output .= Text::get([
            'name' => 'section_title',
            'label' => __('Section Title'),
            'value' => $widget_saved_values['section_title'] ?? null,
        ]);

        // Multi select campaigns (optional)
        $output .= NiceSelect::get([
            'name' => 'campaigns',
            'multiple' => true,
            'label' => __('Campaigns'),
            'placeholder' => __('Select Campaigns'),
            'options' => $campaigns,
            'value' => $widget_saved_values['campaigns'] ?? [],
            'info' => __('Select campaigns to feature. Leave empty to show all campaigns.'),
        ]);

        // Limit (optional)
        $output .= Text::get([
            'name' => 'limit',
            'label' => __('Limit of Campaigns'),
            'value' => $widget_saved_values['limit'] ?? null,
            'info' => __('Set a number to show only the latest N campaigns. Leave empty to show all campaigns.'),
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render(): string
    {
        $all_settings = $this->get_settings();

        $section_title = SanitizeInput::esc_html($all_settings['section_title'] ?? '');
        $selectedCampaigns = $all_settings['campaigns'] ?? [];

        // limit: empty => load all, otherwise load N campaigns
        $limit = $all_settings['limit'] ?? null;
        $limit = is_numeric($limit) && (int) $limit > 0 ? (int) $limit : null;

        $campaignQuery = Campaign::query()
            ->where('status', 'publish')
            // ->whereNull('vendor_id')
            ->whereNotNull('end_date')
            ->where('end_date', '>', Carbon::now()); // only active campaigns

        // If campaigns are selected, filter by them
        if (!empty($selectedCampaigns)) {
            $campaignQuery->whereIn('id', $selectedCampaigns);
        }

        // Always show campaigns ending first
        $campaignQuery->orderBy('end_date', 'asc');

        // Apply limit if set
        if (!is_null($limit)) {
            $campaignQuery->limit($limit);
        }

        $campaigns = $campaignQuery->get();

        return $this->renderBlade(
            'campaign/campaign-style-two',
            compact('campaigns', 'section_title')
        );
    }

    public function addon_title(): array|string|Translator|Application|null
    {
        return __('Campaign Grid List');
    }
}
