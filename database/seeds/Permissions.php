<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        $permissions = [
          'view problem',
          'edit problem',
            'delete problem',
            'create problem',
            'access others resources',



        ];

        foreach ($permissions as $permission){
            Permission::create(['name'=> $permission]);
        }

        $role = Role::firstOrCreate(['name'=>'Admin']);
        $role->givePermissionTo($permissions);

        $admin = User::create(['name'=>'abc','email'=>'admin@admin.com','password'=>bcrypt('123456')]);
        $admin->assignRole('admin');

    }
}
