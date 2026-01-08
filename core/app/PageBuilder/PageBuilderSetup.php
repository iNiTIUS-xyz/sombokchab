<?php

namespace App\PageBuilder;

use ErrorException;
use App\PageBuilder;
use Illuminate\Support\Facades\Cache;
use App\PageBuilder\Addons\Blog\BlogStyleOne;
use App\PageBuilder\Addons\Blog\BlogStyleTwo;
use App\PageBuilder\Addons\Banner\BannerSeven;
use App\PageBuilder\Addons\Brand\BrandStyleOne;
use App\PageBuilder\Addons\Brand\BrandStyleTwo;
use App\PageBuilder\Addons\Brand\ChooseBrandOne;
use App\PageBuilder\Addons\shop\BestSellingShop;
use App\PageBuilder\Addons\Banner\BannerStyleNine;
use App\PageBuilder\Addons\banners\BannerStyleFor;
use App\PageBuilder\Addons\banners\BannerStyleOne;
use App\PageBuilder\Addons\banners\BannerStyleSix;
use App\PageBuilder\Addons\banners\BannerStyleTwo;
use App\PageBuilder\Addons\Header\HeaderSliderSix;
use App\PageBuilder\Addons\Vendors\VendorStyleOne;
use App\PageBuilder\Addons\banners\BannerStyleFive;
use App\PageBuilder\Addons\banners\BannerStyleEight;
use App\PageBuilder\Addons\banners\BannerStyleSeven;
use App\PageBuilder\Addons\IconBox\IconBoxStyleFour;
use App\PageBuilder\Addons\products\ProductStyleFor;
use App\PageBuilder\Addons\products\ProductStyleOne;
use App\PageBuilder\Addons\products\ProductStyleTwo;
use App\PageBuilder\Addons\Campaign\CampaignStyleOne;
use App\PageBuilder\Addons\Campaign\CampaignStyleTwo;
use App\PageBuilder\Addons\IconBox\IconBoxStyleThree;
use App\PageBuilder\Addons\products\ProductStyleFive;
use App\PageBuilder\Addons\products\ProductStyleThree;
use App\PageBuilder\Addons\sliders\header\HeaderStyleOne;
use App\PageBuilder\Addons\categories\ChooseByCategoryOne;
use App\PageBuilder\Addons\categories\ChooseByCategoryTwo;
use App\PageBuilder\Addons\Product\PopularProductStyleTwo;
use App\PageBuilder\Addons\products\ProductFilterStyleOne;
use App\PageBuilder\Addons\products\ProductFilterStyleTwo;
use App\PageBuilder\Addons\Campaign\LeftSideCampaignSlider;
use App\PageBuilder\Addons\products\PopularProductStyleOne;
use App\PageBuilder\Addons\ImageGallery\ImageGalleryStyleOne;
use App\PageBuilder\Addons\deliveryOptions\DeliveryOptionStyleOne;

