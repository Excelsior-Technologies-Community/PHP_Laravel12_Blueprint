@extends('layouts.app')

@section('title', 'Create Product')

@section('content')

<div class="container py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Create Product</h2>
            <small class="text-muted">Add a new product to your inventory</small>
        </div>

        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
            ← Back
        </a>
    </div>

    <!-- Card Form -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <form method="POST" action="{{ route('products.store') }}">
                @csrf

                <div class="row g-3">

                    <!-- Product Name -->
                    <div class="col-md-6">
                        <label class="form-label">Product Name</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="Enter product name"
                               required>
                    </div>

                    <!-- Price -->
                    <div class="col-md-6">
                        <label class="form-label">Price</label>
                        <input type="number"
                               name="price"
                               class="form-control"
                               placeholder="Enter price"
                               required>
                    </div>

                    <!-- Category -->
                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description"
                                  rows="4"
                                  class="form-control"
                                  placeholder="Write product description..."></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            💾 Save Product
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

@endsection