{{-- resources/views/katalog.blade.php --}}
@extends('layouts.landing')
@section('content')

    <style>
        :root {
            --green: #00923F;
            --green-dark: #007a34;
            --green-light: #e8f5ee;
            --text-dark: #1a1a1a;
            --text-muted: #6b7280;
            --border: #e5e7eb;
            --card-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            --card-shadow-hover: 0 8px 32px rgba(0, 146, 63, 0.12);
            --bg-gray: #f9fafb;
        }

        .katalog-wrapper {
            padding-top: 40px;
            min-height: 100vh;
            background: #ffffff;
            font-family: 'Inter', sans-serif;
        }

        .katalog-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 32px 24px;
            display: flex;
            gap: 32px;
            align-items: flex-start;
        }

        body {
            overflow-x: clip !important;
        }

        /* Sidebar */
        .sidebar-filter {
            width: 260px;
            flex-shrink: 0;
            position: -webkit-sticky;
            position: sticky;
            top: 100px;
            height: auto;
            align-self: flex-start;
            z-index: 10;
        }

        .filter-group {
            margin-bottom: 24px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--border);
        }
        
        .filter-group:last-child {
            border-bottom: none;
        }

        .filter-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Checkbox Styles */
        .checkbox-container {
            display: flex;
            align-items: center;
            position: relative;
            padding-left: 30px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 14px;
            color: var(--text-dark);
            user-select: none;
        }

        .checkbox-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #fff;
            border: 1.5px solid var(--border);
            border-radius: 4px;
            transition: all 0.2s;
        }

        .checkbox-container:hover input ~ .checkmark {
            border-color: var(--green);
        }

        .checkbox-container input:checked ~ .checkmark {
            background-color: var(--green);
            border-color: var(--green);
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .checkbox-container input:checked ~ .checkmark:after {
            display: block;
        }

        .checkbox-container .checkmark:after {
            left: 6px;
            top: 2px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        /* Price Inputs */
        .price-inputs {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .price-inputs input {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
            font-family: inherit;
            outline: none;
            transition: border-color 0.2s;
        }

        .price-inputs input:focus {
            border-color: var(--green);
        }

        .btn-apply, .btn-clear {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            font-family: inherit;
            text-align: center;
            display: block;
            text-decoration: none;
        }

        .btn-apply {
            background: var(--green);
            color: white;
            border: none;
            margin-bottom: 10px;
        }

        .btn-apply:hover {
            background: var(--green-dark);
        }

        .btn-clear {
            background: white;
            color: var(--text-dark);
            border: 1px solid var(--border);
        }

        .btn-clear:hover {
            background: var(--bg-gray);
            color: var(--text-dark);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            min-width: 0;
        }

        .katalog-header {
            margin-bottom: 24px;
        }

        .breadcrumbs {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 8px;
        }
        
        .breadcrumbs span {
            color: var(--text-dark);
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .filter-count {
            background: var(--green);
            color: white;
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 12px;
            font-weight: 600;
            vertical-align: middle;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .result-count {
            font-size: 14px;
            color: var(--text-muted);
        }


        .mobile-filter-btn {
            display: none;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 12px 16px;
            background: var(--green);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            margin-bottom: 16px;
        }

        .mobile-filter-btn:hover {
            background: var(--green-dark);
        }

        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        @media (max-width: 1024px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .mobile-filter-btn {
                display: flex;
            }
            .katalog-container {
                flex-direction: column;
                gap: 16px;
                padding: 16px;
            }
            .sidebar-filter {
                width: 100%;
                position: static;
                display: none;
                background: #f9fafb;
                padding: 20px;
                border-radius: 12px;
                border: 1px solid var(--border);
            }
            .sidebar-filter.show-filters {
                display: block;
            }
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
        }
        
        @media (max-width: 480px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }
            .product-card {
                padding: 16px 12px;
            }
            .product-image {
                height: 110px;
                margin-bottom: 12px;
            }
            .product-title {
                font-size: 13px;
                height: 34px;
            }
            .product-price {
                font-size: 14px;
                margin-bottom: 12px;
            }
            .btn-secondary {
                padding: 8px 12px;
                font-size: 12px;
            }
        }

        /* Product Card */
        .product-card {
            background: var(--white);
            border: 1.5px solid #f1f5f9;
            border-radius: 8px;
            padding: 24px;
            text-align: center;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            text-decoration: none;
        }

        .product-card:hover {
            border-color: var(--green);
            box-shadow: var(--card-shadow-hover);
            transform: translateY(-4px);
        }

        .product-image-container {
            position: relative;
            width: 100%;
        }

        .product-image {
            width: 100%;
            height: 160px;
            object-fit: contain;
            margin-bottom: 20px;
            background: #f8fafc;
            border-radius: 4px;
        }

        .wishlist-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: white;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            cursor: pointer;
            z-index: 10;
            transition: all 0.2s;
            color: #94a3b8;
        }

        .wishlist-btn:hover {
            transform: scale(1.1);
            color: var(--green);
        }

        .wishlist-btn.active {
            color: var(--green);
        }

        .wishlist-btn.active i {
            fill: currentColor;
        }

        .product-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1.3;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .product-weight {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .product-price {
            font-size: 18px;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 20px;
            margin-top: auto;
        }

        .btn-secondary {
            background: var(--green);
            color: var(--white);
            padding: 10px 24px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 14px;
            width: 100%;
            text-align: center;
            display: block;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background: var(--green-dark);
            color: white;
            text-decoration: none;
        }

        /* Pagination */
        .pagination-wrap {
            margin-top: 40px;
            display: flex;
            justify-content: center;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: var(--bg-gray);
            border-radius: 16px;
            color: var(--text-muted);
        }
    </style>

    <div class="katalog-wrapper" x-data="{ filterOpen: false }">
        <div class="katalog-container">
            
            <!-- Mobile Toggle Filter Button -->
            <button @click="filterOpen = !filterOpen" class="mobile-filter-btn" type="button">
                <i data-lucide="filter" width="18" height="18"></i>
                <span x-text="filterOpen ? 'Sembunyikan Filter' : 'Tampilkan Filter'">Tampilkan Filter</span>
            </button>

            {{-- Sidebar Filter --}}
            <aside class="sidebar-filter" :class="{ 'show-filters': filterOpen }">
                <form id="filter-form" action="{{ route('katalog') }}" method="GET">
                    
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif

                    <div class="filter-group">
                        <h4 class="filter-title">Kategori</h4>
                        <div class="filter-options">
                            @foreach($categories as $category)
                                <label class="checkbox-container">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}
                                        onchange="document.getElementById('filter-form').submit()">
                                    <span class="checkmark"></span>
                                    {{ $category->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="filter-group">
                        <h4 class="filter-title">Rentang Harga</h4>
                        <div class="price-inputs">
                            <input type="number" name="min_price" placeholder="Min (Rp)" value="{{ request('min_price') }}">
                            <span>-</span>
                            <input type="number" name="max_price" placeholder="Max (Rp)" value="{{ request('max_price') }}">
                        </div>
                        <button type="submit" class="btn-apply">Terapkan</button>
                        <a href="{{ route('katalog') }}" class="btn-clear">Hapus Filter</a>
                    </div>
                </form>
            </aside>

            {{-- Main Content --}}
            <div class="main-content">

                <div class="toolbar">
                    <div class="result-count">Menampilkan {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} item</div>
                </div>

                @if($products->count() > 0)
                    <div class="product-grid">
                        @foreach($products as $product)
                            <div class="product-card">
                                <div class="product-image-container">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-image" loading="lazy">
                                    <button class="wishlist-btn" data-slug="{{ $product->slug }}" data-product-id="{{ $product->id }}"><i data-lucide="bookmark" width="18" height="18"></i></button>
                                </div>
                                <div class="product-title">{{ $product->name }}</div>
                                <div class="product-weight">{{ $product->weight ?? '300 gram' }}</div>
                                <div class="product-rating-card" style="display: flex; align-items: center; justify-content: center; gap: 4px; margin-bottom: 8px;">
                                    <div class="stars" style="display: flex; gap: 2px; color: #fbbf24;">
                                        @php
                                            $averageRating = $product->reviews_avg_rating ?? 0;
                                            $reviewCount = $product->reviews_count ?? 0;
                                            $roundedRating = round($averageRating);
                                        @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i data-lucide="star" fill="{{ $i <= $roundedRating ? '#fbbf24' : 'none' }}" width="14" height="14" style="color: {{ $i <= $roundedRating ? '#fbbf24' : '#e2e8f0' }}"></i>
                                        @endfor
                                    </div>
                                    <span style="font-size: 12px; color: #71717a;">({{ $reviewCount }})</span>
                                </div>
                                <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                <a href="{{ route('product-detail', $product->slug) }}" class="btn-secondary">Lihat Detail</a>
                            </div>
                        @endforeach
                    </div>

                    
                    <div class="pagination-wrap">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <h3>Produk tidak ditemukan</h3>
                        <p>Coba sesuaikan filter atau kata kunci pencarian Anda.</p>
                        <a href="{{ route('katalog') }}" class="btn-apply" style="display:inline-block; width:auto; padding:10px 24px; margin-top:16px;">Clear Semua Filter</a>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <script>
        const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
        const csrfToken = '{{ csrf_token() }}';

        async function initWishlist() {
            if (!isLoggedIn) return;
            try {
                const res = await fetch('/api/favorites', { headers: { 'Accept': 'application/json' } });
                const data = await res.json();
                const favoriteIds = new Set(data.favorites.map(String));
                document.querySelectorAll('.wishlist-btn').forEach(btn => {
                    const pid = btn.getAttribute('data-product-id');
                    if (pid && favoriteIds.has(pid)) {
                        btn.classList.add('active');
                        const icon = btn.querySelector('svg') || btn.querySelector('i');
                        if (icon) icon.setAttribute('fill', 'currentColor');
                    }
                });
            } catch(e) { console.error(e); }
        }

        document.querySelectorAll('.wishlist-btn').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                e.preventDefault();
                if (!isLoggedIn) {
                    window.location.href = '{{ route('login') }}';
                    return;
                }
                const productId = btn.getAttribute('data-product-id');
                if (!productId) return;
                try {
                    const res = await fetch(`/api/favorites/${productId}`, {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
                    });
                    const data = await res.json();
                    btn.classList.toggle('active', data.status === 'added');
                    const icon = btn.querySelector('svg') || btn.querySelector('i');
                    if (icon) icon.setAttribute('fill', data.status === 'added' ? 'currentColor' : 'none');
                } catch(err) { console.error(err); }
            });
        });

        document.addEventListener('DOMContentLoaded', initWishlist);
    </script>
@endsection