<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UlasanController;

// User Controllers
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\FavoriteController;

// Admin Controllers
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\ComplaintController;

// ======= HALAMAN UTAMA & FRONTEND (dari main) =======
Route::get('/', function () {
    $mostViewedProduct = \App\Models\Product::orderBy('views', 'desc')->first();
    return view('home', compact('mostViewedProduct'));
})->name('home');

// Alias beranda untuk kompabilitas
Route::get('/beranda', function () {
    $mostViewedProduct = \App\Models\Product::orderBy('views', 'desc')->first();
    return view('home', compact('mostViewedProduct'));
})->name('beranda');

Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('product-detail');
Route::get('/search', [ProductController::class, 'search'])->name('product.search');
Route::get('/katalog', [ProductController::class, 'katalog'])->name('katalog');
Route::get('/produk', [ProductController::class, 'produkPage'])->name('produk');

// Guest: tampilkan halaman (produk dimuat dari DB jika login, kosong jika tidak)
Route::get('/favorit', function () {
    if (auth()->check()) {
        return app(FavoriteController::class)->index();
    }
    $products = collect();
    return view('favorit', compact('products'));
})->name('favorit');

// ======= ULASAN / REVIEWS (dari main) =======
Route::post('/reviews', [UlasanController::class, 'store'])->name('reviews.store');
Route::get('/api/reviews/{product_id}', [UlasanController::class, 'getReviews']);
Route::delete('/reviews/{id}', [UlasanController::class, 'destroy']);

// ======= BANTUAN / HELP COMPLAINTS (dari main) =======
Route::post('/help-complaints', [\App\Http\Controllers\HelpComplaintController::class, 'store'])->name('help-complaints.store');

// ======= AUTH ROUTES =======
require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth'])->name('dashboard');

// ======= USER DASHBOARD =======
Route::middleware(['auth', 'userMiddleware'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
});

// ======= FAVORITES API (auth required) =======
Route::middleware('auth')->group(function () {
    Route::get('/api/favorites', [FavoriteController::class, 'list'])->name('favorites.list');
    Route::post('/api/favorites/{product}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
});

// ======= PROFILE (AUTH REQUIRED) =======
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ======= ADMIN ROUTES =======
Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('admin/products', \App\Http\Controllers\admin\ProductController::class)->names('admin.products');
    Route::post('/admin/products/{product}/toggle-featured', [\App\Http\Controllers\admin\ProductController::class, 'toggleFeatured'])->name('admin.products.toggleFeatured');
    // Review
    Route::get('/admin/review', [\App\Http\Controllers\admin\ReviewController::class, 'index'])->name('admin.review.index');
    Route::delete('/admin/review/{review}', [\App\Http\Controllers\admin\ReviewController::class, 'destroy'])->name('admin.review.destroy');

    // Complaints
    Route::get('/admin/complaints', [ComplaintController::class, 'index'])->name('admin.complaints.index');
    Route::delete('/admin/complaints/{id}', [ComplaintController::class, 'destroy'])->name('admin.complaints.destroy');
});
