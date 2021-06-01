<?php

namespace Database\Seeders;

use App\Models\tagihan_master_model;
use Illuminate\Database\Seeder;

class tagihan_master_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        tagihan_master_model::create([
            'name' => 'Syahriyyah Madin',
            'keterangan' => '',
            'jumlah' => 20000
        ]);

        tagihan_master_model::create([
            'name' => 'Pajek',
            'keterangan' => 'Pajek',
            'jumlah' => 150000
        ]);
    }
}
