<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShowForGuestToJenjangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jenjangs', function (Blueprint $table) {
            $table->boolean('show_for_guest')->default(false);
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
            $table->dropColumn('show_for_guest');
        });
    }
}
