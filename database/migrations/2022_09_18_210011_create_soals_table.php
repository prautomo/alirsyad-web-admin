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
            $table->unsignedBigInteger('paket_soal_id')->nullable();
            $table->string('soal');
            $table->string('pilihan_a');
            $table->string('pilihan_b');
            $table->string('pilihan_c');
            $table->string('pilihan_d');
            $table->string('pilihan_e')->nullable();
            $table->enum('jawaban', ['pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e'])->comment("jawaban benar");
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
