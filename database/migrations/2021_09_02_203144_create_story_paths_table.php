<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoryPathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story_paths', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('modul_id');
            $table->string('name')->nullable();
            $table->string('template_path')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('uploader_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('modul_id')->references('id')->on('moduls')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('uploader_id')->references('id')->on('external_users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('story_paths');
    }
}
