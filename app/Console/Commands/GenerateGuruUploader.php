<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Faker;
use App\Models\User;
use App\Models\ExternalUser;

class GenerateGuruUploader extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate:guruuploader';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate guru biasa ke guru uploader.';

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
        echo ("================Generate Guru Uploader===============\n");

        $guruBiasas = ExternalUser::where('role', 'GURU')->get();

        // loop guru biasa
        foreach($guruBiasas as $guruBiasa){
            $checkExistUser = User::where('username', $guruBiasa->nis)->first();
            if(!$checkExistUser){
                // insert ke table user jadi guru uploader
                $inputUploader['name'] = $guruBiasa->name;
                $inputUploader['username'] = $guruBiasa->nis;
                $inputUploader['email'] = $guruBiasa->email;
                $inputUploader['password'] = $guruBiasa->password;
    
                $guruUploader = User::create($inputUploader);
                $guruUploader->assignRole("Guru Uploader");
            }
        }
        
        echo ("================Done===============\n");
    }

   
}
