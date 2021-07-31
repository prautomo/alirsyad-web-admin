<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExternalUser;
use DB;
use Faker;

class ExternalUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = Faker\Factory::create();
        if (ExternalUser::get()->isEmpty()) {
            $siswa = ExternalUser::create([
                'username' => 'siswa1',
                'name' => 'Siswa 1',
                'email' => 'siswa1@sample.id',
                'email_verified_at' => now(),
                'phone' => '084321312312',
                'phone_verified_at' => now(),
                'password' => bcrypt('123456'),
                'photo' => "https://s.gravatar.com/avatar/8c2ef75f6fd262a0d4002961a9436e0f?s=200&r=pg",
                'role' => 'SISWA',
                'status' => 'AKTIF'
            ]);

            $siswa2 = ExternalUser::create([
                'username' => 'siswa2',
                'name' => 'Siswa 2',
                'email' => 'siswa2@sample.id',
                'email_verified_at' => now(),
                'phone' => '08499312312',
                'phone_verified_at' => now(),
                'password' => bcrypt('123456'),
                'photo' => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSmqRgyY2nea7IhhLJiAiic1NCr72JmPmPYtQ&usqp=CAU",
                'role' => 'SISWA',
                'status' => 'AKTIF'
            ]);
        }
    }
}
