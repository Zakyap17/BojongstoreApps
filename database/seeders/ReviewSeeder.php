<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            [
                'user_name' => 'Rizky A.',
                'rating' => 5,
                'comment' => 'Rasanya enak banget, bumbunya meresap sampai ke dalam daging. Pedasnya pas, cocok banget dimakan sama nasi hangat.',
                'product_id' => 'rendang-kemasan',
                'created_at' => '2026-04-15 10:00:00',
            ],
            [
                'user_name' => 'Siti N.',
                'rating' => 5,
                'comment' => 'Bumbunya berasa banget rempahnya, khas masakan rumahan. Jadi inget masakan ibu di kampung.',
                'product_id' => 'rendang-kemasan',
                'created_at' => '2026-04-14 11:30:00',
            ],
            [
                'user_name' => 'Andi P.',
                'rating' => 5,
                'comment' => 'Packaging rapi dan higienis. Rendangnya juga tahan lama, cocok buat stok di rumah. Recommended banget!',
                'product_id' => 'rendang-kemasan',
                'created_at' => '2026-04-14 14:20:00',
            ],
            [
                'user_name' => 'Dewi M.',
                'rating' => 5,
                'comment' => 'Ini sih rendang terenak yang pernah gua coba dari UMKM. Dagingnya empuk, ga alot sama sekali.',
                'product_id' => 'rendang-kemasan',
                'created_at' => '2026-04-13 09:15:00',
            ],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
