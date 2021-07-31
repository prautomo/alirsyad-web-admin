<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
        if(Tingkat::get()->isEmpty()){
            foreach ([
                "TK",
                "SD",
                "SMP",
                "SMA",
                "SMK",
            ] as $key => $value) {
                if (!Tingkat::where("name", $value)->first()) {
                    $tingkat = Tingkat::factory()->create(["name" => $value]);

                    $dataKelas = [
                        ['tingkat_id'=> @$tingkat->id, 'name'=> "1", 'created_at'=> \Carbon\Carbon::now()],
                        ['tingkat_id'=> @$tingkat->id, 'name'=> "2", 'created_at'=> \Carbon\Carbon::now()],
                    ];
                    DB::table('kelas')->insert($dataKelas);
                }
            }
        }
    }
}
