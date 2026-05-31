<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class UlasanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'product_id' => 'required|string',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'user_name' => auth()->check() ? auth()->user()->name : 'Anonim',
            'rating' => $request->rating,
            'comment' => $request->comment,
            'product_id' => $request->product_id,
        ]);

        return response()->json(['message' => 'Ulasan berhasil dikirim!']);
    }

    public function getReviews($product_id)
    {
        $reviews = Review::where('product_id', $product_id)->latest()->get();
        return response()->json($reviews);
    }

    public function destroy($id)
    {
        Review::destroy($id);
        return response()->json(['message' => 'Ulasan berhasil dihapus!']);
    }
}
