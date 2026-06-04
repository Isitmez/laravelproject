@extends('layouts.home')
@section('title', __('Cart'))

@push('styles')
<style>
    /* ── Cart Item ────────────────────────────────── */
    .cart-item-row {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.2rem 1.4rem;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        transition: background 0.2s ease;
    }
    .cart-item-row:last-child { border-bottom: none; }
    .cart-item-row:hover { background: rgba(233,69,96,0.02); }
    html.dark-mode .cart-item-row { border-color: rgba(255,255,255,0.05); }
    html.dark-mode .cart-item-row:hover { background: rgba(255,255,255,0.02); }
    .cart-item-img {
        width: 80px; height: 80px;
        border-radius: 14px;
        object-fit: cover;
        flex-shrink: 0;
        border: 1px solid rgba(0,0,0,0.05);
    }
    .cart-item-img-placeholder {
        width: 80px; height: 80px;
        border-radius: 14px;
        background: #f4f6f9;
        display: flex; align-items: center; justify-content: center;
        font-size: 2rem; flex-shrink: 0;
    }
    html.dark-mode .cart-item-img-placeholder { background: #1d1b26; }
    .cart-qty-group {
        display: flex;
        align-items: center;
        background: #f4f6f9;
        border-radius: 10px;
        overflow: hidden;
        width: fit-content;
    }
    html.dark-mode .cart-qty-group { background: #1d1b26; }
    .cart-qty-btn {
        width: 32px; height: 32px;
        border: none;
        background: transparent;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem; color: #4a5568;
        transition: all 0.2s ease;
        padding: 0;
    }
    .cart-qty-btn:hover { background: rgba(233,69,96,0.1); color: #e94560; }
    html.dark-mode .cart-qty-btn { color: #a0aec0; }
    .cart-qty-input {
        width: 40px; height: 32px;
        border: none; background: transparent;
        text-align: center; font-weight: 700;
        font-size: 0.875rem; color: #1a1a2e;
        padding: 0;
    }
    html.dark-mode .cart-qty-input { color: #fff; }
    .cart-qty-input:focus { outline: none; }
    .btn-cart-remove {
        width: 34px; height: 34px;
        border-radius: 10px;
        border: 1px solid rgba(220,53,69,0.2);
        background: rgba(220,53,69,0.05);
        color: #dc3545;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: all 0.2s ease;
        flex-shrink: 0;
    }
    .btn-cart-remove:hover {
        background: #dc3545; color: #fff;
        border-color: #dc3545;
    }

    /* ── Summary Card ─────────────────────────────── */
    .summary-card {
        background: #ffffff;
        border: 1px solid rgba(0,0,0,0.05);
        border-radius: 20px;
        overflow: hidden;
        position: sticky;
        top: 80px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.05);
    }
    html.dark-mode .summary-card {
        background: #16151c;
        border-color: rgba(255,255,255,0.06);
    }
    .summary-header {
        background: linear-gradient(135deg, #1a1a2e, #0f3460);
        padding: 1.1rem 1.4rem;
    }
    .summary-row {
        display: flex; justify-content: space-between; align-items: center;
        padding: 0.6rem 0;
        font-size: 0.9rem;
        border-bottom: 1px solid rgba(0,0,0,0.04);
    }
    html.dark-mode .summary-row { border-color: rgba(255,255,255,0.05); }
    .summary-row:last-child { border-bottom: none; }
    .summary-label { color: #6b7280; }
    html.dark-mode .summary-label { color: #a0aec0; }
    .summary-total-row {
        display: flex; justify-content: space-between; align-items: center;
        padding: 1rem 0 0;
        margin-top: 0.5rem;
        border-top: 2px solid rgba(233,69,96,0.15);
    }
    .btn-checkout {
        background: linear-gradient(135deg, #e94560, #ff758c) !important;
        border: none !important; border-radius: 14px !important;
        color: #ffffff !important; font-weight: 700 !important;
        font-size: 1rem !important; padding: 0.85rem 1rem !important;
        width: 100%; transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(233,69,96,0.3);
        letter-spacing: 0.3px;
    }
    .btn-checkout:hover {
        box-shadow: 0 10px 28px rgba(233,69,96,0.45);
        transform: translateY(-2px);
    }
    .free-shipping-bar {
        background: #f4f6f9;
        border-radius: 10px;
        overflow: hidden;
        height: 6px;
        margin-bottom: 0.4rem;
    }
    html.dark-mode .free-shipping-bar { background: #1d1b26; }
    .free-shipping-progress {
        height: 100%;
        background: linear-gradient(90deg, #e94560, #ff758c);
        border-radius: 10px;
        transition: width 0.5s ease;
    }

    /* ── Empty Cart ────────────────────────────────── */
    .empty-cart-wrap {
        text-align: center;
        padding: 5rem 2rem;
    }
    .empty-cart-icon {
        width: 120px; height: 120px;
        border-radius: 30px;
        background: linear-gradient(135deg, rgba(233,69,96,0.08), rgba(255,117,140,0.04));
        display: flex; align-items: center; justify-content: center;
        font-size: 3.5rem;
        margin: 0 auto 1.5rem;
        border: 1px solid rgba(233,69,96,0.1);
    }
</style>
@endpush

@section('content')

<div class="py-4 mb-4 premium-banner">
    <div class="container-fluid px-4 px-lg-5">
        <h1 class="text-white fw-bold mb-1" style="font-size:1.7rem; letter-spacing:-0.3px;">
            <i class="bi bi-cart3 me-2"></i>{{ __('Cart') }}
        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size:0.8rem;">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}" class="text-white-50 text-decoration-none">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item text-white active">{{ __('Cart') }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-fluid px-4 px-lg-5 pb-5">

    @if(empty($cart))
    {{-- ── Empty State ──────────────────────────── --}}
    <div class="empty-cart-wrap">
        <div class="empty-cart-icon">🛒</div>
        <h3 class="fw-bold mb-2">{{ __('Your Cart is Empty') }}</h3>
        <p class="text-muted mb-4">{{ __("You haven't added any products yet.") }}</p>
        <a href="{{ route('shop.index') }}"
           style="background: linear-gradient(135deg,#e94560,#ff758c); border: none; border-radius: 50px; color:#fff; font-weight:700; padding: 0.8rem 2.5rem; font-size:1rem; display:inline-flex; align-items:center; gap:8px; text-decoration:none; box-shadow: 0 8px 24px rgba(233,69,96,0.3); transition: all 0.3s ease;">
            <i class="bi bi-bag"></i> {{ __('Start Shopping') }}
        </a>
    </div>

    @else
    <div class="row g-4">

        {{-- ── Cart Items ────────────────────────────────────── --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm" style="border-radius:20px; overflow:hidden;">
                {{-- Header --}}
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-3 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0 fw-bold" style="font-size:1.05rem;">
                            <i class="bi bi-bag-check me-2" style="color:#e94560;"></i>
                            {{ __('Products') }} <span class="badge ms-1" style="background:rgba(233,69,96,0.1); color:#e94560; font-size:0.75rem; border-radius:20px;">{{ count($cart) }}</span>
                        </h5>
                    </div>
                    <form action="{{ route('cart.clear') }}" method="POST"
                          onsubmit="return confirm('{{ __('Are you sure you want to completely clear the cart?') }}')">
                        @csrf
                        <button type="submit" class="btn btn-sm" style="border-radius:20px; border: 1px solid rgba(220,53,69,0.25); color:#dc3545; background:rgba(220,53,69,0.05); font-size:0.8rem; padding:5px 14px;">
                            <i class="bi bi-trash3 me-1"></i>{{ __('Clear') }}
                        </button>
                    </form>
                </div>

                {{-- Items --}}
                @foreach($cart as $key => $item)
                <div class="cart-item-row">
                    {{-- Image --}}
                    @if($item['image'])
                        <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['title'] }}" class="cart-item-img">
                    @else
                        <div class="cart-item-img-placeholder">🛍️</div>
                    @endif

                    {{-- Info --}}
                    <div class="flex-grow-1" style="min-width:0;">
                        <h6 class="fw-semibold mb-1 text-truncate" style="font-size:0.9rem;">{{ $item['title'] }}</h6>
                        <div class="mb-2" style="font-size:0.8rem; color:#a0aec0;">
                            {{ __('Unit Price:') }}
                            <strong style="color:#e94560;">${{ number_format($item['price'], 2) }}</strong>
                        </div>
                        {{-- Qty --}}
                        <form action="{{ route('cart.update') }}" method="POST" class="d-flex align-items-center gap-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $key }}">
                            <div class="cart-qty-group">
                                <button type="button" class="cart-qty-btn"
                                        onclick="this.nextElementSibling.stepDown(); this.form.submit()">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                       min="1" max="{{ $item['stock'] }}" class="cart-qty-input"
                                       onchange="this.form.submit()">
                                <button type="button" class="cart-qty-btn"
                                        onclick="this.previousElementSibling.stepUp(); this.form.submit()">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Price & Remove --}}
                    <div class="d-flex flex-column align-items-end gap-2" style="flex-shrink:0;">
                        <div class="fw-bold" style="color:#1a1a2e; font-size:1rem;">
                            ${{ number_format($item['price'] * $item['quantity'], 2) }}
                        </div>
                        <form action="{{ route('cart.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $key }}">
                            <button type="submit" class="btn-cart-remove">
                                <i class="bi bi-trash3" style="font-size:0.8rem;"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
                <a href="{{ route('shop.index') }}" class="btn btn-sm" style="border-radius:20px; border:1px solid rgba(0,0,0,0.1); color:#6b7280; font-size:0.875rem; padding:8px 18px;">
                    <i class="bi bi-arrow-left me-1"></i>{{ __('Continue Shopping') }}
                </a>
            </div>
        </div>

        {{-- ── Order Summary ─────────────────────────────────── --}}
        <div class="col-lg-4">
            <div class="summary-card">
                <div class="summary-header">
                    <h6 class="text-white fw-bold mb-0" style="font-size:0.95rem;">
                        <i class="bi bi-receipt me-2"></i>{{ __('Order Summary') }}
                    </h6>
                </div>
                <div style="padding: 1.4rem;">
                    @php
                        $shippingFee = (float) \App\Models\Setting::get('shipping_fee', 9.99);
                        $freeAt      = (float) \App\Models\Setting::get('free_shipping_at', 100);
                        $shipping    = $total >= $freeAt ? 0 : $shippingFee;
                        $grandTotal  = $total + $shipping;
                        $progressPct = min(100, ($total / $freeAt) * 100);
                    @endphp

                    {{-- Free shipping progress --}}
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1" style="font-size:0.78rem;">
                            @if($shipping > 0)
                                <span class="text-muted">Ücretsiz kargo için</span>
                                <span style="color:#e94560; font-weight:700;">${{ number_format($freeAt - $total, 2) }} kaldı</span>
                            @else
                                <span class="text-success fw-semibold"><i class="bi bi-check-circle-fill me-1"></i>{{ __('You got free shipping!') }}</span>
                            @endif
                        </div>
                        <div class="free-shipping-bar">
                            <div class="free-shipping-progress" style="width:{{ $progressPct }}%;"></div>
                        </div>
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">{{ __('Subtotal') }}</span>
                        <span class="fw-semibold">${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-label">{{ __('Shipping') }}</span>
                        @if($shipping == 0)
                            <span class="fw-semibold text-success">{{ __('Free') }}</span>
                        @else
                            <span class="fw-semibold">${{ number_format($shipping, 2) }}</span>
                        @endif
                    </div>

                    <div class="summary-total-row">
                        <span class="fw-bold" style="font-size:1.1rem;">{{ __('Total') }}</span>
                        <span class="fw-bold" style="font-size:1.3rem; color:#e94560;">${{ number_format($grandTotal, 2) }}</span>
                    </div>

                    <a href="{{ route('checkout') }}" class="btn btn-checkout mt-4 d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-credit-card"></i> {{ __('Proceed to Checkout') }}
                    </a>

                    <div class="text-center mt-3" style="font-size:0.75rem; color:#a0aec0;">
                        <i class="bi bi-shield-lock me-1 text-success"></i>{{ __('Secure checkout') }} • SSL Encrypted
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endif

</div>
@endsection
