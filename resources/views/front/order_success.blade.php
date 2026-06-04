@extends('layouts.home')
@section('title', __('Order Received!'))

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            {{-- Success Banner --}}
            <div class="text-center mb-5">
                <div class="mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                         style="width:100px;height:100px;background:linear-gradient(135deg,#28a745,#20c997);">
                        <i class="bi bi-check-lg text-white" style="font-size:3rem;"></i>
                    </div>
                </div>
                <h1 class="fw-bold mb-2" style="color:#1a1a2e;">{{ __('Order Received!') }}</h1>
                <p class="text-muted fs-5">
                    {{ __('Your order number:') }} <strong style="color:#e94560;">#{{ $order->id }}</strong>
                </p>
                <p class="text-muted">
                    {{ __('order confirmation details have been sent to.') }} <strong>{{ $order->email }}</strong>
                </p>
            </div>

            {{-- Order Details --}}
            <div class="card border-0 shadow-sm mb-4" style="border-radius:16px;">
                <div class="card-header bg-transparent border-0 pt-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-receipt me-2" style="color:#e94560;"></i>{{ __('Order Details') }}</h5>
                </div>
                <div class="card-body p-0">
                    @foreach($order->items as $item)
                    <div class="d-flex align-items-center gap-3 px-3 py-2 border-bottom">
                        @if($item->product?->image)
                            <img src="{{ Storage::url($item->product->image) }}" alt=""
                                 style="width:56px;height:56px;object-fit:cover;border-radius:10px;flex-shrink:0;">
                        @else
                            <div style="width:56px;height:56px;border-radius:10px;background:#f8f9fa;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">🛍️</div>
                        @endif
                        <div class="flex-grow-1">
                            <div class="fw-semibold small">{{ $item->product_title }}</div>
                            <div class="text-muted" style="font-size:.75rem;">{{ $item->quantity }} {{ __('pcs') }} × ${{ number_format($item->price, 2) }}</div>
                        </div>
                        <div class="fw-bold small" style="color:#e94560;">
                            ${{ number_format($item->total, 2) }}
                        </div>
                    </div>
                    @endforeach

                    <div class="p-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted small">{{ __('Subtotal') }}</span>
                            <span class="small">${{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">{{ __('Shipping') }}</span>
                            <span class="small">{{ $order->shipping > 0 ? '$' . number_format($order->shipping, 2) : __('Free') }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">{{ __('Grand Total') }}</span>
                            <span class="fw-bold fs-5" style="color:#e94560;">${{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Shipping Info --}}
            <div class="card border-0 shadow-sm mb-5" style="border-radius:16px;">
                <div class="card-header bg-transparent border-0 pt-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-truck me-2" style="color:#e94560;"></i>{{ __('Delivery Information') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="text-muted small">{{ __('Full Name') }}</div>
                            <div class="fw-semibold">{{ $order->name }}</div>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small">{{ __('Phone') }}</div>
                            <div class="fw-semibold">{{ $order->phone }}</div>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small">{{ __('City') }}</div>
                            <div class="fw-semibold">{{ $order->city }}</div>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small">{{ __('Status') }}</div>
                            <span class="badge bg-warning text-dark">{{ __('Pending') }}</span>
                        </div>
                        <div class="col-12">
                            <div class="text-muted small">{{ __('Address') }}</div>
                            <div class="fw-semibold">{{ $order->address }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                <a href="{{ route('front.home') }}" class="btn btn-lg px-5 text-white"
                   style="background:#e94560;border:none;border-radius:30px;">
                    <i class="bi bi-house me-2"></i>{{ __('Return to Home') }}
                </a>
                <a href="{{ route('shop.index') }}" class="btn btn-lg btn-outline-secondary px-5"
                   style="border-radius:30px;">
                    <i class="bi bi-bag me-2"></i>{{ __('Continue Shopping') }}
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
