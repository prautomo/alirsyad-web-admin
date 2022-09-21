<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soals', function (Blueprint $table) {
            $table->id();
            $table->enum('tingkat_kesulitan', ['mudah', 'sedang', 'sulit'])->default('mudah')->comment("tingkat kesulitan soal");
            $table->string('soal');
            $table->string('piliahan_a');
            $table->string('piliahan_b');
            $table->string('piliahan_c');
            $table->string('piliahan_d');
            $table->string('piliahan_e')->nullable();
            $table->enum('jawaban', ['piliahan_a', 'piliahan_b', 'piliahan_c', 'piliahan_d', 'piliahan_e'])->comment("jawaban benar");
            $table->string('sumber')->nullable();
            $table->string('link_pembahasan')->nullable();
            $table->string('pembahasan')->nullable();
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->boolean('is_active')->default(true);

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
        Schema::dropIfExists('soals');
    }
}
