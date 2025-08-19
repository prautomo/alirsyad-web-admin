<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLogActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_activities', function (Blueprint $table) {
            $table->id();
            $table->string('action_type');
            $table->text('description')->nullable();
            $table->string('actor_user_id')->nullable();
            $table->string('actor_user_name')->nullable();
            $table->string('actor_user_role')->nullable();
            $table->text('before_change')->nullable();
            $table->text('after_change')->nullable();
            $table->text('change_fields')->nullable();
            $table->string('source_name')->nullable();
            $table->string('source_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_activities');
    }
}
