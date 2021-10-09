<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jenjang;
use App\Models\Tingkat;
use App\Models\Kelas;
use DB;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Jenjang::get()->isEmpty()){
            foreach ([
                "TK",
                "SD",
                "SMP",
                "SMA",
            ] as $key => $value) {
                if (!Jenjang::where("name", $value)->first()) {
                    $tingkat = Jenjang::factory()->create(["name" => $value]);
                }
            }
        }
    }
}
