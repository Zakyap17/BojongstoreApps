<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $total_products = Product::count();
        $total_categories = Category::count();
        $total_reviews = Review::count();
        $avg_rating = Review::avg('rating') ?? 0;
        $top_products = Product::with('category')->orderBy('views', 'desc')->take(5)->get();

        // Calculate Product Growth
        $thisMonthProducts = Product::whereMonth('created_at', Carbon::now()->month)
                                    ->whereYear('created_at', Carbon::now()->year)->count();
        $lastMonthProducts = Product::whereMonth('created_at', Carbon::now()->subMonth()->month)
                                    ->whereYear('created_at', Carbon::now()->subMonth()->year)->count();
        $productGrowth = $lastMonthProducts == 0 ? ($thisMonthProducts > 0 ? 100 : 0) : round((($thisMonthProducts - $lastMonthProducts) / $lastMonthProducts) * 100);

        // --- REAL VISITOR STATISTICS ---
        $visitorData = [
            'hari' => ['labels' => [], 'data' => []],
            'minggu' => ['labels' => [], 'data' => []],
            'bulan' => ['labels' => [], 'data' => []]
        ];

        $now = Carbon::now();

        // 1. Hari Ini (Grouped by 4-hour intervals)
        $todayVisitors = \App\Models\Visitor::whereDate('date', $now->toDateString())->get();
        $intervals = [
            '00:00' => [0, 3],
            '04:00' => [4, 7],
            '08:00' => [8, 11],
            '12:00' => [12, 15],
            '16:00' => [16, 19],
            '20:00' => [20, 23],
        ];
        foreach ($intervals as $label => $range) {
            $count = $todayVisitors->filter(function($v) use ($range) {
                $hour = $v->created_at->hour;
                return $hour >= $range[0] && $hour <= $range[1];
            })->count();
            $visitorData['hari']['labels'][] = $label;
            $visitorData['hari']['data'][] = $count;
        }

        // 2. Minggu Ini (Last 7 Days)
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $visitorData['minggu']['labels'][] = $date->translatedFormat('D'); // Sen, Sel, etc.
            $visitorData['minggu']['data'][] = \App\Models\Visitor::whereDate('date', $date->toDateString())->count();
        }

        // 3. Bulan Ini (4 Weeks of Current Month)
        // Group days of current month into 4 weeks roughly
        $startOfMonth = Carbon::now()->startOfMonth();
        for ($w = 1; $w <= 4; $w++) {
            $startWeek = $startOfMonth->copy()->addDays(($w-1)*7);
            $endWeek = $w == 4 ? Carbon::now()->endOfMonth() : $startWeek->copy()->addDays(6);
            
            $visitorData['bulan']['labels'][] = 'Minggu ' . $w;
            $visitorData['bulan']['data'][] = \App\Models\Visitor::whereBetween('date', [$startWeek->toDateString(), $endWeek->toDateString()])->count();
        }
        // --------------------------------

        $recent_activities = \App\Models\Activity::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact('total_products', 'total_categories', 'total_reviews', 'avg_rating', 'top_products', 'productGrowth', 'recent_activities', 'visitorData'));
    }
}
