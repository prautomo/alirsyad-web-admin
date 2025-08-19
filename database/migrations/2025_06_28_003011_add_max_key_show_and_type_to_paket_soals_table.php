<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnMaxShowAnswerKeyAndTypeToPaketSoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paket_soals', function (Blueprint $table) {
            $table->integer('max_show_answer_key')->default(80);
            $table->enum('answer_key_type', ['persentase', 'jumlah_soal'])->default('persentase');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paket_soals', function (Blueprint $table) {
            $table->dropColumn(['max_show_answer_key', 'answer_key_type']);
        });
    }
};
