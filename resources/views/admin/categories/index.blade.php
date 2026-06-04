@extends('layouts.admin')
@section('title', __('Categories'))
@section('page_title', __('Categories'))
@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('Categories') }}</li>
@endsection

@section('content')
<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-3 pb-2">
        <h6 class="mb-0 fw-semibold"><i class="bi bi-grid me-2 text-primary"></i>{{ __('All Categories') }}</h6>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i>{{ __('New Category') }}
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3" style="width:50px;">#</th>
                        <th style="width:60px;">{{ __('Image') }}</th>
                        <th>{{ __('Category Name') }}</th>
                        <th>{{ __('Parent Category') }}</th>
                        <th>{{ __('Sub Category') }}</th>
                        <th>{{ __('Product') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th class="pe-3 text-end">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td class="ps-3 text-muted small">{{ $category->id }}</td>
                        <td>
                            @if($category->image)
                                <img src="{{ Storage::url($category->image) }}" class="thumb" alt="{{ $category->title }}">
                            @else
                                <div class="thumb bg-light d-flex align-items-center justify-content-center">
                                    <i class="bi bi-image text-muted small"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-medium">{{ $category->title }}</div>
                            @if($category->description)
                                <div class="text-muted small text-truncate" style="max-width:200px;">{{ $category->description }}</div>
                            @endif
                        </td>
                        <td class="text-muted small">
                            {{ $category->parent?->title ?? __('Parent Category') }}
                            @if(!$category->parent)
                                <span class="badge bg-secondary">{{ __('Main') }}</span>
                            @endif
                        </td>
                        <td>
                            @if($category->children->count() > 0)
                                <span class="badge bg-info text-dark">{{ $category->children->count() }} {{ __('sub') }}</span>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ $category->products->count() }}</span>
                        </td>
                        <td>
                            @if($category->status)
                                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>{{ __('Active') }}</span>
                            @else
                                <span class="badge bg-secondary">{{ __('Inactive') }}</span>
                            @endif
                        </td>
                        <td class="pe-3 text-end">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                               class="btn btn-action btn-outline-primary me-1" title="{{ __('Edit') }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('{{ __('Are you sure you want to delete this category?') }}')">
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
                            <i class="bi bi-grid fs-2 d-block mb-2"></i>
                            {{ __('No categories found.') }}
                            <a href="{{ route('admin.categories.create') }}" class="d-block mt-2">{{ __('Add New Category') }}</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
