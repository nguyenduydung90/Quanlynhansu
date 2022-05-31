<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThongtinphanmemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thongtinphanmems', function (Blueprint $table) {
            $table->id();
            $table->string('tenpm')->nullable();
            $table->string('congnghe')->nullable();
            $table->string('hdsd')->nullable();
            $table->string('linkdm')->nullable();
            $table->string('cbphutrach')->nullable();
            $table->string('thoigianphattrien')->nullable();
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
        Schema::dropIfExists('thongtinphanmems');
    }
}
