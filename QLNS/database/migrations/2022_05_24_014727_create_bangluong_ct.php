<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBangluongCt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bangluong_ct', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('macb');
            $table->double('luongcoban')->nullable();
            $table->double('luongtrachnhiem')->nullable();
            $table->double('pccbptts')->nullable(); // phụ cấp cán bộ phụ trách tài sản
            $table->double('lbcb')->nullable(); //lương bậc cán bộ
            $table->double('lsp')->default(0); // lương sản phẩm
            $table->double('congtacphi')->default(0);
            $table->double('kpcd')->nullable();
            $table->double('ptbhxh')->nullable();
            $table->double('ptbhyt')->nullable();
            $table->double('ptbhtn')->nullable();
            $table->double('tongluong')->nullable();
            $table->double('thucnhan')->nullable();

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
        Schema::dropIfExists('bangluong_ct');
    }
}
