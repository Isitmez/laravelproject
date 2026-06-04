@extends('layouts.home')
@section('title', $product->title)
@section('meta_description', $product->description)

@section('content')

{{-- ── Breadcrumb ─────────────────────────────────────────────── --}}
<div class="py-3 mb-4 bg-light border-bottom">
    <div class="container-fluid px-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}" class="text-decoration-none">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('shop.index') }}" class="text-decoration-none">{{ __('Products') }}</a></li>
                @if($product->category)
                    <li class="breadcrumb-item">
                        <a href="{{ route('shop.index', ['category' => $product->category_id]) }}" class="text-decoration-none">
                            {{ __($product->category->title) }}
                        </a>
                    </li>
                @endif
                <li class="breadcrumb-item active text-truncate" style="max-width:200px;">{{ $product->title }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-fluid px-4 pb-5">

    {{-- ── Product Detail ──────────────────────────────────────── --}}
    <div class="row g-5 mb-5">

        {{-- Image --}}
        <div class="col-md-5">
            <div class="card border-0 shadow-sm" style="border-radius:20px;overflow:hidden;">
                @if($product->image)
                    <div class="zoom-image-wrapper" style="position:relative; overflow:hidden; cursor:zoom-in;">
                        <img id="zoomProductImage" src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}"
                             style="width:100%;max-height:420px;object-fit:cover;transition: transform 0.1s ease-out; transform-origin: center center;">
                    </div>
                @else
                    <div class="d-flex align-items-center justify-content-center bg-light"
                         style="height:420px;font-size:8rem;">🛍️</div>
                @endif
            </div>
        </div>

        {{-- Info --}}
        <div class="col-md-7">
            {{-- Category & Status --}}
            <div class="d-flex align-items-center gap-2 mb-2">
                @if($product->category)
                    <span class="badge bg-light text-primary border border-primary" style="font-size:.75rem;">
                        {{ __($product->category->title) }}
                    </span>
                @endif
                @if($product->isInStock())
                    <span class="badge bg-success" style="font-size:.75rem;">
                        <i class="bi bi-check-circle me-1"></i>{{ __('In Stock') }}
                    </span>
                @endif
            </div>

            {{-- Title --}}
            <h1 class="fw-bold mb-3" style="font-size:1.6rem;color:#1a1a2e;">{{ $product->title }}</h1>

            {{-- Description --}}
            @if($product->description)
                <p class="text-muted mb-4">{{ $product->description }}</p>
            @endif

            {{-- Price --}}
            <div class="mb-4 p-3 rounded-3 bg-light">
                <div class="d-flex align-items-center gap-3">
                    <span class="fw-bold" style="font-size:2rem;color:#e94560;">
                        ${{ number_format($product->getDiscountedPrice(), 2) }}
                    </span>
                    @if($product->hasDiscount())
                        <div>
                            <del class="text-muted fs-5">${{ number_format($product->price, 2) }}</del>
                            <span class="ms-2 badge bg-danger fs-6">%{{ $product->discount }} {{ __('Discount') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Stock Info --}}
            <div class="mb-4">
                <span class="text-muted small">
                    <i class="bi bi-boxes me-1"></i>
                    {{ __('Stock:') }} <strong>{{ $product->stock }}</strong> {{ __('pcs') }}
                </span>
            </div>

            {{-- Add to Cart --}}
            @if($product->isInStock())
            <form action="{{ route('cart.add') }}" method="POST" class="mb-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="d-flex align-items-center gap-3">
                    <div class="input-group" style="width:130px;">
                        <button type="button" class="btn btn-outline-secondary"
                                onclick="changeQty(-1)" style="border-radius:10px 0 0 10px;">
                            <i class="bi bi-dash"></i>
                        </button>
                        <input type="number" name="quantity" id="qty" class="form-control text-center border-secondary"
                               value="1" min="1" max="{{ $product->stock }}" style="font-weight:600;">
                        <button type="button" class="btn btn-outline-secondary"
                                onclick="changeQty(1)" style="border-radius:0 10px 10px 0;">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                    <button type="submit" class="btn btn-lg text-white fw-semibold px-4"
                            style="background:#e94560;border:none;border-radius:12px;">
                        <i class="bi bi-cart-plus me-2"></i>{{ __('Add to Cart') }}
                    </button>
                </div>
            </form>
            @else
            <div class="alert alert-warning" style="border-radius:12px;">
                <i class="bi bi-exclamation-triangle me-2"></i>{{ __('This product is currently out of stock.') }}
            </div>
            @endif

            {{-- Details Grid --}}
            <div class="row g-3 mt-2">
                <div class="col-6 col-md-4">
                    <div class="text-center p-3 bg-light rounded-3">
                        <i class="bi bi-truck fs-4 d-block mb-1" style="color:#e94560;"></i>
                        <div class="small fw-semibold">{{ __('Fast Shipping') }}</div>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="text-center p-3 bg-light rounded-3">
                        <i class="bi bi-shield-check fs-4 d-block mb-1" style="color:#e94560;"></i>
                        <div class="small fw-semibold">{{ __('Secure Payment') }}</div>
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="text-center p-3 bg-light rounded-3">
                        <i class="bi bi-arrow-repeat fs-4 d-block mb-1" style="color:#e94560;"></i>
                        <div class="small fw-semibold">{{ __('30 Days Return') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Product Detail Tab ──────────────────────────────────── --}}
    @if($product->detail)
    <div class="card border-0 shadow-sm mb-5" style="border-radius:16px;">
        <div class="card-header bg-transparent border-0 pt-3">
            <h5 class="fw-bold mb-0"><i class="bi bi-info-circle me-2" style="color:#e94560;"></i>{{ __('Product Details') }}</h5>
        </div>
        <div class="card-body">
            <p class="text-muted mb-0" style="line-height:1.8;">{{ $product->detail }}</p>
        </div>
    </div>
    @endif

    {{-- ── Related Products ────────────────────────────────────── --}}
    @if($relatedProducts->count() > 0)
    <div class="mb-5">
        <h4 class="fw-bold mb-4">{{ __('Related Products') }}</h4>
        <div class="row g-4">
            @foreach($relatedProducts as $related)
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm product-card" style="border-radius:16px;overflow:hidden;">
                    <div class="product-image-container" style="height:160px;overflow:hidden;background:#f8f9fa;">
                        @if($related->image)
                            <img src="{{ Storage::url($related->image) }}" alt="{{ $related->title }}"
                                 style="width:100%;height:100%;object-fit:cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100"
                                 style="font-size:3rem;">🛍️</div>
                        @endif
                        @if($related->hasDiscount())
                            <span class="position-absolute top-0 end-0 m-2 discount-badge" style="z-index: 3;">-%{{ $related->discount }}</span>
                        @endif
                        <div class="product-overlay">
                            <button type="button" class="btn btn-light btn-sm fw-semibold shadow-sm text-uppercase" 
                                    onclick="showQuickView({{ $related->id }})" style="border-radius:20px; font-size:0.75rem; padding:6px 14px; color:#e94560;">
                                <i class="bi bi-eye-fill me-1"></i>{{ __('Quick View') }}
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="fw-semibold small mb-1">{{ Str::limit($related->title, 40) }}</div>
                        <div class="fw-bold mb-2" style="color:#e94560;">
                            ${{ number_format($related->getDiscountedPrice(), 2) }}
                        </div>
                        <a href="{{ route('product.show', $related) }}"
                           class="btn btn-sm btn-outline-danger w-100" style="border-radius:8px;font-size:.8rem;">
                            {{ __('View') }}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection

@push('scripts')
<script>
function changeQty(delta) {
    const input = document.getElementById('qty');
    if (input) {
        const max = parseInt(input.max) || 999;
        const newVal = parseInt(input.value) + delta;
        if (newVal >= 1 && newVal <= max) input.value = newVal;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.querySelector('.zoom-image-wrapper');
    const img = document.getElementById('zoomProductImage');
    
    if (wrapper && img) {
        wrapper.addEventListener('mousemove', (e) => {
            const rect = wrapper.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            const y = ((e.clientY - rect.top) / rect.height) * 100;
            
            img.style.transformOrigin = `${x}% ${y}%`;
            img.style.transform = 'scale(2.2)';
        });
        
        wrapper.addEventListener('mouseleave', () => {
            img.style.transform = 'scale(1)';
            img.style.transformOrigin = 'center center';
        });
    }
});
</script>
@endpush
