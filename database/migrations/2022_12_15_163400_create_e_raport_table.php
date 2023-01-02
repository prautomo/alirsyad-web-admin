<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateERaportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_raport', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('paket_soal_id');
            $table->integer('total_terjawab')->default(0);
            $table->integer('total_benar')->default(0);
            $table->text('list_id_soal_terjawab')->default("");
            $table->text('list_id_soal_benar')->default("");
            $table->string('tipe');
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
        Schema::dropIfExists('e_raport');
    }
}
