<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLichsuUpfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lichsu_upfile', function (Blueprint $table) {
            $table->id();
            $table->string('tenpm')->nullable();
            $table->string('thoigiantao')->nullable();
            $table->string('thoigianchinhsua')->nullable();
            $table->string('file_gt')->nullable();
            $table->string('file_demo')->nullable();
            $table->string('tkthuchien')->nullable();
            $table->string('cbphutrach')->nullable();
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
        Schema::dropIfExists('lichsu_upfile');
    }
}
