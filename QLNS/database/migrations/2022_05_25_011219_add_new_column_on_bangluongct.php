<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnOnBangluongct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bangluong_ct', function (Blueprint $table) {
            $table->unsignedBigInteger('mabl')->nullable();
            $table->double('luongthamnien')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bangluong_ct', function (Blueprint $table) {
            //
        });
    }
}