class PageBuilderSetup
{
    private static function registerd_widgets(): array
    {
        //check module wise widget by set condition
        return [
            PageBuilder\Addons\Example\ExampleAddonStyleOne::class,

            // about section addons
            PageBuilder\Addons\AboutSection\AboutSectionStyleOne::class,
            PageBuilder\Addons\AboutSection\AboutSectionStyleTwo::class,
            PageBuilder\Addons\AboutSection\TestimonialStyleOne::class,

            // homage page
            HeaderStyleOne::class,
            BlogStyleOne::class,
            BannerStyleOne::class,
            BannerStyleTwo::class,
            BannerStyleFor::class,
            BannerStyleFive::class,
            BannerStyleSix::class,
            BrandStyleOne::class,
            ImageGalleryStyleOne::class,
            DeliveryOptionStyleOne::class,
            LeftSideCampaignSlider::class,
            ProductStyleOne::class,
            ProductStyleTwo::class,
            ProductStyleThree::class,
            ProductFilterStyleOne::class,
            ProductStyleFor::class,

            // those addons are for new home page 04
            HeaderSliderSix::class,
            ChooseByCategoryOne::class,
            CampaignStyleOne::class,
            BannerStyleSeven::class,
            PopularProductStyleOne::class,
            ProductStyleFive::class,
            ChooseBrandOne::class,
            BestSellingShop::class,
            BannerStyleEight::class,
            BlogStyleTwo::class,

            // those addons are for new home page 05
            BannerStyleNine::class,
            PopularProductStyleTwo::class,
            ChooseByCategoryTwo::class,
            IconBoxStyleThree::class,
            ProductFilterStyleTwo::class,
            VendorStyleOne::class,
            CampaignStyleTwo::class,
            BrandStyleTwo::class,
            BannerSeven::class,
            IconBoxStyleFour::class,

            PageBuilder\Addons\ContactArea\ContactAreaStyleOne::class,
            PageBuilder\Addons\ContactArea\MapAreaStyleOne::class,

            PageBuilder\Addons\Page\ShopPage::class,
            PageBuilder\Addons\Page\ShopPageStyleTwo::class,
        ];
    }

    // /**
    //  * @throws ErrorException
    //  */
    // public static function get_admin_panel_widgets(): string
    // {
    //     $widgets_markup = '';
    //     $widget_list = self::registerd_widgets();
    //     foreach ($widget_list as $widget) {
    //         try {
    //             $widget_instance = new $widget();
    //         } catch (\Exception $e) {
    //             $msg = $e->getMessage();

    //             throw new ErrorException($msg);
    //         }
    //         if ($widget_instance->enable()) {
    //             $widgets_markup .= self::render_admin_addon_item([
    //                 'addon_name'      => $widget_instance->addon_name(),
    //                 'addon_namespace' => $widget_instance->addon_namespace(), // new added
    //                 'addon_title'     => $widget_instance->addon_title(),
    //                 'preview_image'   => $widget_instance->get_preview_image($widget_instance->preview_image()),
    //             ]);
    //         }
    //     }

    //     return $widgets_markup;
    // }

    // private static function render_admin_addon_item($args): string
    // {
    //     return '<li class="ui-state-default widget-handler" data-name="' . $args['addon_name'] . '" data-namespace="' . base64_encode($args['addon_namespace']) . '">
    //                 <h4 class="top-part"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>' . $args['addon_title'] . $args['preview_image'] . '</h4>
    //             </li>';
    // }


    /**
     * @throws ErrorException
     */
    public static function get_admin_panel_widgets(): string
    {
        $widgets_markup = '';
        $groups = [];

        foreach (self::registerd_widgets() as $widget) {
            try {
                $widget_instance = new $widget();
            } catch (\Exception $e) {
                throw new ErrorException($e->getMessage());
            }

            if (! $widget_instance->enable()) {
                continue;
            }

            // Group name from namespace
            // App\PageBuilder\Addons\Banner\BannerStyleOne → Banner
            $namespaceParts = explode('\\', $widget);
            $group = $namespaceParts[count($namespaceParts) - 2] ?? 'Other';

            $groups[$group][] = [
                'addon_name'      => $widget_instance->addon_name(),
                'addon_namespace' => $widget_instance->addon_namespace(),
                'addon_title'     => $widget_instance->addon_title(),
                'preview_image'   => $widget_instance->get_preview_image(
                    $widget_instance->preview_image()
                ),
            ];
        }

        // Sort groups alphabetically
        ksort($groups);

        foreach ($groups as $groupName => $addons) {

            // GROUP HEADER (non-draggable)
            $widgets_markup .= '
                <li class="widget-group-header">
                    <strong>' . self::humanizeGroupTitle($groupName) . '</strong>
                </li>
            ';

            // Widgets under group
            foreach ($addons as $addon) {
                $widgets_markup .= self::render_admin_addon_item($addon);
            }
        }

        return $widgets_markup;
    }

