<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBangluongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bangluong', function (Blueprint $table) {
            $table->id();
            $table->integer('thang')->nullable();
            $table->integer('nam')->nullable();
            $table->string('noidung')->nullable();
            $table->string('ngaylap')->nullable();
            $table->string('nguoilap')->nullable();
            $table->string('ghichu')->nullable();
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
        Schema::dropIfExists('bangluong');
    }
}
