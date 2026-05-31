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

        // Calculate Review Growth
        $thisMonthReviews = Review::whereMonth('created_at', \Carbon\Carbon::now()->month)
                                  ->whereYear('created_at', \Carbon\Carbon::now()->year)->count();
        $lastMonthReviews = Review::whereMonth('created_at', \Carbon\Carbon::now()->subMonth()->month)
                                  ->whereYear('created_at', \Carbon\Carbon::now()->subMonth()->year)->count();
        $reviewGrowth = $lastMonthReviews == 0 ? ($thisMonthReviews > 0 ? 100 : 0) : round((($thisMonthReviews - $lastMonthReviews) / $lastMonthReviews) * 100);

        // Calculate Satisfaction
        $thisMonth5StarReviews = Review::whereMonth('created_at', \Carbon\Carbon::now()->month)
                                       ->whereYear('created_at', \Carbon\Carbon::now()->year)
                                       ->where('rating', 5)->count();
        $percentage5Stars = $thisMonthReviews > 0 ? round(($thisMonth5StarReviews / $thisMonthReviews) * 100) : 0;
        $satisfactionLabel = 'Belum Ada Data';
        if ($thisMonthReviews > 0) {
            if ($percentage5Stars >= 80) $satisfactionLabel = 'Sangat Memuaskan';
            elseif ($percentage5Stars >= 60) $satisfactionLabel = 'Memuaskan';
            elseif ($percentage5Stars >= 40) $satisfactionLabel = 'Cukup';
            else $satisfactionLabel = 'Kurang';
        }

        return view('admin.review.index', compact('reviews', 'total', 'avg_rating', 'rating', 'sort', 'reviewGrowth', 'percentage5Stars', 'satisfactionLabel'));
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Ulasan berhasil dihapus.');
    }
}
