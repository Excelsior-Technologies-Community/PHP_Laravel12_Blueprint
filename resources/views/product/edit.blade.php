@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')

<div class="container mt-4">
    <div class="card shadow p-4">
        <h3 class="mb-4">✏️ Edit Product</h3>

        <form method="POST" action="{{ route('products.update', $product->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Product Name</label>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Price</label>
                <input type="number" name="price" value="{{ $product->price }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Description</label>
                <input type="text" name="description" value="{{ $product->description }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" class="form-control">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>

@endsection