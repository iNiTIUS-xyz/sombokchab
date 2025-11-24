<?php

namespace Modules\Badge\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Badge\Entities\Badge;

class BadgeController extends Controller {
    private const BASE_PATH = 'badge::admin.badge.';

    public function index() {
        $badges = Badge::all();
        return view(self::BASE_PATH . 'index', compact('badges'));
    }

    public function store(Request $request) {
        $request->validate(
            [
                'name'       => 'required',
                'sale_count' => 'nullable|numeric',
                'badge_type' => 'nullable',
                'status'     => 'required',
                'image'      => 'required|numeric',
            ],
            [
                'image.required' => 'The badge image is required',
            ]
        );

        $badge = new Badge();
        $badge->name = $request->name;
        $badge->status = $request->status;
        $badge->image = $request->image;
        $badge->save();

        return $badge->id
        ? back()->with([
            'message'    => 'Badge Created Successfully.',
            'alert-type' => 'success',
        ])
        : back()->with([
            'message'    => 'Badge Creation Failed.',
            'alert-type' => 'error',
        ]);
    }

    public function update(Request $request, $id) {
        $request->validate(
            [
                'name'       => 'required',
                'sale_count' => 'nullable|numeric',
                'badge_type' => 'nullable',
                'status'     => 'required',
                'image'      => 'required|numeric',
            ],
            [
                'image.required' => 'The badge image is required',
            ]
        );

        $badge = Badge::findOrFail($id);
        $badge->name = $request->name;
        $badge->status = $request->status;
        $badge->image = $request->image;
        $badge->save();

        return $badge->id
        ? back()->with([
            'message'    => 'Badge Updated Successfully.',
            'alert-type' => 'success',
        ])
        : back()->with([
            'message'    => 'Badge Updating Failed.',
            'alert-type' => 'error',
        ]);
    }

    public function destroy($id) {
        $deleted = Badge::findOrFail($id)->delete();

        return $deleted
        ? back()->with([
            'message'    => 'Badge Deleted Successfully.',
            'alert-type' => 'success',
        ])
        : back()->with([
            'message'    => 'Badge Deleting Failed.',
            'alert-type' => 'error',
        ]);
    }

    public function bulk_action_delete(Request $request) {
        $deleted = Badge::whereIn('id', $request->ids)->delete();

        return response()->json(['status' => 'ok']);
    }

    public function trash() {
        $badges = Badge::onlyTrashed()->get();
        return view(self::BASE_PATH . 'trash', compact('badges'));
    }

    public function trash_restore($id) {
        $restored = Badge::withTrashed()->findOrFail($id)->restore();

        return $restored
        ? back()->with([
            'message'    => 'Badge Restored Successfully.',
            'alert-type' => 'success',
        ])
        : back()->with([
            'message'    => 'Badge Restore Failed.',
            'alert-type' => 'error',
        ]);
    }

    public function trash_delete($id) {
        $deleted = Badge::withTrashed()->findOrFail($id)->forceDelete();

        return $deleted
        ? back()->with([
            'message'    => 'Badge Deleted Successfully.',
            'alert-type' => 'success',
        ])
        : back()->with([
            'message'    => 'Badge Deleting Failed.',
            'alert-type' => 'error',
        ]);
    }

    public function trash_bulk_action_delete(Request $request) {
        $deleted = Badge::withTrashed()->whereIn('id', $request->ids)->forceDelete();

        return response()->json(['status' => 'ok']);
    }

    public function statusChange(Request $request, $id) {
        Badge::where('id', $id)->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with([
            'message'    => __('Badge status changed successfully.'),
            'alert-type' => 'success',
        ]);
    }
}
