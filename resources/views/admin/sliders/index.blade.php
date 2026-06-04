@extends('layouts.admin')
@section('title', __('Sliders'))
@section('page_title', __('Slider Management'))
@section('breadcrumb')
    <li class="breadcrumb-item active">{{ __('Sliders') }}</li>
@endsection

@section('content')
<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-3 pb-2">
        <h6 class="mb-0 fw-semibold"><i class="bi bi-images me-2 text-success"></i>{{ __('Slider List') }}</h6>
        <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i>{{ __('New Slider') }}
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">{{ __('Order') }}</th>
                        <th>{{ __('Image') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Button') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th class="pe-3 text-end">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sliders as $slider)
                    <tr>
                        <td class="ps-3">
                            <span class="badge bg-light text-dark border">{{ $slider->sort_order }}</span>
                        </td>
                        <td>
                            @if($slider->image)
                                <img src="{{ Storage::url($slider->image) }}"
                                     style="width:80px;height:48px;object-fit:cover;border-radius:8px;" alt="">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                     style="width:80px;height:48px;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-medium">{{ $slider->title }}</div>
                            @if($slider->subtitle)
                                <div class="text-muted small text-truncate" style="max-width:200px;">{{ $slider->subtitle }}</div>
                            @endif
                        </td>
                        <td class="small text-muted">
                            @if($slider->button_text)
                                <span class="badge bg-outline-primary border text-primary">{{ $slider->button_text }}</span>
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            @if($slider->status)
                                <span class="badge bg-success">{{ __('Active') }}</span>
                            @else
                                <span class="badge bg-secondary">{{ __('Passive') }}</span>
                            @endif
                        </td>
                        <td class="pe-3 text-end">
                            <a href="{{ route('admin.sliders.edit', $slider) }}"
                               class="btn btn-action btn-outline-primary me-1" title="{{ __('Edit') }}">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST"
                                  class="d-inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this slider?') }}')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-action btn-outline-danger" title="{{ __('Delete') }}">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="bi bi-images fs-2 d-block mb-2"></i>{{ __('No sliders added yet.') }}
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
