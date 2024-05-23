<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['guard_name' => 'backoffice', 'name' => 'Kepala Sekolah', 'key' => "KEPALASEKOLAH"]);
        Role::create(['guard_name' => 'backoffice', 'name' => 'Wali Kelas', 'key' => "WALIKELAS"]);
        Role::create(['guard_name' => 'backoffice', 'name' => 'Guru Mata Pelajaran', 'key' => "GURUMAPEL"]);
    }
}
