<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as ModelsRole;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-list|create-role|edit-role|delete-role', ['only' => ['index', 'createRole']]);

        $this->middleware('permission:create-role', ['only' => ['createRoleIndex', 'createRole']]);

        $this->middleware('permission:edit-role', ['only' => ['editRoleIndex', 'editRole']]);

        $this->middleware('permission:delete-role', ['only' => ['destroy']]);
    }

    public function index()
    {
        $roles = Role::paginate(10);
        return view('role.roles', ['roles' => $roles]);
    }

    public function view($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")->where("role_has_permissions.role_id", $id)->get();

        return view('role.view', compact('role', 'rolePermissions'));
    }
    public function createRoleIndex()
    {

    }

    public function createRole()
    {

    }

    public function editRoleIndex($id)
    {
        $role = Role::find($id);

        $permission = Permission::get();

        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)

            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')

            ->all();

        return view('role.edit', compact('role', 'permission', 'rolePermissions'));
    }

    public function editRole(Request $request)
    {
        $this->validate($request, [
            'role_id' => 'required',
            'role' => 'required',
            // 'permission' => 'required',

        ]);

        $role = ModelsRole::find($request->role_id);

        $role->name = $request->input('role');

        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles')

            ->with('success', 'Role updated successfully');
    }

    public function destroy()
    {

    }
}
