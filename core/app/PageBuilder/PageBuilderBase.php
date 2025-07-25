<?php


namespace App\PageBuilder;


use App\Helpers\LanguageHelper;
use App\PageBuilder;
use App\PageBuilder\Helpers\Traits\HelpersFunctions;
use App\PageBuilder\Helpers\Traits\NullSafeSettingsValue;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\Helpers\Traits\RenderViewString;
use App\PageBuilder\Helpers\Traits\RepeaterFieldValue;
use App\PageBuilder\Helpers\Traits\FieldSanitizationHelper;

abstract class PageBuilderBase
{
    use NullSafeSettingsValue,
        RepeaterHelper,
        RenderViewString,
        RepeaterFieldValue,
        FieldSanitizationHelper,
        HelpersFunctions;
    protected $args;
    protected $rand_number;
    public $base_preview_image_path;

    public function __construct(array $args=[])
    {
        $defaults = [
            'id' => '',
            'name' => $this->addon_name(),
            'type' =>'',
            'order' =>'',
            'location' =>'',
            'page_id' =>'',
            'page_type' =>'',
            'before' => true,
            'after' => true
        ];
        $this->args = array_merge($defaults,$args);
        $this->base_preview_image_path = asset('assets/backend/page-builder');
        try {
            $this->rand_number = random_int(999, 99999);
        } catch (\Exception $e) {

        }
    }

    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    abstract public function preview_image();

    /**
     * admin_render
     * this method must have to implement by all widget to render admin panel widget content
     * @since 1.0.0
     * */
    abstract public function admin_render();

    /**
     * frontend_render
     * this method must have to implement by all widget to render frontend widget content
     * @since 1.0.0
     * */
    abstract public function frontend_render();
    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    abstract public function addon_title();
    /**
     * addon_name
     * get addon name from class name
     * @since 1.0.0
     * */
    public function addon_name()
    {
        return substr(strrchr(static::class, "\\"),1);
    }
    /**
     * addon_namespace
     *  get addon class namespace
     * @since 1.0.0
     * */
    public function addon_namespace()
    {
        return static::class;
    }
    /**
     * widget_name
     * this method must have to implement by all widget to register widget name
     * @since 1.0.0
     * */
    public function enable() : bool
    {
        //  Implement widget_name() method.
        return true;
    }

    /**
     * default_fields
     * this method will return all the default field required by any widget
     * @since 1.0.0
     * */
    public function default_fields(): string
    {
        //all initial field
        $output = '';
        $output .= !empty($this->args['id']) ? '<input type="hidden" name="id" value="' . $this->args['id'] . '">' : '';
        $output .= '<input type="hidden" value="' . $this->args['name'] . '" name="addon_name">';
        $output .= '<input type="hidden" value="' . base64_encode($this->args['namespace']) . '" name="addon_namespace">';
        $output .= '<input type="hidden" value="' . $this->args['type'] . '" name="addon_type">';
        $output .= '<input type="hidden" value="' . $this->args['location'] . '" name="addon_location">';
        $output .= '<input type="hidden" value="' . $this->args['order'] . '" name="addon_order">';
        $output .= '<input type="hidden" value="' . $this->args['page_id'] . '" name="addon_page_id">';
        $output .= '<input type="hidden" value="' . $this->args['page_type'] . '" name="addon_page_type">';

        return $output;
    }
    /**
     * get_settings
     * this method will return all the settings value saved for widget
     * @since 1.0.0
     * */

     public function get_settings()
     {
         $widget_data = !empty($this->args['id']) ? PageBuilder::find($this->args['id']) : [];
         
         // $widget_content_data = $this->repairSerializeString($widget_data?->widget_content);
         
         // $widget_data = !empty($widget_data) && $this->is_serialized($widget_content_data)!==false ? unserialize($widget_content_data,['class' => false]) : [];
         
         //  $widget_data = !empty($widget_data) ? $this->repairSerializeString($widget_data?->addon_settings,['class' => false]) : [];
          
         $widget_data = !empty($widget_data) ? unserialize($widget_data->addon_settings,['class' => false]) : [];
         return $widget_data;
     }

    /**
     * widget_before
     * this method will add widget before html markup for widget in frontend
     * @since 1.0.0
     */
    public function addon_area_before($class = null)
    {
        return '<div class="'.$class.' '.$this->args['location'].'-addon '.$this->args['page_type'].'-page-builder-addon">';
    }

    /**
     * widget_after
     * this method will add widget after html markup for widget in frontend
     * @since 1.0.0
     */
    public function addon_area_after()
    {
        return '</div>';
    }

    /**
     * admin_form_start
     * this method will init form markup for admin panel
     * @since 1.0.0
     */

    public function admin_form_start(): string
    {
        return '<form method="post" action="' . route('admin.page.builder.' . $this->args['type']). '" enctype="multipart/form-data"><input type="hidden" value="' . csrf_token() . '" name="_token">';
    }

    /**
     * admin_form_end
     * this method will end tag form markup for admin panel
     * @since 1.0.0
     */
    public function admin_form_end(): string
    {
        return '</form>';
    }

