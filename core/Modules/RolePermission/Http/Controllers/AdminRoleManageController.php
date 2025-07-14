<?php

namespace Modules\RolePermission\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminRoleManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $roles = Role::get();

        return view("rolepermission::admin-manage.roles.index", compact("roles"));
    }
    public function showPermissions($id)
    {
        $role = Role::with("permissions")->find($id);
        $permissions = Permission::orderBy("menu_name","asc")->get();
        $permissions = $permissions->groupBy("menu_name");

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return  view("rolepermission::admin-manage.roles.permissions",compact("role","permissions","rolePermissions"));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            // "hierarchy" => "required",
            "name" => "required"
        ]);
        Role::create([
            // "hierarchy" => $request->hierarchy,
            "name" => $request->name
        ]);

        return back()->with(["msg" => __("Role added successfully."),"type" => "success"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            // "hierarchy" => "required",
            "name" => "required"
        ]);
        Role::find($id)->update([
            // "hierarchy" => $request->hierarchy,
            "name" => $request->name
        ]);

        return back()->with(["msg" => __("Role name updated successfully."),"type" => "success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        Role::find($id)->delete();

        return back()->with(["msg" => "Role deleted.","type" => "danger"]);
    }

    public function storePermissions(Request $request,$id)
    {
        $role = Role::find($id);
        $role->syncPermissions($request->permission);

        return back()->with(["msg" => "Permission synced with the role.","type" => "success"]);
    }

    public function createPermission(Request $request){
        // validate all permission
        $requestData = $request->validate([
            "menu_name" => "required|string",
            "name.*" => "required|string",
            "name" => "required",
            "guard" => "required",
            "guard.*" => "required|string"
        ]);

        $permissions = [];
        for($i = 0;$i < count($requestData["name"]); $i++){
            $permissions[] = [
                "menu_name" => $requestData["menu_name"],
                "name" => $requestData["name"][$i],
                "guard_name" => $requestData["guard"][$i],
            ];
        }

        // now insert those values inside the permission table
        $permission = Permission::insert($permissions);

        return response()->json([
            "msg" => $permission ? __("New permission added successfully.") : __("Failed to insert new permission."),
            "type" => $permission ? "success" : "danger"
        ]);
    }
}
