@extends('layouts.admin')
@section('title', __('Orders'))
@section('page_title', __('Order Management'))
@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('Orders') }}</li>
@endsection

@section('content')

{{-- Filter Bar --}}
<div class="card border-0 shadow-sm mb-3" style="border-radius:12px;">
    <div class="card-body py-2">
        <form method="GET" class="row g-2 align-items-center">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control form-control-sm"
                       placeholder="{{ __('Order #, name or email...') }}" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select form-select-sm">
                    <option value="">{{ __('All Statuses') }}</option>
                    @foreach($statuses as $key => $label)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ __($label) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="bi bi-search me-1"></i>{{ __('Filter') }}
                </button>
                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm ms-1">{{ __('Clear') }}</a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">#</th>
                        <th>{{ __('Customer') }}</th>
                        <th>{{ __('City') }}</th>
                        <th>{{ __('Product') }}</th>
                        <th>{{ __('Total') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th class="pe-3 text-end">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="ps-3 fw-medium">#{{ $order->id }}</td>
                        <td>
                            <div class="fw-medium">{{ $order->name }}</div>
                            <div class="text-muted small">{{ $order->email }}</div>
                        </td>
                        <td class="text-muted small">{{ $order->city }}</td>
                        <td class="text-muted small">{{ $order->items->count() }} {{ __('items') }}</td>
                        <td class="fw-semibold">${{ number_format($order->total, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $order->status_color }}">{{ __($order->status_label) }}</span>
                        </td>
                        <td class="text-muted small">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td class="pe-3 text-end">
                            <a href="{{ route('admin.orders.show', $order) }}"
                               class="btn btn-action btn-outline-primary me-1" title="{{ __('Detail') }}">
                                <i class="bi bi-eye"></i>
                            </a>
                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST"
                                  class="d-inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this order?') }}')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-action btn-outline-danger" title="{{ __('Delete') }}">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-bag-x fs-2 d-block mb-2"></i>{{ __('No orders found.') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($orders->hasPages())
    <div class="card-footer bg-transparent border-0">{{ $orders->links() }}</div>
    @endif
</div>
@endsection
