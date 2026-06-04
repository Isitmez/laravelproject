@extends('layouts.home')
@section('title', __('My Profile'))

@section('content')
<div class="py-4 mb-4 premium-banner">
    <div class="container-fluid px-4">
        <h1 class="text-white fw-bold mb-1">{{ __('My Profile') }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('front.home') }}" class="text-muted text-decoration-none">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item text-white active">{{ __('My Profile') }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container-fluid px-4 pb-5">
    <div class="row g-4">
        {{-- Profile Sidebar --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm text-center p-4 mb-4" style="border-radius:16px;">
                <div class="card-body">
                    {{-- Initials Avatar --}}
                    @php
                        $words = explode(' ', $user->name);
                        $initials = '';
                        foreach ($words as $w) {
                            $initials .= mb_substr($w, 0, 1);
                        }
                        $initials = mb_strtoupper(mb_substr($initials, 0, 2));
                    @endphp
                    <div class="d-inline-flex align-items-center justify-content-center text-white font-weight-bold rounded-circle mb-3 shadow-sm"
                         style="width: 90px; height: 90px; font-size: 2.2rem; background: linear-gradient(135deg, #e94560 0%, #ff758c 100%);">
                        {{ $initials }}
                    </div>
                    
                    <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
                    <p class="text-muted small mb-3"><i class="bi bi-envelope me-1"></i>{{ $user->email }}</p>
                    
                    <span class="badge bg-light text-primary border px-3 py-2 mb-3" style="border-radius: 20px;">
                        @if($user->isAdmin())
                            <i class="bi bi-shield-fill me-1 text-danger"></i>{{ __('Admin') }}
                        @else
                            <i class="bi bi-person me-1"></i>{{ __('Customer') }}
                        @endif
                    </span>
                    
                    <hr class="my-4">
                    
                    <div class="text-start">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">{{ __('Member Since') }}</span>
                            <span class="fw-semibold small">{{ $user->created_at->format('d.m.Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted small">{{ __('Total Orders') }}</span>
                            <span class="fw-semibold small">{{ $orders->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Order History --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm" style="border-radius:16px;">
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold mb-0"><i class="bi bi-bag-check me-2 text-primary"></i>{{ __('Order History') }}</h5>
                </div>
                <div class="card-body p-4">
                    @if($orders->isEmpty())
                        <div class="text-center py-5">
                            <div style="font-size: 4rem;" class="mb-3">📦</div>
                            <h5 class="fw-bold mb-2">{{ __('No orders found.') }}</h5>
                            <p class="text-muted mb-4">{{ __("You haven't placed any orders yet.") }}</p>
                            <a href="{{ route('shop.index') }}" class="btn text-white px-4 py-2" style="background:#e94560; border-radius:30px;">
                                <i class="bi bi-bag me-1"></i>{{ __('Start Shopping') }}
                            </a>
                        </div>
                    @else
                        <div class="accordion" id="ordersAccordion">
                            @foreach($orders as $index => $order)
                                <div class="accordion-item border-0 mb-3 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                                    <h2 class="accordion-header" id="heading{{ $order->id }}">
                                        <button class="accordion-button collapsed bg-white text-dark py-3 px-4 d-block position-relative" 
                                                type="button" 
                                                data-bs-toggle="collapse" 
                                                data-bs-target="#collapse{{ $order->id }}" 
                                                aria-expanded="false" 
                                                aria-controls="collapse{{ $order->id }}">
                                            
                                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 me-4">
                                                <div>
                                                    <span class="fw-bold d-block">#ORD-{{ $order->id }}</span>
                                                    <small class="text-muted">{{ $order->created_at->format('d.m.Y H:i') }}</small>
                                                </div>
                                                <div class="text-center px-lg-3">
                                                    <small class="text-muted d-block" style="font-size: 0.75rem;">{{ __('Total') }}</small>
                                                    <span class="fw-bold text-primary">${{ number_format($order->total, 2) }}</span>
                                                </div>
                                                <div>
                                                    <span class="badge bg-{{ $order->status_color }} px-3 py-2" style="border-radius: 20px;">
                                                        {{ $order->status_label }}
                                                    </span>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $order->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $order->id }}" data-bs-parent="#ordersAccordion">
                                        <div class="accordion-body bg-light-subtle p-4 border-top">
                                            <h6 class="fw-bold mb-3"><i class="bi bi-info-circle me-1"></i>{{ __('Order Details') }}</h6>
                                            
                                            {{-- Order items --}}
                                            <div class="table-responsive mb-3">
                                                <table class="table table-borderless align-middle mb-0">
                                                    <thead>
                                                        <tr class="text-muted small border-bottom">
                                                            <th scope="col" style="padding-left:0;">{{ __('Product') }}</th>
                                                            <th scope="col" class="text-center">{{ __('Quantity') }}</th>
                                                            <th scope="col" class="text-end">{{ __('Unit Price') }}</th>
                                                            <th scope="col" class="text-end" style="padding-right:0;">{{ __('Total') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($order->items as $item)
                                                            <tr class="border-bottom">
                                                                <td style="padding-left:0;" class="py-3">
                                                                    <div class="d-flex align-items-center gap-2">
                                                                        @if($item->product?->image)
                                                                            <img src="{{ Storage::url($item->product->image) }}" alt="" 
                                                                                 style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px;">
                                                                        @else
                                                                            <div class="d-flex align-items-center justify-content-center bg-light" 
                                                                                 style="width: 40px; height: 40px; border-radius: 8px; font-size: 1.1rem;">🛍️</div>
                                                                        @endif
                                                                        <div>
                                                                            <span class="fw-semibold small d-block">{{ $item->product_title }}</span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-center py-3">{{ $item->quantity }}</td>
                                                                <td class="text-end py-3">${{ number_format($item->price, 2) }}</td>
                                                                <td class="text-end py-3 fw-semibold text-primary" style="padding-right:0;">
                                                                    ${{ number_format($item->total, 2) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            
                                            {{-- Order summary calculations --}}
                                            <div class="row justify-content-end">
                                                <div class="col-md-6 col-lg-5">
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <span class="text-muted small">{{ __('Subtotal') }}</span>
                                                        <span class="small">${{ number_format($order->subtotal, 2) }}</span>
                                                    </div>
                                                    @if($order->discount > 0)
                                                        <div class="d-flex justify-content-between mb-2 text-danger">
                                                            <span class="small">
                                                                {{ __('Discount') }} 
                                                                @if($order->coupon_code)
                                                                    <span class="badge bg-danger-subtle text-danger ms-1 small" style="font-size:0.7rem;">{{ $order->coupon_code }}</span>
                                                                @endif
                                                            </span>
                                                            <span class="small">-${{ number_format($order->discount, 2) }}</span>
                                                        </div>
                                                    @endif
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <span class="text-muted small">{{ __('Shipping') }}</span>
                                                        <span class="small">{{ $order->shipping == 0 ? __('Free') : '$' . number_format($order->shipping, 2) }}</span>
                                                    </div>
                                                    <hr class="my-2">
                                                    <div class="d-flex justify-content-between fw-bold text-dark">
                                                        <span>{{ __('Total') }}</span>
                                                        <span class="text-primary">${{ number_format($order->total, 2) }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            @if($order->address || $order->note)
                                                <div class="mt-4 pt-3 border-top">
                                                    <div class="row g-3">
                                                        @if($order->address)
                                                            <div class="col-md-6">
                                                                <small class="text-muted d-block mb-1">{{ __('Delivery Address') }}</small>
                                                                <p class="small mb-0 text-dark-emphasis fw-medium">
                                                                    {{ $order->name }}<br>
                                                                    {{ $order->address }}<br>
                                                                    {{ $order->city }} / {{ $order->phone }}
                                                                </p>
                                                            </div>
                                                        @endif
                                                        @if($order->note)
                                                            <div class="col-md-6">
                                                                <small class="text-muted d-block mb-1">{{ __('Order Note') }}</small>
                                                                <p class="small mb-0 text-dark-emphasis fst-italic">
                                                                    "{{ $order->note }}"
                                                                </p>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
