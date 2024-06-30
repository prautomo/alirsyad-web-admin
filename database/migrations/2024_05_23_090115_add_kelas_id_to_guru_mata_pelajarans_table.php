<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKelasIdToGuruMataPelajaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guru_mata_pelajarans', function (Blueprint $table) {
            $table->unsignedBigInteger("kelas_id")->nullable()->after('mata_pelajaran_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guru_mata_pelajarans', function (Blueprint $table) {
            $table->unsignedBigInteger("kelas_id")->nullable();
        });
    }
}
