<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($slug)
    {
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('auth_required', 'Anda perlu Login terlebih dahulu untuk mengakses konten.');
        }

        $product = Product::with('category')->where('slug', $slug)->firstOrFail();
        $product->increment('views');
        
        return view('product-detail', compact('product'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $categories = \App\Models\Category::all();
        $products = Product::query()
                    ->withAvg('reviews', 'rating')
                    ->withCount('reviews')
                    ->where(function($q) use ($query) {
                        $q->where('name', 'like', '%' . $query . '%')
                          ->orWhere('description', 'like', '%' . $query . '%')
                          ->orWhere('type', 'like', '%' . $query . '%');
                    })
                    ->paginate(10);

        return view('katalog', compact('products', 'categories', 'query'));
    }

    public function katalog(Request $request)
    {
        $categories = \App\Models\Category::all();

        $products = Product::query()
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->when($request->categories, function ($q) use ($request) {
                $q->whereIn('category_id', $request->categories);
            })
            ->when($request->min_price, function ($q) use ($request) {
                $q->where('price', '>=', $request->min_price);
            })
            ->when($request->max_price, function ($q) use ($request) {
                $q->where('price', '<=', $request->max_price);
            })
            ->when($request->search, fn($q) => $q->where('name', 'like', '%' . $request->search . '%'))
            ->paginate(12)->withQueryString();

        return view('katalog', compact('products', 'categories'));
    }

    public function produkPage(Request $request)
    {
        $featuredProducts = Product::query()
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->featured()
            ->get();

        $regularProducts = Product::query()
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->notFeatured()
            ->get();

        $categories = \App\Models\Category::all();

        return view('produk', compact('featuredProducts', 'regularProducts', 'categories'));
    }
}

