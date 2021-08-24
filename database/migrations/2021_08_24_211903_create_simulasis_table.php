<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimulasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simulasis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path_simulasi');
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->unsignedBigInteger('uploader_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('simulasis');
    }
}
