<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenjangPendidikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenjangs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default("")->comment('nama jenjang [tk,sd,smp,sma,smk]');
            $table->text('description')->nullable();
            $table->text('logo')->default("");
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('uploader_id')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenjangs');
    }
}
