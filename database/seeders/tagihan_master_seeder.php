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
            'name' => 'Pajek',
            'keterangan' => 'pajek makan',
            'jumlah' => 150000
        ]);

        tagihan_master_model::create([
            'name' => 'Shariah TPQ',
            'keterangan' => 'Shariah TPQ',
            'jumlah' => 8000
        ]);

        tagihan_master_model::create([
            'name' => 'Shariah Madin',
            'keterangan' => 'Shariah Madin',
            'jumlah' => 15000
        ]);
    }
}
