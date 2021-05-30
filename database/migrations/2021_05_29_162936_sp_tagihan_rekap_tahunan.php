<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpTagihanRekapTahunan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("create view vw_arusKasSummary as
        select month(`aruskas`.`kas`.`tanggal`) AS `bulan`,year(`aruskas`.`kas`.`tanggal`) AS `tahun`,sum(`aruskas`.`kas`.`jumlah`) AS `jumlah`,`aruskas`.`kas`.`type_kas` AS `type_kas` from `aruskas`.`kas` group by month(`aruskas`.`kas`.`tanggal`),year(`aruskas`.`kas`.`tanggal`),`aruskas`.`kas`.`type_kas`"
    );
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
