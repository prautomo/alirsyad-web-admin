<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Faker;
use App\Models\Modul;
use App\Models\Simulasi;

class GenerateUrutan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate:urutan';

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
        echo ("================Generate Urutan===============\n");
        echo ("Urutan Modul \n");
        echo ("===============================\n");
        $moduls = Modul::all();
        foreach($moduls as $modul){
            $urutan = @$this->getNumber(@$modul->name, '/BAB \d+/') ? $this->getNumber(@$modul->name, '/BAB \d+/')[0] : 0;
            $urutan = str_replace("BAB ", "", $urutan);
            echo $urutan." = ".@$modul->name."\n";
            
            $modul->urutan = $urutan;
            $modul->save();
        }
        echo ("===============================\n");
        echo ("Urutan Simulasi \n");
        echo ("===============================\n");
        $simulasis = Simulasi::all();
        foreach($simulasis as $simulasi){
            $urutan = @$this->getNumber(@$simulasi->name, '/\d+[.]/') ? $this->getNumber(@$simulasi->name, '/\d+[.]/')[0] : 0;
            $urutan = str_replace(".", "", $urutan);
            echo $urutan." = ".@$simulasi->name."\n";
            
            $simulasi->urutan = $urutan;
            $simulasi->save();
        }
        // echo ("===============================\n");
        // echo ("Urutan Video \n");
        // echo ("===============================\n");
        // $videos = Simulasi::all();
        // foreach($videos as $video){
        //     $urutan = @$this->getNumber(@$video->name, '/\d+[.]/') ? $this->getNumber(@$video->name, '/\d+[.]/')[0] : 0;
        //     $urutan = str_replace(".", "", $urutan);
        //     echo $urutan." = ".@$video->name."\n";
            
        //     $video->urutan = $urutan;
        //     $video->save();
        // }
    }

    private function getNumber($str="", $pattern='/BAB \d+/'){
        preg_match_all($pattern, $str, $matches);
        return @$matches[0];
    }
}
