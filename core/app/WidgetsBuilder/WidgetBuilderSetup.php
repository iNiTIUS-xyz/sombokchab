<?php


namespace App\WidgetsBuilder;

class WidgetBuilderSetup
{
    private static function registerd_widgets()
    {
        return [
            'AboutUsWidget',
            'ContactInfoWidget',
            'NavigationMenuWidget',
            'RecentBlogPostWidget',
            'RawHTMLWidget',
            'ImageWidget',
            'BlogSearchWidget',
            'BlogCategoryWidget',
            'BlogTagWidget',
            'NewsletterWidget',
            'AboutUsWidgetTwo'
        ];
    }

    private static function registerd_sidebars()
    {
        return [
            'footer',
            'blog'
        ];
    }

    public static function get_admin_widget_sidebar_list()
    {
        $all_sidebar = self::registerd_sidebars();
        $output = '';
        foreach ($all_sidebar as $sidebar) {
            $output .= self::render_admin_sidebar_item($sidebar);
        }
        return $output;
    }

    // public static function get_admin_panel_widgets()
    // {
    //     $widgets_markup = '';
    //     $widget_list = self::registerd_widgets();
    //     foreach ($widget_list as $widget) {
    //         $namespace = __NAMESPACE__ . "\Widgets\\" . $widget;
    //         $widget_instance = new  $namespace();
    //         $widgets_markup .= self::render_admin_widget_item([
    //             'widget_name' => $widget_instance->widget_name(),
    //             'widget_title' => $widget_instance->widget_title()
    //         ]);
    //     }
    //     return $widgets_markup;
    // }

    public static function get_admin_panel_widgets()
    {
        // 1) Collect widget name/title pairs
        $widgets = [];
        foreach (self::registerd_widgets() as $widgetClass) {
            $fqcn = __NAMESPACE__ . "\\Widgets\\{$widgetClass}";
            $inst = new $fqcn();

            $widgets[] = [
                'name'  => $inst->widget_name(),
                'title' => $inst->widget_title(),
            ];
        }

        // 2) Sort by title ascending
        usort($widgets, function($a, $b) {
            return strcmp($a['title'], $b['title']);
        });

        // 3) Render sorted widgets
        $widgets_markup = '';
        foreach ($widgets as $w) {
            $widgets_markup .= self::render_admin_widget_item([
                'widget_name'  => $w['name'],
                'widget_title' => $w['title'],
            ]);
        }

        return $widgets_markup;
    }

    private static function render_admin_widget_item($args)
    {
        return '<li class="ui-state-default widget-handler" data-name="' . $args['widget_name'] . '">
                    <h4 class="top-part"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>' . $args['widget_title'] . '</h4>
                </li>';
    }

    public static function render_admin_sidebar_item($sidebar)
    {
        $markup = '<div class="card">
                    <div class="card-header widget-area-header">
                        <h4 class="header-title">' . ucfirst(str_replace(['-', '_'], [' ', ' '], $sidebar)) . ' ' . __('Widgets Area') . '</h4>
                        <span class="widget-area-expand"><i class="ti-angle-down"></i></span>
                    </div>
                    <div class="card-body widget-area-body hide">
                        <ul id="' . $sidebar . '" class="sortable available-form-field main-fields sortable_widget_location">
                            ' . render_admin_saved_widgets($sidebar) . '
                        </ul>
                    </div>
                </div>';
        return $markup;
    }

    public static function render_widgets_by_name_for_admin($args)
    {
        //widget_name
        $widget_class = 'App\WidgetsBuilder\Widgets\\' . $args['name'];
        $instance = new $widget_class($args);
        $before = $args['before'] ?? true;
        $after = $args['after'] ?? true;
        return $instance->admin_render(['before' => $before, 'after' => $after]);
    }

    public static function render_widgets_by_name_for_frontend($args)
    {
        //widget_name
        $widget_class = 'App\WidgetsBuilder\Widgets\\' . $args['name'];
        $instance = new $widget_class($args);
        return $instance->frontend_render();
    }
}