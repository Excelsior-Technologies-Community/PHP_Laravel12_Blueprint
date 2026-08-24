@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')

<div class="container py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Edit Product</h2>
            <small class="text-muted">Update product information</small>
        </div>

        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
            Back
        </a>
    </div>

    <!-- Card Form -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="row g-3">

                    <!-- Product Name -->
                    <div class="col-md-6">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name', $product->name) }}" required>
                    </div>

                    <!-- Price -->
                    <div class="col-md-6">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" class="form-control"
                               value="{{ old('price', $product->price) }}" required>
                    </div>

                    <!-- Category -->
                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="1" {{ old('status', $product->status) ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !old('status', $product->status) ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description"
                                  rows="4"
                                  class="form-control"
                                  placeholder="Write product description...">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <!-- Image -->
                    <div class="col-12">
                        <label class="form-label">Product Image</label>

                        @if($product->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="img-thumbnail"
                                     width="100"
                                     height="100"
                                     style="object-fit: cover;">
                                <div class="form-text">Current image</div>
                            </div>
                        @endif

                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Leave empty to keep current image. Max size: 2MB. Formats: jpg, png, gif, webp</small>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            Update Product
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

@endsection
