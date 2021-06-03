<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@mailnesia.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin@mailnesia.com'),
            'no_hp1' => '6285647451640',
            'no_hp2' => '6285647451640',
            'id_yayasan' => 1
        ]);

        $admin->assignRole('admin');
    }
}
