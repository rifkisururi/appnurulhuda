<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TagihanDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagihan_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_tagihan_master');
            $table->integer('jumlah');
            $table->integer('id_user_confirm');
            $table->integer('flag_pay');
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
        //
    }
}
