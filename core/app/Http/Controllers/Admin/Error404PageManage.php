<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class Error404PageManage extends Controller {
    public function error_404_page_settings() {
        return view('backend.pages.404.404-page-settings');
    }

    public function update_error_404_page_settings(Request $request) {
        $field_rules = [
            'error_404_page_title'       => 'nullable|string',
            'error_404_page_image'       => 'nullable|string',
            'error_404_page_button_text' => 'nullable|string',
        ];

        $request->validate($field_rules);

        foreach ($field_rules as $field => $rule) {
            update_static_option($field, $request->$field);
        }

        return redirect()->back()->with([
            'message'    => __('Settings updated successfully.'),
            'alert-type' => 'success',
        ]);
    }
}
