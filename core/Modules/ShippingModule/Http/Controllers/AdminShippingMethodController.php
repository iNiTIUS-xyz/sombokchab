<?php

namespace Modules\ShippingModule\Http\Controllers;

use App\Status;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Modules\ShippingModule\Entities\AdminShippingMethod;
use Modules\ShippingModule\Entities\Zone;
use Modules\ShippingModule\Http\Requests\StoreShippingMethodRequest;

class AdminShippingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = [
            "all_shipping_methods" => AdminShippingMethod::with("zone", "status")->get(),
        ];

        return view('shippingmodule::admin.shipping-method.index', $data);
    }

    public function create()
    {
        $all_zones = Zone::all();
        $all_publish_status = Status::all()->pluck("name", "id")->toArray();

        return view('shippingmodule::admin.shipping-method.create', compact(
            'all_zones',
            'all_publish_status',
        ));
    }

    public function edit($id)
    {
        $all_zones = Zone::all();
        $all_publish_status = Status::all()->pluck("name", "id")->toArray();
        $method = AdminShippingMethod::where("id", $id)->first();

        return view('shippingmodule::admin.shipping-method.edit', compact(
            'all_zones',
            'all_publish_status',
            'method',
        ));
    }

    public function store(StoreShippingMethodRequest $request)
    {
        $query = AdminShippingMethod::create($request->validated());

        return redirect(route("admin.shipping-method.index"))->with([
            "msg" => $query ? "Shipping method created successfully." : "Shipping method failed to create.",
            "type" => $query ? "success" : "danger"
        ]);
    }

    public function update(StoreShippingMethodRequest $request, $id)
    {
        $query = AdminShippingMethod::where("id", $id)->update($request->validated());

        return redirect(route("admin.shipping-method.index"))->with([
            "msg" => $query ? "Shipping method created Successfully." : "Shipping method failed to create.",
            "type" => $query ? "success" : "danger"
        ]);
    }

    public function makeDefault()
    {

        $vendor = AdminShippingMethod::where("id", request()->id)->first();
        if (!empty($vendor)) {
            AdminShippingMethod::where("id", "!=", request()->id)->update([
                "is_default" => 0
            ]);

            $vendor->update([
                "is_default" => 1
            ]);

            return back()->with(["msg" => "Shipping method updated successfully.", "type" => "success"]);
        }

        return back()->with(["msg" => "Shipping method failed to update."]);
    }

    public function destroy($id)
    {
        // delete method
        $delete = AdminShippingMethod::where("id", $id)->delete();

        return back()->with([
            "msg" => $delete ? "Shipping method deleted Successfully." : "Shipping method failed to delete.",
            "type" => $delete ? "success" : "danger"
        ]);
    }
}
