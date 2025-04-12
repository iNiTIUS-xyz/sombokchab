<?php

namespace Modules\DeliveryMan\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryManSettingsController extends Controller
{
    public function settings()
    {
        return view("deliveryman::admin.settings.index");
    }

    public function updateSettings(Request $request)
    {

    }
}
