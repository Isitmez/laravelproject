@extends('layouts.admin')
@section('title', __('New Category'))
@section('page_title', __('Add New Category'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">{{ __('Categories') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Add New') }}</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-header bg-transparent border-0 pt-3">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-plus-circle me-2 text-primary"></i>{{ __('New Category') }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-medium">{{ __('Category Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title') }}" placeholder="{{ __('e.g. Electronics') }}" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium">{{ __('Parent Category') }}</label>
                            <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                                <option value="0">— {{ __('Parent Category') }} —</option>
                                @foreach($parents as $parent)
                                    <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-medium">{{ __('Keywords') }}</label>
                            <input type="text" name="keywords" class="form-control"
                                   value="{{ old('keywords') }}" placeholder="{{ __('Separate with commas: electronics, technology') }}">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-medium">{{ __('Description') }}</label>
                            <textarea name="description" class="form-control" rows="3"
                                      placeholder="{{ __('Short description...') }}">{{ old('description') }}</textarea>
                        </div>

                        <div class="col-md-8">
                            <label class="form-label fw-medium">{{ __('Category Image') }}</label>
                            <input type="file" name="image" id="imageInput"
                                   class="form-control @error('image') is-invalid @enderror"
                                   accept="image/*" onchange="previewImage(this)">
                            <div class="form-text">JPEG, PNG, GIF, WEBP — {{ __('Max 2MB') }}</div>
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4 d-flex align-items-end">
                            <div id="imagePreview" class="d-none">
                                <img id="previewImg" src="" alt="{{ __('Preview') }}"
                                     style="width:100px;height:100px;object-fit:cover;border-radius:10px;border:2px solid #dee2e6;">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status"
                                       id="statusSwitch" value="1"
                                       {{ old('status', '1') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label fw-medium" for="statusSwitch">
                                    {{ __('Active') }} ({{ __('visible on site') }})
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i>{{ __('Save') }}
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                            {{ __('Cancel') }}
                        </a>
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
    const preview = document.getElementById('imagePreview');
    const img = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; preview.classList.remove('d-none'); };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
