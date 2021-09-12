<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('simulasi_id');
            $table->double('score')->default(0);
            $table->unsignedBigInteger('jenjang')->nullable();
            $table->unsignedBigInteger('tingkat')->nullable();
            $table->unsignedBigInteger('kelas')->nullable();
            $table->integer('semester')->default(1);
            $table->unsignedBigInteger('pengajar_id')->nullable();
            $table->string('nama_pengajar')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
