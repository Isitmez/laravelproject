@extends('layouts.admin')
@section('title', __('Order') . ' #' . $order->id)
@section('page_title', __('Order Detail') . ' #' . $order->id)
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">{{ __('Orders') }}</a></li>
    <li class="breadcrumb-item active">#{{ $order->id }}</li>
@endsection

@section('content')
<div class="row g-3">

    <div class="col-lg-8">
        {{-- Order Items --}}
        <div class="card border-0 shadow-sm mb-3" style="border-radius:12px;">
            <div class="card-header bg-transparent border-0 pt-3">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-cart3 me-2"></i>{{ __('Order Items') }}</h6>
            </div>
            <div class="card-body p-0">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">{{ __('Product') }}</th>
                            <th class="text-center">{{ __('Quantity') }}</th>
                            <th class="text-end">{{ __('Unit Price') }}</th>
                            <th class="text-end pe-3">{{ __('Total') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td class="ps-3">
                                <div class="d-flex align-items-center gap-3">
                                    @if($item->product?->image)
                                        <img src="{{ Storage::url($item->product->image) }}" class="thumb" alt="">
                                    @else
                                        <div class="thumb bg-light d-flex align-items-center justify-content-center">
                                            <i class="bi bi-image text-muted small"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-medium">{{ $item->product_title }}</div>
                                        <div class="text-muted small">ID: {{ $item->product_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-end">${{ number_format($item->price, 2) }}</td>
                            <td class="text-end pe-3 fw-semibold">${{ number_format($item->total, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="3" class="text-end ps-3">{{ __('Subtotal') }}</td>
                            <td class="text-end pe-3">${{ number_format($order->subtotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end ps-3">{{ __('Shipping') }}</td>
                            <td class="text-end pe-3">
                                {!! $order->shipping > 0 ? '$' . number_format($order->shipping, 2) : '<span class="text-success">' . __('Free') . '</span>' !!}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end ps-3 fw-bold">{{ __('Grand Total') }}</td>
                            <td class="text-end pe-3 fw-bold fs-5">${{ number_format($order->total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        @if($order->note)
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body">
                <h6 class="fw-semibold mb-2"><i class="bi bi-chat-text me-2"></i>{{ __('Order Note') }}</h6>
                <p class="mb-0 text-muted">{{ $order->note }}</p>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        {{-- Status Update --}}
        <div class="card border-0 shadow-sm mb-3" style="border-radius:12px;">
            <div class="card-header bg-transparent border-0 pt-3">
                <h6 class="mb-0 fw-semibold">{{ __('Order Status') }}</h6>
            </div>
            <div class="card-body">
                <div class="mb-3 text-center">
                    <span class="badge bg-{{ $order->status_color }} fs-6 px-3 py-2">
                        {{ __($order->status_label) }}
                    </span>
                </div>
                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                    @csrf @method('PATCH')
                    <select name="status" class="form-select mb-3">
                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}>
                                {{ __($label) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-check-lg me-1"></i>{{ __('Update Status') }}
                    </button>
                </form>
            </div>
        </div>

        {{-- Customer Info --}}
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-header bg-transparent border-0 pt-3">
                <h6 class="mb-0 fw-semibold">{{ __('Customer Information') }}</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><i class="bi bi-person me-2 text-muted"></i><strong>{{ $order->name }}</strong></li>
                    <li class="mb-2"><i class="bi bi-envelope me-2 text-muted"></i>{{ $order->email }}</li>
                    <li class="mb-2"><i class="bi bi-phone me-2 text-muted"></i>{{ $order->phone }}</li>
                    <li class="mb-2"><i class="bi bi-geo-alt me-2 text-muted"></i>{{ $order->city }}</li>
                    <li class="mb-0"><i class="bi bi-house me-2 text-muted"></i>{{ $order->address }}</li>
                </ul>
            </div>
            <div class="card-footer bg-transparent border-0">
                <small class="text-muted">
                    <i class="bi bi-calendar3 me-1"></i>{{ $order->created_at->format('d.m.Y H:i') }}
                </small>
            </div>
        </div>
    </div>

</div>

<div class="mt-3">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>{{ __('Back to Orders') }}
    </a>
</div>
@endsection
