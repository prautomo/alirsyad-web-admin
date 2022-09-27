<?php

namespace App\Observers;

use App\Models\Video;
use App\Models\Update;

class VideoObserver
{
    /**
     * Handle the Video "created" event.
     *
     * @param  \App\Models\Video  $video
     * @return void
     */
    public function created(Video $video)
    {
        $this->insertToUpdateLog($video, "create");
    }

    /**
     * Handle the Video "updated" event.
     *
     * @param  \App\Models\Video  $video
     * @return void
     */
    public function updated(Video $video)
    {
        $this->insertToUpdateLog($video, "update");
    }

    /**
     * Handle the Video "deleted" event.
     *
     * @param  \App\Models\Video  $video
     * @return void
     */
    public function deleted(Video $video)
    {
        //
    }

    /**
     * Handle the Video "restored" event.
     *
     * @param  \App\Models\Video  $video
     * @return void
     */
    public function restored(Video $video)
    {
        //
    }

    /**
     * Handle the Video "force deleted" event.
     *
     * @param  \App\Models\Video  $video
     * @return void
     */
    public function forceDeleted(Video $video)
    {
        //
    }

    /**
     * Insert to update log
     *
     * @param  \App\Models\Video  $video
     * @param  String  $type
     * @return void
     */
    private function insertToUpdateLog(Video $video, $type){
        $data = [
            'trigger_event' => @$type ?? 'other',
            'trigger' => 'video',
            'trigger_id' => @$video->id,
            'trigger_name' => @$video->name,
            'mata_pelajaran' => @$video->mataPelajaran->name,
            'tingkat_id' => @$video->mataPelajaran->tingkat_id,
            'mata_pelajaran_id' => @$video->mataPelajaran->id,
        ];

        Update::create($data);
    }
}
