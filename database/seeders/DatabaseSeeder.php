<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'admin@banjarsari.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('admin12345'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@bojongstore.com'],
            [
                'name' => 'Admin BojongStore',
                'password' => bcrypt('pplsi4702'),
                'role' => 'admin',
            ]
        );
    }
}
