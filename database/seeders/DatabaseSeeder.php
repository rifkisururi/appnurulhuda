<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(tagihan_master_seeder::class);
        $this->call(roleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(yayasan_seeder::class);
    }
}