    private static function render_admin_addon_item($args): string
    {
        return '<li class="ui-state-default widget-handler"
                    data-name="' . $args['addon_name'] . '"
                    data-namespace="' . base64_encode($args['addon_namespace']) . '">
                    <h4 class="top-part">
                        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                        ' . $args['addon_title'] . $args['preview_image'] . '
                    </h4>
                </li>';
    }

    private static function humanizeGroupTitle(string $group): string
    {
        // AboutArea → About Area
        $group = preg_replace('/(?<!^)([A-Z])/', ' $1', $group);
        return ucwords(trim($group));
    }


    // /**
    //  * @throws ErrorException
    //  */
    // public static function get_admin_panel_widgets(): string
    // {
    //     $groups = [];

    //     foreach (self::registerd_widgets() as $widget) {

    //         if (!class_exists($widget)) {
    //             // skip invalid class
    //             continue;
    //         }

    //         try {
    //             $widget_instance = new $widget();
    //         } catch (\Throwable $e) {
    //             // ❗ DO NOT crash admin panel
    //             logger()->error('Addon load failed', [
    //                 'class' => $widget,
    //                 'error' => $e->getMessage(),
    //             ]);
    //             continue;
    //         }

    //         if (!$widget_instance->enable()) {
    //             continue;
    //         }

    //         // Group name (from namespace)
    //         // App\PageBuilder\Addons\Banner\BannerStyleOne → Banner
    //         $namespaceParts = explode('\\', $widget);
    //         $group = $namespaceParts[count($namespaceParts) - 2] ?? 'Other';

    //         $groups[$group][] = [
    //             'addon_name'      => $widget_instance->addon_name(),
    //             'addon_namespace' => $widget_instance->addon_namespace(),
    //             'addon_title'     => $widget_instance->addon_title(),
    //             'preview_image'   => $widget_instance->get_preview_image(
    //                 $widget_instance->preview_image()
    //             ),
    //         ];
    //     }

    //     // Sort groups alphabetically
    //     ksort($groups);

    //     // Sort addons inside each group
    //     foreach ($groups as &$addons) {
    //         usort($addons, fn ($a, $b) =>
    //             strcmp($a['addon_title'], $b['addon_title'])
    //         );
    //     }

    //     return self::render_admin_addon_accordion($groups);
    // }

    // private static function render_admin_addon_accordion(array $groups): string
    // {
    //     $html = '<div class="accordion w-100" id="addonAccordion">';
    //     $i = 0;

    //     foreach ($groups as $groupName => $addons) {
    //         $collapseId = 'addonCollapse' . $i;

    //         $html .= '
    //         <div class="accordion-item mb-2">
    //             <h2 class="accordion-header">
    //                 <button class="accordion-button '.($i ? 'collapsed' : '').'" 
    //                         type="button"
    //                         data-bs-toggle="collapse"
    //                         data-bs-target="#'.$collapseId.'">
    //                     '.self::humanizeGroupTitle($groupName).'
    //                     <span class="ms-2 badge bg-secondary">'.count($addons).'</span>
    //                 </button>
    //             </h2>

    //             <div id="'.$collapseId.'" 
    //                 class="accordion-collapse collapse '.(!$i ? 'show' : '').'">
    //                 <div class="accordion-body">
    //                     <ul class="sortable widget-list" style="display: block !important;">';
    //         foreach ($addons as $addon) {
    //             $html .= self::render_admin_addon_item($addon);
    //         }

    //         $html .= '
    //                     </ul>
    //                 </div>
    //             </div>
    //         </div>';

    //         $i++;
    //     }

    //     $html .= '</div>';

    //     return $html;
    // }

    // private static function render_admin_addon_item($args): string
    // {
    //     return '<li class="ui-state-default widget-handler w-100 my-1" data-name="' . $args['addon_name'] . '" data-namespace="' . base64_encode($args['addon_namespace']) . '">
    //                 <h4 class="top-part"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>' . $args['addon_title'] . $args['preview_image'] . '</h4>
    //             </li>';
    // }

