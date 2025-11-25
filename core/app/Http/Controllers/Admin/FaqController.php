<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FaqController extends Controller {
    public function index() {
        $all_faqs = Faq::query()
            ->latest()
            ->get();

        return view('backend.pages.faqs')->with('all_faqs', $all_faqs);
    }

    public function store(Request $request) {
        $request->validate([
            'title'          => 'required|string',
            'title_km'       => 'required|string',
            'description'    => 'required|string',
            'description_km' => 'required|string',
            'status'         => 'nullable|string|max:191',
        ]);

        Faq::create([
            'title'          => $request->title,
            'title_km'       => $request->title_km,
            'description'    => $request->description,
            'description_km' => $request->description_km,
            'status'         => $request->status,
            'is_open'        => !empty($request->is_open) ? 'on' : '',
        ]);

        return redirect()->back()->with([
            'message'    => __('FAQ added successfully.'),
            'alert-type' => 'success',
        ]);
    }

    public function update(Request $request) {

        $request->validate([
            'title'          => 'required|string',
            'title_km'       => 'required|string',
            'description'    => 'required|string',
            'description_km' => 'required|string',
            'status'         => 'nullable|string|max:191',
        ]);

        Faq::find($request->id)->update([
            'title'          => $request->title,
            'title_km'       => $request->title_km,
            'description'    => $request->description,
            'description_km' => $request->description_km,
            'status'         => $request->status,
            'is_open'        => !empty($request->is_open) ? 'on' : '',
        ]);

        return redirect()->back()->with([
            'message'    => __('FAQ updated successfully.'),
            'alert-type' => 'success',
        ]);
    }

    public function delete($id) {
        Faq::find($id)->delete();

        return redirect()->back()->with([
            'message'    => __('FAQ deleted successfully.'),
            'alert-type' => 'error',
        ]);
    }

    public function clone (Request $request) {
        $faq_item = Faq::find($request->item_id);
        Faq::create([
            'title'       => $faq_item->title,
            'description' => $faq_item->description,
            'status'      => 'draft',
            'is_open'     => !empty($faq_item->is_open) ? 'on' : '',
        ]);

        return redirect()->back()->with([
            'message'    => __('FAQ clone successfully.'),
            'alert-type' => 'success',
        ]);
    }

    public function bulk_action(Request $request) {
        $all = Faq::find($request->ids);
        foreach ($all as $item) {
            $item->delete();
        }

        return response()->json(['status' => 'ok']);
    }

    public function statusChange(Request $request, $id) {
        Faq::find($id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with([
            'alert-type' => 'success',
            'message'    => __('FAQ status changed successfully.'),
        ]);
    }
}
