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

    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return 'https://placehold.co/400x400/e8f5ee/00923F?text=' . urlencode($this->name ?? 'Produk');
        }

        // Absolute URL
        if (\Illuminate\Support\Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        // Legacy: public folder path (/images/... atau images/...)
        if (\Illuminate\Support\Str::startsWith($this->image, ['/images/', 'images/'])) {
            return asset(ltrim($this->image, '/'));
        }

        // Legacy: stored as 'public/products/...' (old public disk path)
        if (\Illuminate\Support\Str::startsWith($this->image, 'public/')) {
            return asset('storage/' . substr($this->image, 7));
        }

        // S3 / Supabase storage
        return \Illuminate\Support\Facades\Storage::disk('s3')->url($this->image);
    }
}
