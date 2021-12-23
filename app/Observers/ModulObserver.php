<?php

namespace App\Observers;

use App\Models\Modul;
use App\Models\Update;

class ModulObserver
{
    /**
     * Handle the Modul "created" event.
     *
     * @param  \App\Models\Modul  $modul
     * @return void
     */
    public function created(Modul $modul)
    {
        $this->insertToUpdateLog($modul, "create");
    }

    /**
     * Handle the Modul "updated" event.
     *
     * @param  \App\Models\Modul  $modul
     * @return void
     */
    public function updated(Modul $modul)
    {
        $this->insertToUpdateLog($modul, "update");

        // update video mapel_id
        foreach ($modul->videos()->get() as $video) {
            $video->mata_pelajaran_id = $modul->mata_pelajaran_id;
            $video->save();
        }

        // update simulasi mapel_id
        foreach ($modul->simulasis()->get() as $simulasi) {
            $simulasi->mata_pelajaran_id = $modul->mata_pelajaran_id;
            $simulasi->save();
        }
    }

    /**
     * Handle the Modul "deleted" event.
     *
     * @param  \App\Models\Modul  $modul
     * @return void
     */
    public function deleted(Modul $modul)
    {
        //
    }

    /**
     * Handle the Modul "restored" event.
     *
     * @param  \App\Models\Modul  $modul
     * @return void
     */
    public function restored(Modul $modul)
    {
        //
    }

    /**
     * Handle the Modul "force deleted" event.
     *
     * @param  \App\Models\Modul  $modul
     * @return void
     */
    public function forceDeleted(Modul $modul)
    {
        //
    }

    /**
     * Insert to update log
     * 
     * @param  \App\Models\Modul  $modul
     * @param  String  $type
     * @return void
     */
    private function insertToUpdateLog(Modul $modul, $type){
        $data = [
            'trigger_event' => @$type ?? 'other', 
            'trigger' => 'modul', 
            'trigger_id' => @$modul->id, 
            'trigger_name' => @$modul->name, 
            'mata_pelajaran' => @$modul->mataPelajaran->name, 
        ];

        Update::create($data);
    }
}
