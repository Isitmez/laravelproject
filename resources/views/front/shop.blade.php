@extends('layouts.home')
@section('title', __('Products'))
@section('meta_description', 'Tüm ürünleri inceleyin, filtreleyin ve sepete ekleyin.')

@push('styles')
<style>
    /* ── Shop Sidebar ──────────────────────────────── */
    .filter-card {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.05);
        border-radius: 20px;
        overflow: hidden;
        position: sticky;
        top: 80px;
    }
    html.dark-mode .filter-card {
        background: #16151c;
        border-color: rgba(255,255,255,0.06);
    }
    .filter-header {
        background: linear-gradient(135deg, #1a1a2e, #0f3460);
        padding: 1.2rem 1.4rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .filter-header-title {
        color: #ffffff;
        font-weight: 700;
        font-size: 0.95rem;
        margin: 0;
    }
    .filter-body {
        padding: 1.4rem;
    }
    .filter-section-label {
        font-size: 0.7rem;
        font-weight: 700;
        color: #a0aec0;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 0.7rem;
        display: block;
    }
    .filter-search {
        background: #f8f9fa !important;
        border: 1px solid rgba(0,0,0,0.07) !important;
        border-radius: 12px !important;
        font-size: 0.875rem !important;
        padding: 0.6rem 1rem !important;
        transition: all 0.3s ease !important;
    }
    .filter-search:focus {
        background: #fff !important;
        border-color: #e94560 !important;
        box-shadow: 0 0 0 3px rgba(233,69,96,0.08) !important;
    }
    html.dark-mode .filter-search {
        background: #1d1b26 !important;
        border-color: rgba(255,255,255,0.08) !important;
        color: #fff !important;
    }
    html.dark-mode .filter-search:focus {
        background: #16151c !important;
    }
    .cat-btn {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 8px 12px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        color: #4a5568;
        background: transparent;
        border: 1px solid transparent;
        width: 100%;
        text-align: left;
    }
    html.dark-mode .cat-btn { color: #a0aec0; }
    .cat-btn:hover {
        background: rgba(233,69,96,0.06);
        color: #e94560;
        border-color: rgba(233,69,96,0.12);
    }
    .cat-btn.active {
        background: linear-gradient(135deg, rgba(233,69,96,0.12), rgba(255,117,140,0.06));
        color: #e94560;
        border-color: rgba(233,69,96,0.2);
        font-weight: 700;
    }
    .cat-btn-count {
        font-size: 0.7rem;
        background: rgba(0,0,0,0.05);
        border-radius: 10px;
        padding: 2px 8px;
        color: #a0aec0;
        font-weight: 600;
    }
    .cat-btn.active .cat-btn-count {
        background: rgba(233,69,96,0.1);
        color: #e94560;
    }
    html.dark-mode .cat-btn-count { background: rgba(255,255,255,0.06); }
    .price-range-input {
        background: #f8f9fa !important;
        border: 1px solid rgba(0,0,0,0.07) !important;
        border-radius: 10px !important;
        font-size: 0.875rem !important;
        padding: 0.5rem 0.75rem !important;
        text-align: center;
        transition: all 0.3s ease !important;
        width: 100%;
    }
    .price-range-input:focus {
        background: #fff !important;
        border-color: #e94560 !important;
        box-shadow: 0 0 0 3px rgba(233,69,96,0.08) !important;
    }
    html.dark-mode .price-range-input {
        background: #1d1b26 !important;
        border-color: rgba(255,255,255,0.08) !important;
        color: #fff !important;
    }
    .btn-filter-apply {
        background: linear-gradient(135deg, #e94560, #ff758c) !important;
        border: none !important;
        border-radius: 12px !important;
        color: #fff !important;
        font-weight: 700 !important;
        font-size: 0.875rem !important;
        padding: 0.65rem !important;
        width: 100%;
        transition: all 0.25s ease;
    }
    .btn-filter-apply:hover {
        box-shadow: 0 6px 18px rgba(233,69,96,0.35);
        transform: translateY(-1px);
    }
    .btn-filter-clear {
        border: 1px solid rgba(0,0,0,0.1) !important;
        border-radius: 12px !important;
        color: #6b7280 !important;
        font-size: 0.875rem !important;
        padding: 0.6rem !important;
        width: 100%;
        background: transparent !important;
        transition: all 0.2s ease;
    }
    .btn-filter-clear:hover {
        border-color: #e94560 !important;
        color: #e94560 !important;
    }
    html.dark-mode .btn-filter-clear { border-color: rgba(255,255,255,0.1) !important; color: #a0aec0 !important; }

    /* ── Sort Bar ───────────────────────────────────── */
    .sort-bar {
        background: #fff;
        border: 1px solid rgba(0,0,0,0.05);
        border-radius: 14px;
        padding: 0.75rem 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }
    html.dark-mode .sort-bar {
        background: #16151c;
        border-color: rgba(255,255,255,0.06);
    }
    .sort-select {
        background: #f8f9fa !important;
        border: 1px solid rgba(0,0,0,0.07) !important;
        border-radius: 10px !important;
        font-size: 0.85rem !important;
        padding: 0.45rem 0.9rem !important;
        color: #1a202c !important;
        transition: all 0.2s ease !important;
    }
    .sort-select:focus {
        border-color: #e94560 !important;
        box-shadow: 0 0 0 3px rgba(233,69,96,0.08) !important;
        background: #fff !important;
    }
    html.dark-mode .sort-select {
        background: #1d1b26 !important;
        border-color: rgba(255,255,255,0.08) !important;
        color: #fff !important;
    }
    .result-count { font-size: 0.875rem; color: #6b7280; }
    html.dark-mode .result-count { color: #a0aec0; }

    /* ── Out of Stock Overlay ──────────────────────── */
    .out-of-stock-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 3;
        backdrop-filter: blur(2px);
    }
    .out-of-stock-badge {
        background: rgba(0,0,0,0.7);
        color: #fff;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: 1px solid rgba(255,255,255,0.15);
    }

    /* ── Pagination ─────────────────────────────────── */
    .pagination .page-link {
        border-radius: 10px !important;
        margin: 0 2px;
        border: 1px solid rgba(0,0,0,0.07);
        color: #4a5568;
        font-size: 0.875rem;
        padding: 0.45rem 0.9rem;
        transition: all 0.2s ease;
    }
    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #e94560, #ff758c) !important;
        border-color: transparent !important;
        box-shadow: 0 4px 12px rgba(233,69,96,0.3);
    }
    .pagination .page-link:hover {
        background: rgba(233,69,96,0.08);
        border-color: rgba(233,69,96,0.2);
        color: #e94560;
    }

    /* ── Product Card V2 ────────────────────────────── */
    .product-card-v2 {
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.06);
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
    }
    .product-card-v2:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
    }
    html.dark-mode .product-card-v2 {
        background: #16151c;
        border-color: rgba(255,255,255,0.06);
    }
    html.dark-mode .product-card-v2:hover {
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
    }

    .product-card-v2 .img-wrap {
        position: relative;
        height: 220px;
        background: #f8f9fa;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    html.dark-mode .product-card-v2 .img-wrap {
        background: #1d1b26;
    }

    .product-card-v2 .img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .product-card-v2:hover .img-wrap img {
        transform: scale(1.05);
    }

    .product-badge {
        position: absolute;
        top: 12px;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
        z-index: 2;
        text-transform: uppercase;
    }
    .badge-discount {
        right: 12px;
        background: #e94560;
        color: #fff;
        box-shadow: 0 4px 10px rgba(233, 69, 96, 0.25);
    }

    .img-actions {
        position: absolute;
        inset: 0;
        background: rgba(15, 14, 19, 0.45);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        opacity: 0;
        transition: all 0.3s ease;
        backdrop-filter: blur(2px);
        z-index: 2;
        padding: 15px;
    }
    .product-card-v2:hover .img-actions {
        opacity: 1;
    }

    .img-action-btn {
        width: 85%;
        background: #ffffff;
        color: #1a1a2e;
        border: none;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .img-action-btn:hover {
        background: #e94560;
        color: #ffffff;
    }

    .card-info {
        padding: 16px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .product-category-tag {
        font-size: 0.68rem;
        font-weight: 600;
        color: #a0aec0;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 6px;
    }

    .product-title-v2 {
        font-size: 0.875rem;
        font-weight: 600;
        color: #1a1a2e;
        line-height: 1.4;
        margin-bottom: 8px;
        flex-grow: 1;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 38px;
    }
    html.dark-mode .product-title-v2 {
        color: #ffffff;
    }

    .star-row {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 12px;
    }
    .star-row .stars {
        color: #f59e0b;
        font-size: 0.72rem;
        letter-spacing: 1.5px;
    }
    .star-row .rating-count {
        color: #a0aec0;
        font-size: 0.7rem;
    }

    .product-price-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 12px;
        border-top: 1px solid rgba(0,0,0,0.05);
        margin-top: auto;
    }
    html.dark-mode .product-price-row {
        border-color: rgba(255,255,255,0.06);
    }

    .price-current {
        font-size: 1.1rem;
        font-weight: 800;
        color: #e94560;
    }
    .price-old {
        font-size: 0.75rem;
        color: #a0aec0;
        text-decoration: line-through;
        display: block;
        margin-top: 1px;
    }

    .btn-add-cart {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        background: #e94560;
        color: #ffffff;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .btn-add-cart:hover {
        background: #d63350;
        transform: scale(1.05);
    }
</style>
@endpush

@section('content')

{{-- ── Page Header ─────────────────────────────────────────────── --}}
<div class="py-4 mb-4 premium-banner" style="padding: 1.5rem 0;">
    <div class="container-fluid px-4 px-lg-5">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h1 class="text-white fw-bold mb-1" style="font-size:1.7rem; letter-spacing:-0.3px;">
                    @if(request('search'))
                        <i class="bi bi-search me-2"></i>"{{ request('search') }}" {{ __('Search Results') }}
                    @else
                        <i class="bi bi-grid me-2"></i>{{ __('Products') }}
                    @endif
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0" style="font-size:0.8rem;">
                        <li class="breadcrumb-item"><a href="{{ route('front.home') }}" class="text-white-50 text-decoration-none">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item text-white active">{{ __('Products') }}</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-white text-danger fw-bold px-3 py-2" style="font-size:0.85rem; border-radius:20px;">
                    {{ $products->total() }} {{ __('products found') }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-4 px-lg-5 pb-5">
    <div class="row g-4">

        {{-- ── Sidebar Filter ─────────────────────────────────────── --}}
        <div class="col-lg-3">
            <div class="filter-card shadow-sm">
                <div class="filter-header">
                    <i class="bi bi-sliders text-white" style="font-size:1rem;"></i>
                    <h6 class="filter-header-title">{{ __('Filter') }}</h6>
                </div>
                <div class="filter-body">
                    <form method="GET" action="{{ route('shop.index') }}" id="filterForm">

                        {{-- Search --}}
                        <div class="mb-4">
                            <span class="filter-section-label">{{ __('Search') }}</span>
                            <div class="position-relative">
                                <input type="text" name="search" class="form-control filter-search"
                                       placeholder="{{ __('Search products...') }}" value="{{ request('search') }}">
                            </div>
                        </div>

                        {{-- Categories --}}
                        <div class="mb-4">
                            <span class="filter-section-label">{{ __('Category') }}</span>
                            <div class="d-flex flex-column gap-1">
                                <a href="{{ route('shop.index', request()->except('category')) }}"
                                   class="cat-btn {{ !$selectedCategory ? 'active' : '' }}">
                                    <span>{{ __('All') }}</span>
                                    <span class="cat-btn-count">{{ $products->total() }}</span>
                                </a>
                                @foreach($categories as $cat)
                                <a href="{{ route('shop.index', array_merge(request()->except('category'), ['category' => $cat->id])) }}"
                                   class="cat-btn {{ $selectedCategory == $cat->id ? 'active' : '' }}">
                                    <span>{{ __($cat->title) }}</span>
                                    <span class="cat-btn-count">{{ $cat->products_count ?? '' }}</span>
                                </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- Price Range --}}
                        <div class="mb-4">
                            <span class="filter-section-label">{{ __('Price Range') }}</span>
                            <div class="d-flex align-items-center gap-2">
                                <input type="number" name="min_price" class="price-range-input"
                                       placeholder="Min $" value="{{ request('min_price') }}">
                                <span style="color:#a0aec0; font-size:0.8rem;">—</span>
                                <input type="number" name="max_price" class="price-range-input"
                                       placeholder="Max $" value="{{ request('max_price') }}">
                            </div>
                        </div>

                        {{-- Sort --}}
                        <div class="mb-4">
                            <span class="filter-section-label">{{ __('Sort By') }}</span>
                            <select name="sort" class="form-select sort-select" onchange="this.form.submit()">
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>{{ __('Newest') }}</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>{{ __('Price: Low to High') }}</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>{{ __('Price: High to Low') }}</option>
                            </select>
                        </div>

                        <div class="d-flex flex-column gap-2">
                            <button type="submit" class="btn-filter-apply">
                                <i class="bi bi-search me-2"></i>{{ __('Filter') }}
                            </button>
                            <a href="{{ route('shop.index') }}" class="btn-filter-clear text-center text-decoration-none">
                                <i class="bi bi-x-circle me-1"></i>{{ __('Clear') }}
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        {{-- ── Products Grid ───────────────────────────────────────── --}}
        <div class="col-lg-9">
            {{-- Sort Bar --}}
            <div class="sort-bar shadow-sm">
                <p class="result-count mb-0">
                    <strong>{{ $products->total() }}</strong> {{ __('products found') }}
                    @if(request('search'))
                        — {{ __('for') }} "<strong>{{ request('search') }}</strong>"
                    @endif
                </p>
                <div class="d-flex align-items-center gap-2">
                    <span class="result-count d-none d-md-inline">{{ __('Sort By') }}:</span>
                    <select name="sort" class="form-select sort-select" style="width:auto;"
                            onchange="document.getElementById('filterForm').querySelector('[name=sort]').value = this.value; document.getElementById('filterForm').submit();">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>{{ __('Newest') }}</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>{{ __('Price: Low to High') }}</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>{{ __('Price: High to Low') }}</option>
                    </select>
                </div>
            </div>

            <div class="row g-4">
                @forelse($products as $product)
                <div class="col-6 col-md-4 col-xl-3">
                    <div class="product-card-v2">
                        <div class="img-wrap">
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100" style="font-size:3.5rem; background:#f8f9fa;">🛍️</div>
                            @endif

                            @if($product->hasDiscount())
                                <span class="product-badge badge-discount">-{{ $product->discount }}%</span>
                            @endif

                            @if(!$product->isInStock())
                                <div class="out-of-stock-overlay">
                                    <span class="out-of-stock-badge">{{ __('Out of Stock') }}</span>
                                </div>
                            @else
                                <div class="img-actions">
                                    <button type="button" class="img-action-btn" onclick="showQuickView({{ $product->id }})">
                                        <i class="bi bi-eye-fill"></i> {{ __('Quick View') }}
                                    </button>
                                    <form action="{{ route('cart.add') }}" method="POST" class="m-0">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="img-action-btn">
                                            <i class="bi bi-cart-plus"></i> {{ __('Add to Cart') }}
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>

                        <div class="card-info">
                            <div class="product-category-tag">{{ __($product->category?->title) }}</div>
                            <div class="product-title-v2">{{ Str::limit($product->title, 55) }}</div>
                            <div class="star-row">
                                <span class="stars">★★★★★</span>
                                <span class="rating-count">({{ rand(8, 120) }})</span>
                            </div>
                            <div class="product-price-row">
                                <div>
                                    <span class="price-current">${{ number_format($product->getDiscountedPrice(), 2) }}</span>
                                    @if($product->hasDiscount())
                                        <span class="price-old">${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                                @if($product->isInStock())
                                <form action="{{ route('cart.add') }}" method="POST" class="m-0">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn-add-cart" title="{{ __('Add to Cart') }}">
                                        <i class="bi bi-cart-plus"></i>
                                    </button>
                                </form>
                                @else
                                <span class="badge bg-secondary" style="font-size:0.7rem; border-radius:8px;">{{ __('Out of Stock') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5 my-3">
                        <div style="font-size:4rem;" class="mb-3">🔍</div>
                        <h5 class="fw-bold text-muted mb-2">{{ __('No products found') }}</h5>
                        <p class="text-muted small mb-4">{{ __('Try different filters.') }}</p>
                        <a href="{{ route('shop.index') }}" class="btn text-white px-4 py-2"
                           style="background:#e94560; border-radius:30px; font-weight:600;">
                            <i class="bi bi-x-circle me-2"></i>{{ __('Clear Filters') }}
                        </a>
                    </div>
                </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($products->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $products->links() }}
            </div>
            @endif
        </div>

    </div>
</div>

@endsection
