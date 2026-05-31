<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Menampilkan daftar produk favorit pengguna.
     */
    public function index()
    {
        // Get the authenticated user's favorite products
        $products = Auth::user()->favorites()->latest()->get();
        return view('favorit', compact('products'));
    }

    /**
     * Menambah atau menghapus produk dari favorit (Toggle).
     */
    public function toggle(Request $request, Product $product)
    {
        $user = Auth::user();

        // Toggle the product in the user's favorites
        if ($user->favorites()->where('product_id', $product->id)->exists()) {
            $user->favorites()->detach($product->id);
            $message = 'Produk dihapus dari favorit.';
        } else {
            $user->favorites()->attach($product->id);
            $message = 'Produk ditambahkan ke favorit.';
        }

        // Return back with a success message
        return back()->with('success', $message);
    }
}
