@extends('layouts.admin')
@section('title', __('Edit Product'))
@section('page_title', __('Edit Product'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">{{ __('Products') }}</a></li>
    <li class="breadcrumb-item active">{{ Str::limit($product->title, 30) }}</li>
@endsection

@section('content')
<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
@csrf @method('PUT')
<div class="row g-3">

    {{-- Left Column --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-3" style="border-radius:12px;">
            <div class="card-header bg-transparent border-0 pt-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-semibold">{{ __('Product Information') }}</h6>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                      onsubmit="return confirm('{{ __('Are you sure you want to delete this product?') }}')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash3 me-1"></i>{{ __('Delete') }}
                    </button>
                </form>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-medium">{{ __('Product Name') }} <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $product->title) }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium">{{ __('Short Description') }}</label>
                    <input type="text" name="description" class="form-control"
                           value="{{ old('description', $product->description) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium">{{ __('Detailed Description') }}</label>
                    <textarea name="detail" class="form-control" rows="5">{{ old('detail', $product->detail) }}</textarea>
                </div>

                <div class="mb-0">
                    <label class="form-label fw-medium">{{ __('Keywords') }} (SEO)</label>
                    <input type="text" name="keywords" class="form-control"
                           value="{{ old('keywords', $product->keywords) }}">
                </div>
            </div>
        </div>

        {{-- Image Upload --}}
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-header bg-transparent border-0 pt-3">
                <h6 class="mb-0 fw-semibold">{{ __('Product Image') }}</h6>
            </div>
            <div class="card-body">
                @if($product->image)
                <div class="mb-3 d-flex align-items-center gap-3">
                    <img id="previewImg" src="{{ Storage::url($product->image) }}" alt="{{ $product->title }}"
                         class="rounded-3" style="height:120px;width:120px;object-fit:cover;">
                    <div class="text-muted small">{{ __('Current image. Select a new image to change.') }}</div>
                </div>
                @else
                    <img id="previewImg" src="" alt="" class="d-none rounded-3 mb-3"
                         style="height:120px;width:120px;object-fit:cover;">
                @endif
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                       accept="image/*" onchange="previewImage(this)">
                <div class="form-text">{{ __('Leave blank to keep the current image.') }}</div>
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                           value="{{ old('price', $product->price) }}" required>
                    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium">{{ __('Discount') }} (%)</label>
                    <input type="number" name="discount" min="0" max="100" class="form-control"
                           value="{{ old('discount', $product->discount) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium">{{ __('Stock Quantity') }} <span class="text-danger">*</span></label>
                    <input type="number" name="stock" min="0" class="form-control @error('stock') is-invalid @enderror"
                           value="{{ old('stock', $product->stock) }}" required>
                    @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-0">
                    <label class="form-label fw-medium">{{ __('Minimum Stock') }}</label>
                    <input type="number" name="minstock" min="0" class="form-control"
                           value="{{ old('minstock', $product->minstock) }}">
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-3" style="border-radius:12px;">
            <div class="card-header bg-transparent border-0 pt-3">
                <h6 class="mb-0 fw-semibold">{{ __('Category') }}</h6>
            </div>
            <div class="card-body">
                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                    <option value="">— {{ __('Select Category') }} —</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                           {{ old('status', $product->status) ? 'checked' : '' }}>
                    <label class="form-check-label fw-medium" for="statusSwitch">{{ __('Active') }} ({{ __('published') }})</label>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg me-1"></i>{{ __('Update') }}
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
    const img = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; img.classList.remove('d-none'); };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
