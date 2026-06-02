@extends('layouts.app')

@section('title', 'Products List')

@section('content')

<div class="container py-4">

    <!-- 🔷 HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Products</h2>
            <small class="text-muted">Manage all your products</small>
        </div>

        <a href="{{ route('products.create') }}" class="btn btn-primary">
            + Add Product
        </a>
    </div>

    <!-- 🔍 SEARCH CARD -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">

            <form method="GET" class="row g-2 align-items-center">

                <div class="col-md-10">
                    <input type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search products by name..."
                        value="{{ request('search') }}">
                </div>

                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-outline-primary">
                        🔍 Search
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- 📦 PRODUCTS TABLE -->
    <div class="card shadow-sm border-0">

        <div class="card-body p-0">

            @if($products->count() > 0)

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($products as $product)
                        <tr>

                            <td class="fw-bold">#{{ $product->id }}</td>

                            <td>
                                <div class="fw-semibold">
                                    {{ $product->name }}
                                </div>
                                <small class="text-muted">
                                    {{ Str::limit($product->description, 40) }}
                                </small>
                            </td>

                            <td>
                                <span class="badge bg-success">
                                    ₹ {{ $product->price }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ $product->category->name ?? '-' }}
                                </span>
                            </td>

                            <td class="text-center">

                                <!-- ✏️ EDIT BUTTON -->
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="btn btn-sm btn-outline-primary me-1">
                                    ✏️ Edit
                                </a>

                                <!-- 🗑 DELETE BUTTON -->
                                <form method="POST"
                                    action="{{ route('products.destroy', $product->id) }}"
                                    onsubmit="return confirm('Are you sure?')"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger">
                                        🗑 Delete
                                    </button>

                                </form>

                            </td>

                        </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

            @else

            <!-- EMPTY STATE -->
            <div class="text-center py-5">

                <h5 class="text-muted">No Products Found</h5>
                <p class="text-muted">Start by adding your first product</p>

                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    + Create Product
                </a>

            </div>

            @endif

        </div>
    </div>
</div>

@endsection