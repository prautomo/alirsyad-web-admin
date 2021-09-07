<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoryPathSimulasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story_path_simulasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('story_path_id');
            $table->unsignedBigInteger('simulasi_id');
            $table->integer('order')->default(0);
            $table->timestamps();
            
            $table->foreign('story_path_id')->references('id')->on('story_paths')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('simulasi_id')->references('id')->on('simulasis')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('story_path_simulasis');
    }
}
