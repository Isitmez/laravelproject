@extends('layouts.admin')
@section('title', __('Edit Category'))
@section('page_title', __('Edit Category'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">{{ __('Categories') }}</a></li>
    <li class="breadcrumb-item active">{{ $category->title }}</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-header bg-transparent border-0 pt-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-pencil me-2 text-warning"></i>{{ __('Edit Category') }}</h6>
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                      onsubmit="return confirm('{{ __('Are you sure you want to delete this category?') }}')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash3 me-1"></i>{{ __('Delete') }}
                    </button>
                </form>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-medium">{{ __('Category Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $category->title) }}" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-medium">{{ __('Parent Category') }}</label>
                            <select name="parent_id" class="form-select">
                                <option value="0">— {{ __('Parent Category') }} —</option>
                                @foreach($parents as $parent)
                                    <option value="{{ $parent->id }}"
                                        {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-medium">{{ __('Keywords') }}</label>
                            <input type="text" name="keywords" class="form-control"
                                   value="{{ old('keywords', $category->keywords) }}">
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-medium">{{ __('Description') }}</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                        </div>

                        <div class="col-md-8">
                            <label class="form-label fw-medium">{{ __('Change Image') }}</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                   accept="image/*" onchange="previewImage(this)">
                            <div class="form-text">{{ __('Leave blank to keep the current image.') }}</div>
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4 d-flex align-items-end">
                            @if($category->image)
                                <img id="previewImg" src="{{ Storage::url($category->image) }}"
                                     style="width:100px;height:100px;object-fit:cover;border-radius:10px;border:2px solid #dee2e6;"
                                     alt="{{ $category->title }}">
                            @else
                                <img id="previewImg" src="" alt="" class="d-none"
                                     style="width:100px;height:100px;object-fit:cover;border-radius:10px;border:2px solid #dee2e6;">
                            @endif
                        </div>

                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" value="1"
                                       {{ old('status', $category->status) ? 'checked' : '' }}>
                                <label class="form-check-label fw-medium" for="statusSwitch">
                                    {{ __('Active') }} ({{ __('visible on site') }})
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="bi bi-check-lg me-1"></i>{{ __('Update') }}
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">{{ __('Cancel') }}</a>
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
