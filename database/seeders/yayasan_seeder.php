<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\yayasan_model;

class yayasan_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        yayasan_model::create([
            'nama' => 'Pondok Pesantren',
            'status' => 1
        ]);

        yayasan_model::create([
            'nama' => 'TPQ',
            'status' => 1
        ]);
        
    }
}
