<?php

namespace App\Http\Controllers;

class AdminNotificationController extends Controller
{
    public function index()
    {
        $notifications = xgNotifications('page')->get();

        return view("backend.notification", compact('notifications'));
    }
}
