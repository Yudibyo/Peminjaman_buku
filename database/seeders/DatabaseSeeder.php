<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        
        // Buat data admin di tabel users dengan role 'admin'
        \App\Models\User::create([
            'nama' => 'Admin',
            'email' => 'admin@example.com',
            'phone' => '081234567890',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);
    }
}
