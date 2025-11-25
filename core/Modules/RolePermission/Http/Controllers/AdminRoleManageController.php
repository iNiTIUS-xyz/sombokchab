<?php

namespace Modules\RolePermission\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminRoleManageController extends Controller {

    public function index() {
        $roles = Role::get();

        return view("rolepermission::admin-manage.roles.index", compact("roles"));
    }
    public function showPermissions($id) {
        $role = Role::with("permissions")->find($id);
        $permissions = Permission::orderBy("menu_name", "asc")->get();
        $permissions = $permissions->groupBy("menu_name");

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view("rolepermission::admin-manage.roles.permissions", compact("role", "permissions", "rolePermissions"));
    }

    public function store(Request $request) {

        $request->validate([
            // "hierarchy" => "required",
            "name" => [
                'required',
                Rule::unique('roles', 'name'),
            ],
        ]);

        Role::create([
            "hierarchy" => 0,
            "name"      => $request->name,
        ]);

        return back()->with([
            "message"    => __("Role added successfully."),
            "alert-type" => "success",
        ]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            // "hierarchy" => "required",
            "name" => [
                'required',
                Rule::unique('roles', 'name')->ignore($id),
            ],
        ]);
        Role::find($id)->update([
            "hierarchy" => 0,
            "name"      => $request->name,
        ]);

        return back()->with([
            "message"    => __("Role name updated successfully."),
            "alert-type" => "success",
        ]);
    }

    public function destroy($id) {
        Role::find($id)->delete();

        return back()->with([
            "message"    => "Role deleted.",
            "alert-type" => "success",
        ]);
    }

    public function storePermissions(Request $request, $id) {
        $role = Role::find($id);
        $role->syncPermissions($request->permission);

        return back()->with([
            "message"    => "Permission synced with the role.",
            "alert-type" => "success",
        ]);
    }

    public function createPermission(Request $request) {
        // validate all permission
        $requestData = $request->validate([
            "menu_name" => "required|string",
            "name.*"    => "required|string",
            "name"      => "required",
            "guard"     => "required",
            "guard.*"   => "required|string",
        ]);

        $permissions = [];
        for ($i = 0; $i < count($requestData["name"]); $i++) {
            $permissions[] = [
                "menu_name"  => $requestData["menu_name"],
                "name"       => $requestData["name"][$i],
                "guard_name" => $requestData["guard"][$i],
            ];
        }

        // now insert those values inside the permission table
        $permission = Permission::insert($permissions);

        return response()->json([
            "message"    => $permission ? __("New permission added successfully.") : __("Failed to insert new permission."),
            "alert-type" => $permission ? "success" : "error",
        ]);
    }
}
