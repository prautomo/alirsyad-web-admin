<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKepalaSekolahIdToJenjangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jenjangs', function (Blueprint $table) {
            $table->unsignedBigInteger("kepala_sekolah_id")->nullable()->after('uploader_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jenjangs', function (Blueprint $table) {
            $table->dropColumn('kepala_sekolah_id');
        });
    }
}