    // private static function humanizeGroupTitle(string $group): string
    // {
    //     // Insert space before capital letters: AboutArea → About Area
    //     $group = preg_replace('/(?<!^)([A-Z])/', ' $1', $group);

    //     // Capitalize each word
    //     return ucwords(trim($group));
    // }

    public static function render_widgets_by_name_for_admin($args)
    {
        $widget_class = $args['namespace'];
        $instance = new $widget_class($args);
        if ($instance->enable()) {
            return $instance->admin_render();
        }
    }

    public static function render_widgets_by_name_for_frontend($args)
    {
        $widget_class = $args['namespace'];
        $instance = new $widget_class($args);

        if ($instance->enable()) {
            return $instance->frontend_render();
        }
    }

    public static function render_frontend_pagebuilder_content_by_location($location): string
    {
        $output = '';
        $all_widgets = PageBuilder::where(['addon_location' => $location])->orderBy('addon_order', 'ASC')->get();
        foreach ($all_widgets as $widget) {
            $output .= self::render_widgets_by_name_for_frontend([
                'name'      => $widget->addon_name,
                'namespace' => $widget->addon_namespace,
                'location'  => $location,
                'id'        => $widget->id,
                'column'    => $args['column'] ?? false,
            ]);
        }

        // dd(1, $output);

        return $output;
    }

    public static function get_saved_addons_by_location($location): string
    {
        $output = '';
        $all_widgets = PageBuilder::where(['addon_location' => $location])->orderBy('addon_order', 'asc')->get();
        foreach ($all_widgets as $widget) {
            $output .= self::render_widgets_by_name_for_admin([
                'name'      => $widget->addon_name,
                'namespace' => $widget->addon_namespace,
                'id'        => $widget->id,
                'type'      => 'update',
                'order'     => $widget->addon_order,
                'page_type' => $widget->addon_page_type,
                'page_id'   => $widget->addon_page_id,
                'location'  => $widget->addon_location,
            ]);
        }

        return $output;
    }

    public static function get_saved_addons_for_dynamic_page($page_type, $page_id): string
    {
        $output = '';

        // $all_widgets = Cache::remember($page_type . '-' . $page_id, 600, function () use ($page_type, $page_id) {
        //     return PageBuilder::where(['addon_page_type' => $page_type, 'addon_page_id' => $page_id])->orderBy('addon_order', 'asc')->get();
        // });

        $all_widgets = PageBuilder::where(['addon_page_type' => $page_type, 'addon_page_id' => $page_id])->orderBy('addon_order', 'asc')->get();
        foreach ($all_widgets as $widget) {
            $output .= self::render_widgets_by_name_for_admin([
                'name'      => $widget->addon_name,
                'namespace' => $widget->addon_namespace,
                'id'        => $widget->id,
                'type'      => 'update',
                'order'     => $widget->addon_order,
                'page_type' => $widget->addon_page_type,
                'page_id'   => $widget->addon_page_id,
                'location'  => $widget->addon_location,
            ]);
        }

        return $output;
    }

    public static function render_frontend_pagebuilder_content_for_dynamic_page($page_type, $page_id): string
    {
        $output = '';
        // $all_widgets = Cache::remember($page_type . '-' . $page_id, 600, function () use ($page_type, $page_id) {
        //     return PageBuilder::where(['addon_page_type' => $page_type, 'addon_page_id' => $page_id])->orderBy('addon_order', 'asc')->get();
        // });

        $all_widgets = PageBuilder::where(['addon_page_type' => $page_type, 'addon_page_id' => $page_id])->orderBy('addon_order', 'asc')->get();
        foreach ($all_widgets as $widget) {
            $output .= self::render_widgets_by_name_for_frontend([
                'name'      => $widget->addon_name,
                'namespace' => $widget->addon_namespace,
                // 'location' => $location,
                'id'        => $widget->id,
                'column'    => $args['column'] ?? false,
            ]);
        }

        return $output;
    }
}
