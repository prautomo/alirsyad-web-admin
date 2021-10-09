<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Faker;
use App\Models\ExternalUser;

class InitDemoData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:demo:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fake = Faker\Factory::create();
        echo ("================Init Demo Data===============\n");
        echo ("Create Guru Data \n");

        $gurus = [
            [
                'nis' => '321345352535',
                'username' => 'priyani_sri_rukmingsih',
                'name' => 'Priyani Sri Rukminingsih, S.Pd',
                'email' => 'priyani_sri_rukmingsih@gmail.com',
                'email_verified_at' => now(),
                'phone' => '08321231323',
                'phone_verified_at' => now(),
                'password' => bcrypt('123456'),
                'photo' => "",
                'role' => 'GURU',
                'status' => 'AKTIF',
            ]
        ];
        foreach($gurus as $guru){
            if (!ExternalUser::where("nis", $guru['nis'])->first()) {
                $guruCreate = ExternalUser::create($guru);
            }
        }
        
    }
}
