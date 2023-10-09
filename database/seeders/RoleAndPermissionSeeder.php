<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'users-list'],
            ['name' => 'create-users'],
            ['name' => 'edit-users'],
            ['name' => 'delete-users'],
            ['name' => 'create-blog-posts'],
            ['name' => 'edit-blog-posts'],
            ['name' => 'delete-blog-posts'],
            ['name' => 'create-category'],
            ['name' => 'edit-category'],
            ['name' => 'delete-category'],
            ['name' => 'role-list'],
            ['name' => 'create-role'],
            ['name' => 'edit-role'],
            ['name' => 'delete-role'],
        ];

        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Writer'],
            ['name' => 'Manager'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
