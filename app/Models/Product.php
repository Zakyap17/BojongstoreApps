<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'image',
        'shoppee', 'whatsapp', 'weight', 'type', 'packaging',
        'shelf_life', 'production', 'category_id', 'views', 'is_featured',
        'tags', 'seller',
    ];

    protected $appends = ['image_url', 'shop_name'];

    protected $casts = [
        'tags' => 'array',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'slug');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeNotFeatured($query)
    {
        return $query->where('is_featured', false);
    }

    public function getShopNameAttribute(): string
    {
        return $this->seller ?? 'UMKM Bojongsoang';
    }

    /**
     * Get the correct image URL regardless of how the path was stored.
     * Handles 3 formats:
     *   - '/images/foo.png'     → asset('/images/foo.png')
     *   - 'public/products/...' → asset('storage/products/...')
     *   - 'images/foo.png'      → asset('images/foo.png')
     */
    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return 'https://placehold.co/400x400/e8f5ee/00923F?text=' . urlencode($this->name ?? 'Produk');
        }

        // Already an absolute URL (e.g. http://...)
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        // Stored as 'public/...' (Laravel storage disk path)
        if (str_starts_with($this->image, 'public/')) {
            return asset('storage/' . substr($this->image, 7));
        }

        // Stored as '/images/...' or 'images/...' (public folder path)
        return asset(ltrim($this->image, '/'));
    }
}
