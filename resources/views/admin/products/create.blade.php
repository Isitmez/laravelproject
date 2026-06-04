@extends('layouts.admin')
@section('title', __('New Product'))
@section('page_title', __('Add New Product'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">{{ __('Products') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Add New') }}</li>
@endsection

@section('content')
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="row g-3">

    {{-- Left Column --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-3" style="border-radius:12px;">
            <div class="card-header bg-transparent border-0 pt-3">
                <h6 class="mb-0 fw-semibold">{{ __('Product Information') }}</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-medium">{{ __('Product Name') }} <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}" placeholder="{{ __('Enter product name') }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium">{{ __('Short Description') }}</label>
                    <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                           value="{{ old('description') }}" placeholder="{{ __('Short description (max 500 characters)') }}">
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium">{{ __('Detailed Description') }}</label>
                    <textarea name="detail" class="form-control" rows="5"
                              placeholder="{{ __('Detailed information about the product...') }}">{{ old('detail') }}</textarea>
                </div>

                <div class="mb-0">
                    <label class="form-label fw-medium">{{ __('Keywords') }} (SEO)</label>
                    <input type="text" name="keywords" class="form-control"
                           value="{{ old('keywords') }}" placeholder="{{ __('Separate with commas') }}">
                </div>
            </div>
        </div>

        {{-- Image Upload --}}
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-header bg-transparent border-0 pt-3">
                <h6 class="mb-0 fw-semibold">{{ __('Product Image') }}</h6>
            </div>
            <div class="card-body">
                <div class="border-2 border-dashed rounded-3 p-4 text-center"
                     style="border:2px dashed #dee2e6;cursor:pointer;"
                     onclick="document.getElementById('imageInput').click()">
                    <div id="uploadPlaceholder">
                        <i class="bi bi-cloud-upload fs-2 text-muted d-block mb-2"></i>
                        <div class="text-muted">{{ __('Click to upload image') }}</div>
                        <div class="text-muted small">JPEG, PNG, GIF, WEBP — {{ __('Max 2MB') }}</div>
                    </div>
                    <img id="previewImg" src="" alt="" class="d-none rounded-3"
                         style="max-height:200px;max-width:100%;object-fit:contain;">
                </div>
                <input type="file" name="image" id="imageInput" class="d-none @error('image') is-invalid @enderror"
                       accept="image/*" onchange="previewImage(this)">
                @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    {{-- Right Column --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-3" style="border-radius:12px;">
            <div class="card-header bg-transparent border-0 pt-3">
                <h6 class="mb-0 fw-semibold">{{ __('Price & Stock') }}</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-medium">{{ __('Price') }} ($) <span class="text-danger">*</span></label>
                    <input type="number" name="price" step="0.01" min="0"
                           class="form-control @error('price') is-invalid @enderror"
                           value="{{ old('price') }}" placeholder="0.00" required>
                    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium">{{ __('Discount') }} (%)</label>
                    <input type="number" name="discount" min="0" max="100"
                           class="form-control @error('discount') is-invalid @enderror"
                           value="{{ old('discount', 0) }}" placeholder="0">
                    @error('discount')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium">{{ __('Stock Quantity') }} <span class="text-danger">*</span></label>
                    <input type="number" name="stock" min="0"
                           class="form-control @error('stock') is-invalid @enderror"
                           value="{{ old('stock', 0) }}" required>
                    @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-0">
                    <label class="form-label fw-medium">{{ __('Minimum Stock') }} ({{ __('Warning') }})</label>
                    <input type="number" name="minstock" min="0" class="form-control"
                           value="{{ old('minstock', 5) }}" placeholder="5">
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-3" style="border-radius:12px;">
            <div class="card-header bg-transparent border-0 pt-3">
                <h6 class="mb-0 fw-semibold">{{ __('Category') }}</h6>
            </div>
            <div class="card-body">
                <label class="form-label fw-medium">{{ __('Select Category') }} <span class="text-danger">*</span></label>
                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                    <option value="">— {{ __('Select Category') }} —</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->parent_id != 0 ? '  └ ' : '' }}{{ $category->title }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-body">
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" value="1"
                           {{ old('status', '1') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label fw-medium" for="statusSwitch">{{ __('Active') }} ({{ __('published') }})</label>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i>{{ __('Save Product') }}
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">{{ __('Cancel') }}</a>
                </div>
            </div>
        </div>
    </div>

</div>
</form>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    const placeholder = document.getElementById('uploadPlaceholder');
    const img = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            img.classList.remove('d-none');
            placeholder.classList.add('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
