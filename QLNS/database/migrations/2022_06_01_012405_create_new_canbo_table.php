<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewCanboTable extends Migration
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
            $table->date('ngaysinh')->nullable();
            $table->tinyInteger('gioitinh')->default(1)->comment('1:nam,0:nu');
            $table->string('quequan')->nullable();
            $table->string('cccd')->nullable();
            $table->string('file_cccd')->nullable();
            $table->string('thuongtru')->nullable();
            $table->string('sdt')->nullable();
            $table->string('email')->nullable();
            $table->string('tdcm')->nullable();//trình độ chuyên môn
            $table->string('truongdaotao')->nullable();
            $table->string('namtotnghiep')->nullable();
            $table->string('bangcap')->nullable();
            $table->string('file_bc')->nullable();
            $table->date('ngayvaoct')->nullable();
            $table->unsignedBigInteger('phongban_id')->nullable();
            $table->unsignedBigInteger('chucvu_id')->nullable();
            $table->tinyInteger('theodoi')->default(1)->comment('1:theodoi,0:ngungtheodoi');

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
