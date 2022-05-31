<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnOnCanboTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('canbo', function (Blueprint $table) {
            $table->double('pcat')->nullable();
            $table->double('pcxx')->nullable();
            $table->double('pcdt')->nullable();
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
