<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Role::get()->isEmpty()){
            $super = User::create([
                'username' => 'guru',
                'name' => 'Guru', 
                'email' => 'guru@sample.id',
                'password' => bcrypt('123456')
            ]);
            $role = Role::create(['guard_name' => 'backoffice', 'name' => 'Guru', 'key' => "GURU"]);
            $super->assignRole('Guru');

            $super = User::create([
                'username' => 'superadmin',
                'name' => 'Superadmin', 
                'email' => 'superadmin@sample.id',
                'password' => bcrypt('123456')
            ]);
            
            $roleAdm = Role::create(['guard_name' => 'backoffice', 'name' => 'Superadmin', 'key' => "SUPERADMIN"]);
            $super->assignRole('Superadmin');
        }
    }
}
