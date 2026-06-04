@extends('layouts.admin')
@section('title', __('Edit Slider'))
@section('page_title', __('Edit Slider'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">{{ __('Sliders') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Edit') }}</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-header bg-transparent border-0 pt-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-pencil me-2 text-warning"></i>{{ __('Edit Slider') }}</h6>
                <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST"
                      onsubmit="return confirm('{{ __('Are you sure you want to delete this slider?') }}')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash3 me-1"></i>{{ __('Delete') }}
                    </button>
                </form>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-medium">{{ __('Title') }} <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $slider->title) }}" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">{{ __('Sort Order') }}</label>
                            <input type="number" name="sort_order" class="form-control"
                                   value="{{ old('sort_order', $slider->sort_order) }}" min="0">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-medium">{{ __('Subtitle') }}</label>
                            <input type="text" name="subtitle" class="form-control"
                                   value="{{ old('subtitle', $slider->subtitle) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">{{ __('Button Text') }}</label>
                            <input type="text" name="button_text" class="form-control"
                                   value="{{ old('button_text', $slider->button_text) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">{{ __('Button Link') }}</label>
                            <input type="text" name="button_link" class="form-control"
                                   value="{{ old('button_link', $slider->button_link) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-medium">{{ __('Change Image') }}</label>
                            @if($slider->image)
                                <div class="mb-2">
                                    <img id="previewImg" src="{{ Storage::url($slider->image) }}" alt=""
                                         class="rounded-3" style="max-height:150px;max-width:100%;object-fit:cover;">
                                </div>
                            @else
                                <img id="previewImg" src="" alt="" class="d-none rounded-3 mb-2"
                                     style="max-height:150px;max-width:100%;object-fit:cover;">
                            @endif
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                   accept="image/*" onchange="previewImage(this)">
                            <div class="form-text">{{ __('Leave blank to keep the current image.') }}</div>
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" id="status" value="1"
                                       {{ old('status', $slider->status) ? 'checked' : '' }}>
                                <label class="form-check-label fw-medium" for="status">{{ __('Active') }}</label>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="bi bi-check-lg me-1"></i>{{ __('Update') }}
                        </button>
                        <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-secondary">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
function previewImage(input) {
    const img = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; img.classList.remove('d-none'); };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
