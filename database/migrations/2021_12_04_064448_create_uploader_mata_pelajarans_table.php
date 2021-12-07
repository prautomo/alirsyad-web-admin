<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploaderMataPelajaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploader_mata_pelajarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_uploader_id');
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->timestamps();

            $table->foreign('guru_uploader_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('mata_pelajaran_id')->references('id')->on('mata_pelajarans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uploader_mata_pelajarans');
    }
}
