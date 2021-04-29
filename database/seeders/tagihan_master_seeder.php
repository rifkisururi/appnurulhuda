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
            'name' => 'Tagihan01',
            'keterangan' => 'Tagihan01',
            'jumlah' => 1000
        ]);


        tagihan_master_model::create([
            'name' => 'Tagihan02',
            'keterangan' => 'Tagihan02',
            'jumlah' => 2000
        ]);

        

        tagihan_master_model::create([
            'name' => 'Tagihan03',
            'keterangan' => 'Tagihan03',
            'jumlah' => 3000
        ]);

        tagihan_master_model::create([
            'name' => 'Tagihan04',
            'keterangan' => 'Tagihan04',
            'jumlah' => 4000
        ]);

        tagihan_master_model::create([
            'name' => 'Tagihan05',
            'keterangan' => 'Tagihan05',
            'jumlah' => 5000
        ]);

        tagihan_master_model::create([
            'name' => 'Tagihan06',
            'keterangan' => 'Tagihan06',
            'jumlah' => 6000
        ]);

        tagihan_master_model::create([
            'name' => 'Tagihan07',
            'keterangan' => 'Tagihan07',
            'jumlah' => 7000
        ]);

        tagihan_master_model::create([
            'name' => 'Tagihan08',
            'keterangan' => 'Tagihan08',
            'jumlah' => 8000
        ]);

        tagihan_master_model::create([
            'name' => 'Tagihan09',
            'keterangan' => 'Tagihan09',
            'jumlah' => 9000
        ]);

        tagihan_master_model::create([
            'name' => 'Tagihan10',
            'keterangan' => 'Tagihan10',
            'jumlah' => 10000
        ]);
    }
}
