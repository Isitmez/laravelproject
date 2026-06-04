@extends('layouts.home')
@section('title', 'AzuraShop')
@section('meta_description', 'AzuraShop - En iyi ürünler, en iyi fiyatlar')

@push('styles')
<style>
/* ── HERO ─────────────────────────────────────────── */
.hero-wrap {
    position: relative;
    background: #0f0e17;
    overflow: hidden;
    min-height: 480px;
    display: flex;
    align-items: center;
}
.hero-wrap::before {
    content: '';
    position: absolute; inset: 0;
    background:
        radial-gradient(ellipse at 15% 50%, rgba(233,69,96,0.18) 0%, transparent 55%),
        radial-gradient(ellipse at 85% 20%, rgba(99,102,241,0.14) 0%, transparent 55%);
    pointer-events: none;
}
.hero-slider-item { width: 100%; }
.hero-content { position: relative; z-index: 2; padding: 4rem 0; }
.hero-tag {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(233,69,96,0.18);
    border: 1px solid rgba(233,69,96,0.35);
    border-radius: 6px;
    padding: 4px 12px;
    font-size: 0.72rem; font-weight: 700;
    color: #ff758c;
    letter-spacing: 1px; text-transform: uppercase;
    margin-bottom: 1rem;
}
.hero-heading {
    font-size: clamp(1.8rem, 4vw, 2.8rem);
    font-weight: 800; color: #ffffff;
    line-height: 1.2; letter-spacing: -0.5px;
    margin-bottom: 0.8rem;
}
.hero-heading span { color: #e94560; }
.hero-desc {
    color: rgba(255,255,255,0.6);
    font-size: 1rem; line-height: 1.65;
    margin-bottom: 1.8rem;
    max-width: 480px;
}
.hero-btn-main {
    display: inline-flex; align-items: center; gap: 8px;
    background: #e94560; color: #fff;
    padding: 0.75rem 1.8rem; border-radius: 8px;
    font-weight: 600; font-size: 0.925rem;
    text-decoration: none;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid #e94560;
    letter-spacing: 0.3px;
}
.hero-btn-main:hover { 
    background: #d63350; border-color: #d63350; color: #fff; 
    transform: translateY(-1px); 
    box-shadow: 0 4px 15px rgba(233,69,96,0.3); 
}
.hero-btn-ghost {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.85);
    padding: 0.75rem 1.8rem; border-radius: 8px;
    font-weight: 600; font-size: 0.925rem;
    text-decoration: none;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(255,255,255,0.15);
    letter-spacing: 0.3px;
}
.hero-btn-ghost:hover { 
    background: rgba(255,255,255,0.12); border-color: rgba(255,255,255,0.25); color: #fff; 
}
.hero-stats-row {
    display: flex; gap: 0; margin-top: 2.5rem;
    border-top: 1px solid rgba(255,255,255,0.08);
    padding-top: 1.5rem;
}
.hero-stat {
    flex: 1; padding-right: 1.5rem;
    border-right: 1px solid rgba(255,255,255,0.08);
}
.hero-stat:last-child { border-right: none; padding-right: 0; padding-left: 1.5rem; }
.hero-stat-num { font-size: 1.5rem; font-weight: 800; color: #fff; line-height: 1; }
.hero-stat-label { font-size: 0.72rem; color: rgba(255,255,255,0.4); margin-top: 2px; }
.hero-img-panel {
    position: relative; height: 380px;
    display: flex; align-items: center; justify-content: flex-end;
}
.hero-img-main {
    width: 300px; height: 300px;
    border-radius: 20px;
    object-fit: cover;
    box-shadow: 0 24px 60px rgba(0,0,0,0.4);
}
.hero-img-badge {
    position: absolute; bottom: 30px; left: 10px;
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 12px;
    padding: 10px 14px;
    display: flex; align-items: center; gap: 10px;
}
.hero-discount-pill {
    position: absolute; top: 20px; right: 0;
    background: #e94560; color: #fff;
    border-radius: 8px 0 0 8px;
    padding: 6px 14px;
    font-size: 0.85rem; font-weight: 800;
}

/* ── PROMO STRIP ──────────────────────────────────── */
.promo-strip {
    background: #fff;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}
.promo-strip-inner {
    display: flex; align-items: center; gap: 0;
    overflow-x: auto; scrollbar-width: none;
}
.promo-strip-inner::-webkit-scrollbar { display: none; }
.promo-item {
    flex: 1; min-width: 180px;
    display: flex; align-items: center; gap: 10px;
    padding: 1rem 1.5rem;
    border-right: 1px solid rgba(0,0,0,0.05);
    white-space: nowrap;
}
.promo-item:last-child { border-right: none; }
.promo-icon {
    width: 40px; height: 40px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem; flex-shrink: 0;
}
.promo-text-main { font-size: 0.875rem; font-weight: 700; color: #1a1a2e; }
.promo-text-sub { font-size: 0.75rem; color: #a0aec0; }
html.dark-mode .promo-strip { background: #16151c; border-color: rgba(255,255,255,0.05); }
html.dark-mode .promo-item { border-color: rgba(255,255,255,0.05); }
html.dark-mode .promo-text-main { color: #fff; }

/* ── CATEGORY PILLS ───────────────────────────────── */
.cat-scroll {
    display: flex; gap: 10px;
    overflow-x: auto; scrollbar-width: none;
    padding-bottom: 4px;
}
.cat-scroll::-webkit-scrollbar { display: none; }
.cat-chip {
    display: inline-flex; align-items: center; gap: 8px;
    background: #fff; border: 1px solid rgba(0,0,0,0.07);
    border-radius: 8px; padding: 8px 16px;
    text-decoration: none; white-space: nowrap;
    transition: all 0.2s ease;
    flex-shrink: 0;
}
.cat-chip:hover, .cat-chip.active {
    border-color: #e94560;
    background: rgba(233,69,96,0.04);
}
.cat-chip-emoji { font-size: 1.1rem; }
.cat-chip-name { font-size: 0.85rem; font-weight: 600; color: #1a1a2e; }
.cat-chip-count { font-size: 0.72rem; color: #a0aec0; }
html.dark-mode .cat-chip { background: #16151c; border-color: rgba(255,255,255,0.08); }
html.dark-mode .cat-chip:hover, html.dark-mode .cat-chip.active { border-color: #e94560; background: rgba(233,69,96,0.06); }
html.dark-mode .cat-chip-name { color: #fff; }

/* ── SECTION HEADER ───────────────────────────────── */
.sec-header { margin-bottom: 1.5rem; }
.sec-eyebrow {
    font-size: 0.72rem; font-weight: 700; letter-spacing: 2px;
    text-transform: uppercase; color: #e94560; margin-bottom: 4px;
}
.sec-title {
    font-size: 1.5rem; font-weight: 800; color: #1a1a2e;
    line-height: 1.2; letter-spacing: -0.3px;
}
html.dark-mode .sec-title { color: #fff; }
.sec-link {
    font-size: 0.85rem; font-weight: 600; color: #e94560;
    text-decoration: none;
    display: inline-flex; align-items: center; gap: 4px;
}
.sec-link:hover { text-decoration: underline; }

/* ── PRODUCT CARD ─────────────────────────────────── */
.pcard {
    background: #fff;
    border: 1px solid rgba(0,0,0,0.06);
    border-radius: 12px;
    overflow: hidden;
    transition: box-shadow 0.25s ease, transform 0.25s ease;
    display: flex; flex-direction: column;
    height: 100%;
}
.pcard:hover {
    box-shadow: 0 8px 24px rgba(0,0,0,0.1);
    transform: translateY(-3px);
}
.pcard-img {
    position: relative;
    height: 200px;
    background: #f4f6f9;
    overflow: hidden;
    flex-shrink: 0;
}
.pcard-img img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}
.pcard:hover .pcard-img img { transform: scale(1.04); }
.pcard-badge {
    position: absolute; top: 10px; right: 10px;
    background: #e94560; color: #fff;
    font-size: 0.68rem; font-weight: 700;
    padding: 3px 8px; border-radius: 5px;
    letter-spacing: 0.5px;
}
.pcard-new {
    position: absolute; top: 10px; left: 10px;
    background: #10b981; color: #fff;
    font-size: 0.68rem; font-weight: 700;
    padding: 3px 8px; border-radius: 5px;
}
.pcard-body { padding: 14px; flex: 1; display: flex; flex-direction: column; }
.pcard-cat { font-size: 0.68rem; font-weight: 600; color: #a0aec0; text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 5px; }
.pcard-title { font-size: 0.875rem; font-weight: 600; color: #1a1a2e; line-height: 1.4; margin-bottom: 8px; flex: 1; }
html.dark-mode .pcard-title { color: #fff; }
.pcard-stars { color: #f59e0b; font-size: 0.7rem; letter-spacing: 2px; margin-bottom: 10px; }
.pcard-stars span { color: #a0aec0; font-size: 0.68rem; margin-left: 3px; letter-spacing: 0; }
.pcard-footer {
    display: flex; align-items: center; justify-content: space-between;
    padding-top: 10px; border-top: 1px solid rgba(0,0,0,0.05);
    margin-top: auto;
}
html.dark-mode .pcard-footer { border-color: rgba(255,255,255,0.05); }
.pcard-price { font-size: 1.05rem; font-weight: 800; color: #e94560; }
.pcard-price-old { font-size: 0.75rem; color: #a0aec0; text-decoration: line-through; display: block; }
.pcard-btn {
    display: inline-flex; align-items: center; gap: 6px;
    background: #e94560; color: #fff;
    border: 1px solid #e94560; border-radius: 8px;
    padding: 8px 14px; font-size: 0.82rem; font-weight: 600;
    cursor: pointer; transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none;
    white-space: nowrap;
    letter-spacing: 0.2px;
}
.pcard-btn:hover { 
    background: #d63350; border-color: #d63350; color: #fff; 
    box-shadow: 0 4px 10px rgba(233,69,96,0.2);
}
.pcard-btn-outline {
    display: inline-flex; align-items: center;
    background: transparent; color: #6b7280;
    border: 1px solid rgba(0,0,0,0.08);
    border-radius: 8px; padding: 8px 11px;
    font-size: 0.82rem; cursor: pointer;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none;
}
.pcard-btn-outline:hover { 
    border-color: #e94560; color: #e94560; 
    background-color: rgba(233, 69, 96, 0.04);
}
html.dark-mode .pcard { background: #16151c; border-color: rgba(255,255,255,0.06); }
html.dark-mode .pcard-img { background: #1d1b26; }
html.dark-mode .pcard-btn-outline { border-color: rgba(255,255,255,0.1); color: #a0aec0; }

/* ── FLASH SALE ───────────────────────────────────── */
.sale-strip {
    background: linear-gradient(135deg, #1a1a2e, #0f3460);
    border-radius: 14px; overflow: hidden;
    position: relative;
}
.sale-strip::before {
    content: '';
    position: absolute; inset: 0;
    background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.035) 1px, transparent 0);
    background-size: 20px 20px;
    pointer-events: none;
}
.sale-head { padding: 2rem; position: relative; z-index: 1; border-right: 1px solid rgba(255,255,255,0.06); }
.sale-tag {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(233,69,96,0.2); border: 1px solid rgba(233,69,96,0.35);
    border-radius: 6px; padding: 3px 10px;
    font-size: 0.7rem; font-weight: 700; color: #ff758c;
    letter-spacing: 1px; text-transform: uppercase; margin-bottom: 0.8rem;
}
.sale-title { font-size: 1.4rem; font-weight: 800; color: #fff; margin-bottom: 0.5rem; }
.countdown { display: flex; gap: 8px; }
.cd-box {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 8px; padding: 8px 14px;
    text-align: center; min-width: 56px;
}
.cd-num { font-size: 1.5rem; font-weight: 800; color: #fff; line-height: 1; display: block; }
.cd-label { font-size: 0.6rem; color: rgba(255,255,255,0.4); text-transform: uppercase; letter-spacing: 1px; }
.sale-products { padding: 1.5rem; position: relative; z-index: 1; }
.sale-pcard {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 10px; overflow: hidden;
    transition: all 0.25s ease;
    text-decoration: none;
    display: block;
}
.sale-pcard:hover { border-color: rgba(233,69,96,0.4); background: rgba(255,255,255,0.09); }
.sale-pcard-img { height: 120px; overflow: hidden; position: relative; }
.sale-pcard-img img { width: 100%; height: 100%; object-fit: cover; }
.sale-pcard-body { padding: 10px 12px; }
.sale-pcard-title { font-size: 0.78rem; font-weight: 600; color: rgba(255,255,255,0.8); margin-bottom: 4px; line-height: 1.3; }
.sale-pcard-price { font-size: 0.9rem; font-weight: 800; color: #ff758c; }
.sale-pcard-old { font-size: 0.7rem; color: rgba(255,255,255,0.3); text-decoration: line-through; margin-left: 4px; }

/* ── WHY US ───────────────────────────────────────── */
.fcard {
    background: #fff;
    border: 1px solid rgba(0,0,0,0.05);
    border-radius: 12px; padding: 1.5rem;
    display: flex; gap: 14px; align-items: flex-start;
    transition: all 0.25s ease;
    height: 100%;
}
.fcard:hover { box-shadow: 0 8px 20px rgba(0,0,0,0.06); transform: translateY(-2px); }
.fcard-icon {
    width: 48px; height: 48px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.3rem; flex-shrink: 0;
}
.fcard-title { font-size: 0.925rem; font-weight: 700; color: #1a1a2e; margin-bottom: 3px; }
.fcard-desc { font-size: 0.8rem; color: #6b7280; margin: 0; line-height: 1.5; }
html.dark-mode .fcard { background: #16151c; border-color: rgba(255,255,255,0.05); }
html.dark-mode .fcard-title { color: #fff; }

/* Custom Hero Carousel Controls */
.hero-carousel-nav {
    position: absolute;
    bottom: 30px;
    right: 5%;
    display: flex;
    gap: 12px;
    z-index: 10;
}
.hero-nav-btn {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.15);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(8px);
}
.hero-nav-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.35);
    color: #ffffff;
    transform: translateY(-1px);
}
html.dark-mode .hero-nav-btn {
    background: rgba(0, 0, 0, 0.4);
    border-color: rgba(255, 255, 255, 0.08);
}
html.dark-mode .hero-nav-btn:hover {
    background: rgba(0, 0, 0, 0.65);
    border-color: rgba(255, 255, 255, 0.2);
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}
</style>
@endpush

@section('content')

{{-- ─────────────── HERO SLIDER ─────────────────── --}}
<div class="hero-wrap">
    <div id="heroCarousel" class="carousel slide w-100" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-inner">

            @forelse($sliders as $i => $slider)
            <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                <div class="hero-slider-item">
                    <div class="container-fluid px-4 px-lg-5">
                        <div class="row align-items-center">
                            <div class="col-lg-6 hero-content">
                                <div class="hero-tag">
                                    <span style="width:6px;height:6px;border-radius:50%;background:#e94560;display:inline-block;"></span>
                                    {{ __('New Collection') }}
                                </div>
                                <h1 class="hero-heading">{{ $slider->title }}</h1>
                                @if($slider->subtitle)
                                    <p class="hero-desc">{{ $slider->subtitle }}</p>
                                @endif
                                <div class="d-flex gap-3 flex-wrap">
                                    <a href="{{ $slider->button_link ?? route('shop.index') }}" class="hero-btn-main">
                                        {{ $slider->button_text ?? __('Shop Now') }} <i class="bi bi-arrow-right"></i>
                                    </a>
                                    <a href="{{ route('shop.index') }}" class="hero-btn-ghost">
                                        {{ __('All Products') }}
                                    </a>
                                </div>
                            </div>
                            @if($slider->image)
                            <div class="col-lg-6 d-none d-lg-block">
                                <div class="hero-img-panel">
                                    <img src="{{ Storage::url($slider->image) }}" alt="{{ $slider->title }}" class="hero-img-main">
                                    <div class="hero-discount-pill">{{ __('New Season') }}</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="carousel-item active">
                <div class="hero-slider-item">
                    <div class="container-fluid px-4 px-lg-5">
                        <div class="row align-items-center">
                            <div class="col-lg-7 hero-content">
                                <div class="hero-tag">
                                    <span style="width:6px;height:6px;border-radius:50%;background:#e94560;display:inline-block;"></span>
                                    {{ __('Welcome') }}
                                </div>
                                <h1 class="hero-heading">
                                    {!! __('Premium Shopping<br>Destination') !!} <span>AzuraShop</span>
                                </h1>
                                <p class="hero-desc">{{ __('Discover the latest products with the best prices. Free shipping, secure payment and fast delivery.') }}</p>
                                <div class="d-flex gap-3 flex-wrap">
                                    <a href="{{ route('shop.index') }}" class="hero-btn-main">
                                        {{ __('Start Shopping') }} <i class="bi bi-arrow-right"></i>
                                    </a>
                                    <a href="#featured" class="hero-btn-ghost">{{ __('Featured Products') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        @if($sliders->count() > 1)
        <div class="hero-carousel-nav d-none d-md-flex">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" class="hero-nav-btn">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide="next" class="hero-nav-btn">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
        @endif
    </div>
</div>



{{-- ─────────────── KATEGORİLER ──────────────────── --}}
<div class="container-fluid px-4 px-lg-5 py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <div class="sec-eyebrow">{{ __('Categories') }}</div>
            <h2 class="sec-title mb-0">{{ __('What are you looking for?') }}</h2>
        </div>
        <a href="{{ route('shop.index') }}" class="sec-link">{{ __('See All') }} <i class="bi bi-arrow-right"></i></a>
    </div>
    @php $catIcons = ['📱','💻','👕','🎒','⌚','🎮','📷','🏠','🌿','💄','🎧','🖥️']; @endphp
    <div class="cat-scroll">
        @forelse($categories as $cat)
        <a href="{{ route('shop.index', ['category' => $cat->id]) }}" class="cat-chip">
            <span class="cat-chip-emoji">{{ $catIcons[$loop->index % count($catIcons)] }}</span>
            <div>
                <div class="cat-chip-name">{{ $cat->title }}</div>
                <div class="cat-chip-count">{{ $cat->products->count() }} {{ __('products') }}</div>
            </div>
        </a>
        @empty
        <p class="text-muted small">{{ __('No categories found.') }}</p>
        @endforelse
    </div>
</div>

{{-- ─────────────── ÖNE ÇIKAN ÜRÜNLER ──────────────── --}}
<div class="container-fluid px-4 px-lg-5 py-4" id="featured">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <div class="sec-eyebrow">{{ __('Featured Products') }}</div>
            <h2 class="sec-title mb-0">{{ __('Best Sellers & New Arrivals') }}</h2>
        </div>
        <a href="{{ route('shop.index') }}" class="sec-link">{{ __('See All') }} <i class="bi bi-arrow-right"></i></a>
    </div>

    <div class="row g-3">
        @forelse($featuredProducts as $product)
        <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
            <div class="pcard" style="cursor: pointer;" onclick="showQuickView({{ $product->id }})">
                <div class="pcard-img">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}" loading="lazy">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100" style="font-size:3.5rem;">🛍️</div>
                    @endif
                    @if($product->hasDiscount())
                        <span class="pcard-badge">-{{ $product->discount }}%</span>
                    @endif
                    @if($loop->index < 4)
                        <span class="pcard-new">{{ __('New') }}</span>
                    @endif
                </div>
                <div class="pcard-body">
                    <div class="pcard-cat">{{ $product->category?->title }}</div>
                    <div class="pcard-title">{{ Str::limit($product->title, 52) }}</div>
                    <div class="pcard-stars">★★★★★ <span>({{ rand(12, 98) }})</span></div>
                    <div class="pcard-footer">
                        <div>
                            <span class="pcard-price">${{ number_format($product->getDiscountedPrice(), 2) }}</span>
                            @if($product->hasDiscount())
                                <span class="pcard-price-old">${{ number_format($product->price, 2) }}</span>
                            @endif
                        </div>
                        @if($product->isInStock())
                        <div class="d-flex gap-1" onclick="event.stopPropagation()">
                            <form action="{{ route('cart.add') }}" method="POST" class="m-0">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="pcard-btn">
                                    <i class="bi bi-cart-plus"></i> {{ __('Add') }}
                                </button>
                            </form>
                        </div>
                        @else
                            <span style="font-size:0.72rem; color:#a0aec0; font-weight:600;" onclick="event.stopPropagation()">{{ __('Out of Stock') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-inbox fs-1 d-block mb-2 text-muted"></i>
            <p class="text-muted">{{ __('No products added yet.') }}</p>
        </div>
        @endforelse
    </div>
</div>

{{-- ─────────────── FLASH SALE ───────────────────── --}}
@if($discountedProducts->count() > 0)
<div class="container-fluid px-4 px-lg-5 py-4">
    <div class="sale-strip">
        <div class="row g-0">
            <div class="col-lg-3">
                <div class="sale-head">
                    <div class="sale-tag"><i class="bi bi-lightning-fill"></i> {{ __('Flash Sale') }}</div>
                    <div class="sale-title">{!! __('Discounted Products') !!} 🔥</div>
                    <p style="color:rgba(255,255,255,0.45); font-size:0.85rem; margin-bottom:1.2rem;">{{ __("Limited time — don't miss out!") }}</p>
                    <div class="countdown mb-3">
                        <div class="cd-box"><span class="cd-num" id="cd-h">--</span><span class="cd-label">{{ __('Hours') }}</span></div>
                        <div class="cd-box"><span class="cd-num" id="cd-m">--</span><span class="cd-label">{{ __('Mins') }}</span></div>
                        <div class="cd-box"><span class="cd-num" id="cd-s">--</span><span class="cd-label">{{ __('Secs') }}</span></div>
                    </div>
                    <a href="{{ route('shop.index') }}" class="hero-btn-main" style="font-size:0.85rem; padding:0.6rem 1.4rem;">
                        {{ __('See All') }} <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="sale-products">
                    <div class="row g-3">
                        @foreach($discountedProducts as $prod)
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="{{ route('product.show', $prod) }}" class="sale-pcard">
                                <div class="sale-pcard-img">
                                    @if($prod->image)
                                        <img src="{{ Storage::url($prod->image) }}" alt="{{ $prod->title }}">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center h-100" style="font-size:2.5rem;background:rgba(255,255,255,0.04);">🛍️</div>
                                    @endif
                                    <span style="position:absolute;top:8px;right:8px;background:#e94560;color:#fff;font-size:0.65rem;font-weight:700;padding:3px 8px;border-radius:5px;">-{{ $prod->discount }}%</span>
                                </div>
                                <div class="sale-pcard-body">
                                    <div class="sale-pcard-title">{{ Str::limit($prod->title, 34) }}</div>
                                    <div>
                                        <span class="sale-pcard-price">${{ number_format($prod->getDiscountedPrice(), 2) }}</span>
                                        <span class="sale-pcard-old">${{ number_format($prod->price, 2) }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- ─────────────── NEDEN BİZ ────────────────────── --}}
<div class="container-fluid px-4 px-lg-5 py-4 pb-5">
    <div class="text-center mb-4">
        <div class="sec-eyebrow">{{ __('Our Advantages') }}</div>
        <h2 class="sec-title">{{ __('Why AzuraShop?') }}</h2>
    </div>
    <div class="row g-3">
        @php
        $features = [
            ['🚚','bg-danger-subtle', __('Free Shipping'), __('Free on all orders over $100')],
            ['🔒','bg-success-subtle', __('Secure Payment'), __('256-bit SSL protected transactions')],
            ['🔄','bg-warning-subtle', __('Easy Returns'), __('Free returns within 30 days')],
            ['📞','bg-primary-subtle', __('24/7 Support'), __('We are always here for you')],
        ];
        @endphp
        @foreach($features as [$icon, $bg, $title, $desc])
        <div class="col-6 col-md-3">
            <div class="fcard">
                <div class="fcard-icon {{ $bg }}">{{ $icon }}</div>
                <div>
                    <div class="fcard-title">{{ $title }}</div>
                    <p class="fcard-desc">{{ $desc }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Countdown
    const elH = document.getElementById('cd-h');
    const elM = document.getElementById('cd-m');
    const elS = document.getElementById('cd-s');
    if (!elH || !elM || !elS) return;

    const end = new Date().getTime() + 8*3600000;
    function tick() {
        const d = end - new Date().getTime();
        if (d <= 0) return;
        elH.textContent = String(Math.floor(d/3600000)).padStart(2,'0');
        elM.textContent = String(Math.floor(d%3600000/60000)).padStart(2,'0');
        elS.textContent = String(Math.floor(d%60000/1000)).padStart(2,'0');
    }
    tick(); setInterval(tick, 1000);
});
</script>
@endpush
