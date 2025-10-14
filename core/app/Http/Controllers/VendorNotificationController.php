<?php

namespace App\Http\Controllers;

class VendorNotificationController
{
    public function index()
    {
        $notifications = xgNotifications('page')->get();
        $type = 'vendor';

        return view("vendor.notification", compact('notifications', 'type'));
    }
}
