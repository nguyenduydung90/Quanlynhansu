<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyCanboTableToDmphongbanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('canbo', function (Blueprint $table) {
            $table->foreign('phongban_id')->references('id')->on('phongban')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('canbo', function (Blueprint $table) {
            Schema::dropIfExists('canbo');
        });
    }
}
