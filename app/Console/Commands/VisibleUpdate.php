<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Faker;
use App\Models\Update;
use App\Models\Video;
use App\Models\Modul;

class VisibleUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:visible-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate visible update.';

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
        echo ("================Fix Visible Update Video===============\n");
        $videos = Video::get();
        $checkVideoUpdate = Update::where(['trigger' => 'video'])->whereIn('trigger_id', $videos->pluck('id'))->get();

        // loop video update
        foreach($checkVideoUpdate as $videoUpdate){

            $detailVideo = Update::where(['trigger' => 'video', 'trigger_id' => $videoUpdate->trigger_id])->first();

            $detailVideo->visible = @$videoUpdate->video->show_update;

            $detailVideo->save();
            echo $videoUpdate->trigger_name." (Updated)\n";
        }
        echo ("================Video Done===============\n");

        echo ("================Fix Visible Update Modul===============\n");
        $moduls = Modul::get();
        $checkModulUpdate = Update::where(['trigger' => 'modul'])->whereIn('trigger_id', $moduls->pluck('id'))->get();

        // loop video update
        foreach($checkModulUpdate as $modulUpdate){

            $detailModul = Update::where(['trigger' => 'modul', 'trigger_id' => $modulUpdate->trigger_id])->first();

            $detailModul->visible = @$modulUpdate->modul->show_update;

            $detailModul->save();
            echo $modulUpdate->trigger_name." (Updated)\n";
        }
        echo ("================Modul Done===============\n");
    }


}
