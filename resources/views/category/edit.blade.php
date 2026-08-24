@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Edit Category</h2>
            <small class="text-muted">Update category information</small>
        </div>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
            Back
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('categories.update', $category->id) }}">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ $category->name }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="1" {{ $category->status ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$category->status ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            Update Category
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

</div>

@endsection