    /**
     * admin_form_submit_button
     * this method will add a submit button for widget in admin panel
     * @since 1.0.0
     */

    public function admin_form_submit_button($text = null): string
    {
        $button_text = $text ?? __('Save Changes');
        return '<button class="btn btn-primary btn-lg btn-md widget_save_change_button">' . $button_text . '</button>';
    }

    /**
     * admin_form_submit_button
     * this method will add a submit button for widget in admin panel
     * @since 1.0.0
     */

    public function admin_language_tab(): string
    {
        $all_languages = LanguageHelper::all_languages();
        $output = '<nav><div class="nav nav-tabs" role="tablist">';
        foreach ($all_languages as $key => $lang) {
            $active_class = $key == 0 ? 'nav-item nav-link active' : 'nav-item nav-link';
            $output .= '<a class="' . $active_class . '"  data-bs-toggle="tab" href="#nav-home-'. $lang->slug .$this->rand_number. '" role="tab"  aria-selected="true">' . $lang->name . '</a>';
        }
        $output .= '</div></nav>';
        return $output;
    }
    /**
     * admin_language_tab_start
     * this method will add language tab content start wrapper
     * @since 1.0.0
     * */

    public function admin_language_tab_start(){
        return '<div class="tab-content margin-top-30" >';
    }

    /**
     * admin_language_tab_end
     * this method will add language tab content end wrapper
     * @since 1.0.0
     * */
    public function admin_language_tab_end(){
        return '</div>';
    }

    /**
     * admin_language_tab_content_start
     * this method will add language tab panel start
     * @since 1.0.0
     * */

    public function admin_language_tab_content_start($args){
        return  '<div class="' . $args['class'] . '" id="'. $args['id'] .$this->rand_number .'" role="tabpanel">';
    }
    /**
     * admin_language_tab_content_end
     * this method will add language tab panel end
     * @since 1.0.0
     * */
    public function admin_language_tab_content_end(){
        return '</div>';
    }


    public function admin_form_before(){
        $markup = '';
        if ($this->args['before']){
            $markup .= '<li class="ui-state-default widget-handler" data-name="'.$this->addon_name().'">';
        }
        $markup .= '<h4 class="top-part"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>'.$this->addon_title().'</h4>
        <span class="expand"><i class="ti-angle-down"></i></span>
        <span class="remove-widget"><i class="ti-close"></i></span>
        <div class="content-part">';
        return $markup;
    }
    public function admin_form_after(): string
    {
        $markup = '</div>';
        if ($this->args['after']){
            $markup .= '</li>';
        }
        return $markup;
    }

    public function get_preview_image($image_name): string
    {
        if (empty($image_name)){return '';}
        return '<a href="'.$this->base_preview_image_path.'/'.$image_name.'" title="'.__('preview of this addon').'" class="preview-image"><i class="fas fa-image"></i></a>';
    }
    
        private function format_widget_content($data)
    {
        if (!$this->check_json($data))
        {
            $unserialized = unserialize($data);
            return json_encode($unserialized);
        }

        return $data;
    }


    private function check_json($data): bool
    {
        json_decode($data);
        return json_last_error() === JSON_ERROR_NONE; // if true json is valid, false if json is not valid
    }
    
      public function repairSerializeString($value)
    {

        $data = preg_replace_callback(
            '/(?<=^|\{|;)s:(\d+):\"(.*?)\";(?=[asbdiO]\:\d|N;|\}|$)/s',
            function($m){
                return 's:' . strlen($m[2]) . ':"' . $m[2] . '";';
            },
            $value
        );

        return $data;
    }
    
    private function is_serialized( $data, $strict = true ) {
    // If it isn't a string, it isn't serialized.
    if ( ! is_string( $data ) ) {
        return false;
    }
    $data = trim( $data );
    if ( 'N;' === $data ) {
        return true;
    }
    if ( strlen( $data ) < 4 ) {
        return false;
    }
    if ( ':' !== $data[1] ) {
        return false;
    }
    if ( $strict ) {
        $lastc = substr( $data, -1 );
        if ( ';' !== $lastc && '}' !== $lastc ) {
            return false;
        }
    } else {
        $semicolon = strpos( $data, ';' );
        $brace     = strpos( $data, '}' );
        // Either ; or } must exist.
        if ( false === $semicolon && false === $brace ) {
            return false;
        }
        // But neither must be in the first X characters.
        if ( false !== $semicolon && $semicolon < 3 ) {
            return false;
        }
        if ( false !== $brace && $brace < 4 ) {
            return false;
        }
    }
    $token = $data[0];
    switch ( $token ) {
        case 's':
            if ( $strict ) {
                if ( '"' !== substr( $data, -2, 1 ) ) {
                    return false;
                }
            } elseif ( false === strpos( $data, '"' ) ) {
                return false;
            }
            // Or else fall through.
        case 'a':
        case 'O':
            return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
        case 'b':
        case 'i':
        case 'd':
            $end = $strict ? '$' : '';
            return (bool) preg_match( "/^{$token}:[0-9.E+-]+;$end/", $data );
    }
    return false;
    }
}
