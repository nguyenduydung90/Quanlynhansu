<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyDmphongbanTableToDmkhoiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phongban', function (Blueprint $table) {
            $table->foreign('dmkhoi_id')->references('id')->on('dmkhoipb')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phongban', function (Blueprint $table) {
            Schema::dropIfExists('phongban');
        });
    }
}
