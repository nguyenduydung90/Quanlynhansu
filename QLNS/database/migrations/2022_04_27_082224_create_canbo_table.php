<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanboTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canbo', function (Blueprint $table) {
            $table->id();
            $table->string('hoten')->nullable();
            $table->string('gioitinh')->nullable();
            $table->string('diachi')->nullable();
            $table->string('anh')->nullable();
            $table->unsignedBigInteger('chucvu_id')->nullable();
            $table->unsignedBigInteger('phongban_id')->nullable();
            $table->string('dienthoai')->nullable();
            $table->string('email')->nullable();
            $table->string('ngaysinh')->nullable();
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
        Schema::dropIfExists('canbo');
    }
}
