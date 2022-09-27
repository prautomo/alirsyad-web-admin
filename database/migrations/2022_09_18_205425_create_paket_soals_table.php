<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket_soals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mata_pelajaran_id')->nullable();
            $table->unsignedBigInteger('bab_id')->nullable()->comment("modul id or null");
            $table->integer('subbab');
            $table->string('judul_subbab')->comment("judul subbab");

            $table->enum('tingkat_kesulitan', ['mudah', 'sedang', 'sulit'])->default('mudah')->comment("tingkat kesulitan soal");

            $table->integer('jumlah_publish')->default(10);
            $table->float('nilai_kkm');

            $table->unsignedBigInteger('creator_id')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('creator_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paket_soals');
    }
}
