<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTiencomOnBangluongCt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bangluong_ct', function (Blueprint $table) {
            $table->double('tiencom')->nullable();
            $table->double('tienphat')->nullable();
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
