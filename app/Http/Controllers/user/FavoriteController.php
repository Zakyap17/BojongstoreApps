<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Menampilkan daftar produk favorit pengguna dari database.
     */
    public function index()
    {
        $products = Auth::user()
            ->favorites()
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->latest('favorites.created_at')
            ->get();

        return view('favorit', compact('products'));
    }

    /**
     * Mengembalikan ID produk favorit user saat ini (untuk inisialisasi JS).
     */
    public function list()
    {
        if (!Auth::check()) {
            return response()->json(['favorites' => []]);
        }
        $ids = Auth::user()->favorites()->pluck('products.id');
        return response()->json(['favorites' => $ids]);
    }

    /**
     * Toggle favorit via AJAX — menambah atau menghapus dari database.
     */
    public function toggle(Request $request, Product $product)
    {
        $user = Auth::user();

        if ($user->favorites()->where('product_id', $product->id)->exists()) {
            $user->favorites()->detach($product->id);
            $status = 'removed';
        } else {
            $user->favorites()->attach($product->id);
            $status = 'added';
        }

        return response()->json(['status' => $status, 'product_id' => $product->id]);
    }
}
