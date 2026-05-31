<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name', 'umkm_name', 'reviewer_name', 'reviewer_initials',
        'is_verified', 'rating', 'content', 'product_image',
        'user_id', 'user_name', 'comment', 'product_id',
    ];

    protected $casts = ['is_verified' => 'boolean'];

    protected static function booted()
    {
        static::saving(function ($review) {
            // Sync user_name and reviewer_name
            if ($review->user_name && !$review->reviewer_name) {
                $review->reviewer_name = $review->user_name;
            } elseif ($review->reviewer_name && !$review->user_name) {
                $review->user_name = $review->reviewer_name;
            }

            // Sync comment and content
            if ($review->comment && !$review->content) {
                $review->content = $review->comment;
            } elseif ($review->content && !$review->comment) {
                $review->comment = $review->content;
            }

            // Auto-generate initials
            if ($review->reviewer_name && !$review->reviewer_initials) {
                $words = explode(' ', trim($review->reviewer_name));
                $initials = '';
                foreach ($words as $word) {
                    $initials .= strtoupper(substr($word, 0, 1));
                }
                $review->reviewer_initials = substr($initials, 0, 4);
            }

            // Auto-populate product details from product_id (slug) if not set
            if ($review->product_id && !$review->product_name) {
                $product = Product::where('slug', $review->product_id)->first();
                if ($product) {
                    $review->product_name = $product->name;
                    if (!$review->umkm_name) {
                        $review->umkm_name = $product->seller ?? 'UMKM Bojongsoang';
                    }
                    if (!$review->product_image) {
                        $review->product_image = $product->image;
                    }
                }
            }

            // Auto-populate product_id (slug) from product_name if not set
            if ($review->product_name && !$review->product_id) {
                $product = Product::where('name', $review->product_name)->first();
                if ($product) {
                    $review->product_id = $product->slug;
                } else {
                    $review->product_id = \Str::slug($review->product_name);
                }
            }
        });
    }

    public function getStarsHtmlAttribute(): string
    {
        $filled = str_repeat('<i class="bx bxs-star text-yellow-400 text-sm"></i>', $this->rating);
        $empty  = str_repeat('<i class="bx bx-star text-yellow-200 text-sm"></i>', 5 - $this->rating);
        return $filled . $empty;
    }
}
