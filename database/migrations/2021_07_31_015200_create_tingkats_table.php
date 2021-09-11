<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTingkatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tingkats', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default("")->comment('nama tingkat [1/2/3]');
            $table->text('description')->nullable();
            $table->text('logo')->default("");
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('jenjang_id');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);

            $table->foreign('jenjang_id')->references('id')->on('jenjangs')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tingkats');
    }
}
