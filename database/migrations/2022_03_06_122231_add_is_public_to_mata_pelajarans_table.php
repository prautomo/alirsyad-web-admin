<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPublicToMataPelajaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mata_pelajarans', function (Blueprint $table) {
            $table->boolean('is_public_modul')->default(false);
            $table->boolean('is_public_video')->default(false);
            $table->boolean('is_public_simulasi')->default(false);
        });

        Schema::table('moduls', function (Blueprint $table) {
            $table->boolean('is_public')->default(false);
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->boolean('is_public')->default(false);
        });

        Schema::table('simulasis', function (Blueprint $table) {
            $table->boolean('is_public')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mata_pelajarans', function (Blueprint $table) {
            $table->dropColumn('is_public_modul');
            $table->dropColumn('is_public_video');
            $table->dropColumn('is_public_simulasi');
        });

        Schema::table('moduls', function (Blueprint $table) {
            $table->dropColumn('is_public');
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('is_public');
        });

        Schema::table('simulasis', function (Blueprint $table) {
            $table->dropColumn('is_public');
        });
    }
}
