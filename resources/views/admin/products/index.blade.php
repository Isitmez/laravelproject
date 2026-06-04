@extends('layouts.admin')
@section('title', __('Products'))
@section('page_title', __('Product Management'))
@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('Products') }}</li>
@endsection

@section('content')
<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-3 pb-2">
        <h6 class="mb-0 fw-semibold"><i class="bi bi-box-seam me-2 text-info"></i>{{ __('All Products') }}</h6>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i>{{ __('New Product') }}
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">#</th>
                        <th>{{ __('Image') }}</th>
                        <th>{{ __('Product Name') }}</th>
                        <th>{{ __('Category') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Discount') }}</th>
                        <th>{{ __('Stock') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th class="pe-3 text-end">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="ps-3 text-muted small">{{ $product->id }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" class="thumb" alt="{{ $product->title }}">
                            @else
                                <div class="thumb bg-light d-flex align-items-center justify-content-center">
                                    <i class="bi bi-image text-muted small"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-medium">{{ Str::limit($product->title, 40) }}</div>
                            @if($product->description)
                                <div class="text-muted small text-truncate" style="max-width:200px;">{{ $product->description }}</div>
                            @endif
                        </td>
                        <td class="small text-muted">{{ $product->category?->title ?? '—' }}</td>
                        <td class="fw-semibold">${{ number_format($product->price, 2) }}</td>
                        <td>
                            @if($product->discount > 0)
                                <span class="badge bg-danger">%{{ $product->discount }}</span>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td>
                            @if($product->stock == 0)
                                <span class="badge bg-danger">{{ __('Out of Stock') }}</span>
                            @elseif($product->stock <= $product->minstock)
                                <span class="badge bg-warning text-dark">{{ $product->stock }} ({{ __('Low') }})</span>
                            @else
                                <span class="badge bg-success">{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td>
                            @if($product->status)
                                <span class="badge bg-success">{{ __('Active') }}</span>
                            @else
                                <span class="badge bg-secondary">{{ __('Inactive') }}</span>
                            @endif
                        </td>
                        <td class="pe-3 text-end">
                            <a href="{{ route('admin.products.edit', $product) }}"
                               class="btn btn-action btn-outline-primary me-1" title="{{ __('Edit') }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                  class="d-inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this product?') }}')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-action btn-outline-danger" title="{{ __('Delete') }}">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-5">
                            <i class="bi bi-box-seam fs-2 d-block mb-2"></i>
                            {{ __('No products found') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($products->hasPages())
    <div class="card-footer bg-transparent border-0">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
