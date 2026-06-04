@extends('layouts.home')
@section('title', __('Proceed to Checkout'))

@section('content')

<div class="py-4 mb-4 premium-banner">
    <div class="container-fluid px-4">
        <h1 class="text-white fw-bold mb-1">{{ __('Proceed to Checkout') }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}" class="text-muted text-decoration-none">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cart') }}" class="text-muted text-decoration-none">{{ __('Cart') }}</a></li>
                <li class="breadcrumb-item text-white active">{{ __('Proceed to Checkout') }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-fluid px-4 pb-5">
    <div class="row g-4">

        {{-- ── Checkout Form ───────────────────────────────────── --}}
        <div class="col-lg-7">
            <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm">
                @csrf

                @guest
                <div class="alert alert-light border shadow-sm mb-4 d-flex align-items-center justify-content-between p-3" style="border-radius:16px; border-color: rgba(0,0,0,0.05)!important; background-color: #ffffff;">
                    <div class="d-flex align-items-center gap-3">
                        <span class="fs-4">🔑</span>
                        <div>
                            <span class="fw-semibold d-block text-dark">{{ __('Already have an account?') }}</span>
                            <small class="text-muted">Giriş yaparak bilgilerinizi otomatik doldurabilirsiniz.</small>
                        </div>
                    </div>
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary px-3" style="border-radius:20px; border-color:#e94560; color:#e94560;">
                        {{ __('Login') }}
                    </a>
                </div>
                @endguest

                {{-- Billing Info --}}
                <div class="card border-0 shadow-sm mb-4" style="border-radius:16px;">
                    <div class="card-header bg-transparent border-0 pt-3">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-person me-2" style="color:#e94560;"></i>{{ __('Delivery Information') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-medium">{{ __('Full Name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       style="border-radius:10px;"
                                       value="{{ old('name', $user?->name) }}" required placeholder="John Doe">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium">{{ __('Email') }} <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       style="border-radius:10px;"
                                       value="{{ old('email', $user?->email) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium">{{ __('Phone') }} <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                       style="border-radius:10px;"
                                       value="{{ old('phone', $user?->phone) }}" required placeholder="+90 555 000 0000">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium">{{ __('City') }} <span class="text-danger">*</span></label>
                                <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                                       style="border-radius:10px;"
                                       value="{{ old('city') }}" required placeholder="Istanbul">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-medium">{{ __('Address') }} <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror"
                                          style="border-radius:10px;" rows="3" required
                                          placeholder="Street, District, Apartment..."></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-medium">{{ __('Order Note') }}</label>
                                <textarea name="note" class="form-control" style="border-radius:10px;" rows="2"
                                          placeholder="Any special notes about your delivery..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Payment Info (UI only) --}}
                <div class="card border-0 shadow-sm mb-4" style="border-radius:16px;">
                    <div class="card-header bg-transparent border-0 pt-3">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-credit-card me-2" style="color:#e94560;"></i>{{ __('Payment Method') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="p-3 border rounded-3 d-flex align-items-center gap-3"
                             style="border-color:#e94560!important;background:rgba(233,69,96,.05);cursor:pointer;">
                            <input type="radio" checked class="form-check-input mt-0" style="accent-color:#e94560;">
                            <div>
                                <div class="fw-semibold">{{ __('Cash on Delivery') }}</div>
                                <div class="text-muted small">{{ __('Pay with cash or credit card upon delivery.') }}</div>
                            </div>
                            <span style="font-size:1.5rem;margin-left:auto;">💵</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-lg w-100 text-white fw-bold py-3"
                        style="background:#e94560;border:none;border-radius:14px;">
                    <i class="bi bi-check-circle me-2"></i>{{ __('Complete Order') }}
                </button>
            </form>
        </div>

        {{-- ── Order Summary ───────────────────────────────────── --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm" style="border-radius:16px;position:sticky;top:80px;">
                <div class="card-header bg-transparent border-0 pt-3">
                    <h5 class="mb-0 fw-bold">{{ __('Order Summary') }}</h5>
                </div>
                <div class="card-body p-0">
                    {{-- Items --}}
                    @foreach($cart as $item)
                    <div class="d-flex align-items-center gap-3 px-3 py-2 border-bottom">
                        @if($item['image'])
                            <img src="{{ Storage::url($item['image']) }}" alt=""
                                 style="width:56px;height:56px;object-fit:cover;border-radius:10px;flex-shrink:0;">
                        @else
                            <div style="width:56px;height:56px;border-radius:10px;background:#f8f9fa;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">🛍️</div>
                        @endif
                        <div class="flex-grow-1">
                            <div class="fw-semibold small">{{ Str::limit($item['title'], 35) }}</div>
                            <div class="text-muted" style="font-size:.75rem;">{{ $item['quantity'] }} {{ __('pcs') }}</div>
                        </div>
                        <div class="fw-bold small" style="color:#e94560;">
                            ${{ number_format($item['price'] * $item['quantity'], 2) }}
                        </div>
                    </div>
                    @endforeach

                    {{-- Coupon Panel --}}
                    <div class="p-3 border-bottom bg-light-subtle">
                        <label class="form-label fw-semibold small mb-2"><i class="bi bi-tag-fill me-1 text-primary"></i>{{ __('Apply Coupon') }}</label>
                        <div class="input-group">
                            <input type="text" id="couponCodeInput" class="form-control form-control-sm text-uppercase" 
                                   placeholder="{{ __('Enter Coupon Code') }}" value="{{ $couponCode }}" 
                                   style="border-radius:10px 0 0 10px; font-weight: 600;">
                            <button class="btn btn-sm btn-outline-primary" type="button" id="applyCouponBtn" 
                                    style="border-radius:0 10px 10px 0; border-color:#e94560; color:#e94560; font-weight: 500;">
                                {{ __('Apply') }}
                            </button>
                        </div>
                        <div id="couponMessage" class="mt-2 small fw-medium" style="display:none;"></div>
                    </div>

                    {{-- Totals --}}
                    <div class="p-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">{{ __('Subtotal') }}</span>
                            <span id="subtotalVal">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 text-danger" id="discountRow" style="display: {{ $discount > 0 ? 'flex' : 'none' }} !important;">
                            <span>
                                {{ __('Discount') }}
                                <span id="appliedCouponBadge" class="badge bg-danger-subtle text-danger ms-1" style="font-size:0.7rem; border: 1px solid rgba(220,53,69,0.15);">{{ $couponCode }}</span>
                            </span>
                            <span id="discountVal">-${{ number_format($discount, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">{{ __('Shipping') }}</span>
                            <span id="shippingVal">
                                @if($shipping == 0)
                                    <span class="text-success fw-semibold">{{ __('Free') }}</span>
                                @else
                                    <span>${{ number_format($shipping, 2) }}</span>
                                @endif
                            </span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold fs-5 text-dark">{{ __('Total') }}</span>
                            <span class="fw-bold fs-5 text-primary" id="totalVal">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-0 text-center pb-3">
                    <small class="text-muted">
                        <i class="bi bi-shield-lock me-1"></i>{{ __('Your order will be processed securely.') }}
                    </small>
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const applyBtn = document.getElementById('applyCouponBtn');
        const codeInput = document.getElementById('couponCodeInput');
        const messageEl = document.getElementById('couponMessage');
        const discountRow = document.getElementById('discountRow');
        const badgeEl = document.getElementById('appliedCouponBadge');
        const discountVal = document.getElementById('discountVal');
        const totalVal = document.getElementById('totalVal');

        if (applyBtn) {
            applyBtn.addEventListener('click', function() {
                const code = codeInput.value.trim();
                if (!code) {
                    messageEl.className = 'mt-2 small text-danger fw-medium';
                    messageEl.innerText = 'Lütfen bir kupon kodu girin.';
                    messageEl.style.display = 'block';
                    return;
                }

                applyBtn.disabled = true;
                applyBtn.innerText = '{{ __("Applying...") }}';
                messageEl.style.display = 'none';

                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('{{ route("checkout.applyCoupon") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ code: code })
                })
                .then(res => res.json())
                .then(data => {
                    applyBtn.disabled = false;
                    applyBtn.innerText = '{{ __("Apply") }}';

                    if (data.success) {
                        messageEl.className = 'mt-2 small text-success fw-medium';
                        messageEl.innerText = data.message;
                        messageEl.style.display = 'block';

                        // Show discount row
                        discountRow.style.setProperty('display', 'flex', 'important');
                        badgeEl.innerText = data.code;
                        discountVal.innerText = '-$' + parseFloat(data.discount).toFixed(2);
                        totalVal.innerText = '$' + parseFloat(data.total).toFixed(2);

                        showToast('success', data.message);
                    } else {
                        messageEl.className = 'mt-2 small text-danger fw-medium';
                        messageEl.innerText = data.message;
                        messageEl.style.display = 'block';

                        // Hide discount row
                        discountRow.style.setProperty('display', 'none', 'important');
                        
                        showToast('error', data.message);
                        
                        // Force reload to sync session/database checkout states correctly
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }
                })
                .catch(err => {
                    applyBtn.disabled = false;
                    applyBtn.innerText = '{{ __("Apply") }}';
                    showToast('error', 'Bir hata oluştu.');
                });
            });
        }
    });
</script>
@endpush
@endsection
