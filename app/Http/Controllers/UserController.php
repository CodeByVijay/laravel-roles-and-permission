<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as ModelsRole;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users-list|create-users|edit-users|delete-users', ['only' => ['index', 'createUser']]);

        $this->middleware('permission:create-users', ['only' => ['createUsersIndex', 'createUsers']]);

        $this->middleware('permission:edit-users', ['only' => ['editUsersIndex', 'editUsers']]);

        $this->middleware('permission:delete-users', ['only' => ['destroy']]);
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('users.users', ['users' => $users]);
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
        $user = User::find($id);
        $roles = ModelsRole::get();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.edit', compact('user', 'roles','userRole'));
    }

    public function editUser(Request $request)
    {

        $this->validate($request, [
            'user_id' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$request->user_id,
            'password'=>'same:con_password',
            'roles' => 'required',
            // 'permission' => 'required',

        ]);

        $user = User::find($request->user_id);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if(!empty($request->input['password'])){
            $user->name = $request->input('password');
        }
        $user->update();
        DB::table('model_has_roles')->where('model_id',$request->user_id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users')

            ->with('success', 'User updated successfully');
    }

    public function destroy()
    {

    }
}
