<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInCanbo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('canbo', function (Blueprint $table) {
            $table->string('ngaynghi')->default(0);
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
        Schema::table('canbo', function (Blueprint $table) {
            //
        });
    }
}
