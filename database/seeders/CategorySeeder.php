<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --- DI SINILAH ANDA MENAMBAHKAN DAFTAR KATEGORI ANDA ---
        $categories = [
            'Sayuran',
            'Buah-buahan',
            'Kerajinan Tangan',
            'Makanan Olahan',
            'Minuman',
            'Jasa',
        ];

        // Kode di bawah ini akan otomatis memasukkan daftar di atas ke database
        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
            ]);
        }
    }
}