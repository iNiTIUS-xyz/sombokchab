<?php

namespace Modules\DeliveryMan\Http\Controllers;

use Modules\CountryManage\Entities\Country;
use Modules\CountryManage\Entities\State;
use App\Http\Controllers\Controller;
use App\Http\Traits\Api\CountryManageApiTrait;
use Illuminate\Http\Request;
use Modules\CountryManage\Entities\City;

final class DeliveryManCountryController extends Controller
{
    use CountryManageApiTrait;
}
