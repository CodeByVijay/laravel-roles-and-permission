<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            "name"=>"Admin",
            "email"=>"admin@gmail.com",
            "password"=>Hash::make('12345678'),
            "email_verified_at"=>now()
        ];
        $admin = User::create($admin);

        $role = Role::where('name','Admin')->first();
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $admin->assignRole([$role->id]);

        $manager = [
            "name"=>"Manager",
            "email"=>"manager@gmail.com",
            "password"=>Hash::make('12345678'),
            "email_verified_at"=>now()
        ];
        $manager = User::create($manager);

        $role = Role::where('name','Manager')->first();
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $manager->assignRole([$role->id]);
    }
}
