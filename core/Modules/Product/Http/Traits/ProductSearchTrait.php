<?php

namespace Modules\Product\Http\Traits;

use Illuminate\Support\Facades\Auth;

trait ProductSearchTrait
{

    public static function productSearch($request, $req_route = null, $queryType = "admin", $isCustomPagination = "custom")
    {

        $route = null;

        if (Auth::guard('admin')->check()) {
            $route = "admin";
        } elseif (Auth::guard('vendor')->check()) {
            $route = "vendor";
        } else {
            $route = "api";
        }

        if (!empty($req_route)) {
            $route = $req_route;
        }

        return (new self)->search($request, $route, $queryType, $isCustomPagination);
    }
}