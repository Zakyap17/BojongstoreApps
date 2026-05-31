<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class FeaturedProductSeeder extends Seeder
{
    /**
     * Tandai produk unggulan berdasarkan slug.
     * - Rendang Daging Sapi Kemasan - 300g  => is_featured = true
     * - Cimol Bojot Frozen Premium          => is_featured = true
     * - Semua produk lainnya                => is_featured = false
     */
    public function run(): void
    {
        // Set semua ke false dulu
        Product::query()->update(['is_featured' => false]);

        // Tandai produk unggulan
        $featuredSlugs = [
            'rendang-kemasan',
            'cimol-bojot-frozen',
            'es-cendol-durian-bojong',
        ];

        Product::whereIn('slug', $featuredSlugs)->update(['is_featured' => true]);
    }
}
