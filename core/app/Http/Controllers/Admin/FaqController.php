<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FaqController extends Controller
{
    public function index()
    {
        $all_faqs = Faq::query()
            ->latest()
            ->get();

        return view('backend.pages.faqs')->with('all_faqs', $all_faqs);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'nullable|string|max:191',
        ]);

        Faq::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'is_open' => !empty($request->is_open) ? 'on' : '',
        ]);

        return redirect()->back()->with(['msg' => __('FAQ added successfully.'), 'type' => 'success']);
    }

    public function update(Request $request)
    {

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'nullable|string|max:191',
        ]);

        Faq::find($request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'is_open' => !empty($request->is_open) ? 'on' : '',
        ]);

        return redirect()->back()->with(['msg' => __('FAQ updated successfully.'), 'type' => 'success']);
    }

    public function delete($id)
    {
        Faq::find($id)->delete();

        return redirect()->back()->with(['msg' => __('FAQ deleted successfully.'), 'type' => 'danger']);
    }

    public function clone(Request $request)
    {
        $faq_item = Faq::find($request->item_id);
        Faq::create([
            'title' => $faq_item->title,
            'description' => $faq_item->description,
            'status' => 'draft',
            'is_open' => !empty($faq_item->is_open) ? 'on' : '',
        ]);

        return redirect()->back()->with(['msg' => __('FAQ clone successfully.'), 'type' => 'success']);
    }

    public function bulk_action(Request $request)
    {
        $all = Faq::find($request->ids);
        foreach ($all as $item) {
            $item->delete();
        }

        return response()->json(['status' => 'ok']);
    }

    public function statusChange(Request $request, $id)
    {
        Faq::find($id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with([
            'type' => 'success',
            'msg' => __('FAQ status changed successfully.'),
        ]);
    }
}
