<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnOnCanboTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('canbo', function (Blueprint $table) {
            $table->string('bangcap')->nullable();
            $table->string('sobhxh')->nullable();
            $table->string('sobhyt')->nullable();
            $table->string('ngayvao')->nullable();
            $table->double('luongthamnien')->nullable();
            $table->double('luongtrachnhiem')->nullable();
            $table->double('pccbptts')->nullable(); // phụ cấp cán bộ phụ trách tài sản
            $table->double('lbcb')->nullable(); //lương bậc cán bộ
            $table->double('lsp')->nullable();
            $table->double('congtacphi')->default(0);
            $table->double('kpcd')->nullable();
            $table->double('ptbhxh')->nullable();
            $table->double('ptbhyt')->nullable();
            $table->double('ptbhtn')->nullable();
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
