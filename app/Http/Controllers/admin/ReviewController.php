<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $rating   = $request->query('rating');
        $sort     = $request->query('sort', 'latest');

        $query = Review::query();

        if ($rating) {
            $query->where('rating', $rating);
        }

        $query->orderBy('created_at', $sort === 'oldest' ? 'asc' : 'desc');

        $reviews       = $query->paginate(10)->withQueryString();
        $total         = Review::count();
        $avg_rating    = Review::count() ? round(Review::avg('rating'), 1) : 0;

        return view('admin.review.index', compact('reviews', 'total', 'avg_rating', 'rating', 'sort'));
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Ulasan berhasil dihapus.');
    }
}
