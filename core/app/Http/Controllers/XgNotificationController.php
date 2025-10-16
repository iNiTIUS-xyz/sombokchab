<?php

namespace App\Http\Controllers;

use App\XGNotification;
use App\Http\Services\NotificationService;

class XgNotificationController extends Controller
{
    public function __invoke()
    {
        $response = NotificationService::init()->markAsRead();

        if (is_null($response)) {
            abort(403);
        }

        return response()->json($response);
    }

    public function markAsRead($id)
    {
        $activeGuard = activeGuard();

        $notification = XGNotification::findOrFail($id);

        if ($activeGuard == 'web') {
            $notification->update(['is_read_user' => 1]);
        } elseif ($activeGuard == 'vendor') {
            $notification->update(['is_read_vendor' => 1]);
        } elseif ($activeGuard == 'admin') {
            $notification->update(['is_read_admin' => 1]);
        }

        return response()->json(['status' => 'success']);
    }
}
