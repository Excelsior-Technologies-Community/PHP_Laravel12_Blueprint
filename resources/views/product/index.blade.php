@extends('layouts.app')

@section('title', 'Products List')

@section('content')

<div class="container py-4">


{{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0">Products</h2>
        <small class="text-muted">Manage all your products</small>
    </div>

    <a href="{{ route('products.create') }}" class="btn btn-primary">
        + Add Product
    </a>
</div>


{{-- Search + Price Filter --}}

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">


    <form method="GET" action="{{ route('products.index') }}">

        <div class="row g-2">

            {{-- Search --}}
            <div class="col-md-4">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Search by product name..."
                       value="{{ request('search') }}">
            </div>

            {{-- Min Price --}}
            <div class="col-md-3">
                <input type="number"
                       name="min_price"
                       class="form-control"
                       placeholder="Min Price"
                       value="{{ request('min_price') }}">
            </div>

            {{-- Max Price --}}
            <div class="col-md-3">
                <input type="number"
                       name="max_price"
                       class="form-control"
                       placeholder="Max Price"
                       value="{{ request('max_price') }}">
            </div>

            {{-- Buttons --}}
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-primary">
                    🔍 Filter
                </button>
            </div>

        </div>

    </form>

</div>


</div>


{{-- Products Table --}}
<div class="card shadow-sm border-0">
    <div class="card-body p-0">

        @if($products->count())

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

                                <td class="fw-bold">
                                    #{{ $product->id }}
                                </td>

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

                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="btn btn-sm btn-outline-primary me-1">
                                        ✏️ Edit
                                    </a>

                                    <form method="POST"
                                          action="{{ route('products.destroy', $product->id) }}"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this product?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger">
                                            🗑 Delete
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            {{-- Pagination --}}
           {{-- Numeric Pagination Only --}}
@if ($products->lastPage() > 1)

<div class="d-flex justify-content-center mt-4 mb-3">

<ul class="pagination">

    @for ($i = 1; $i <= $products->lastPage(); $i++)

        <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">

            <a class="page-link"
               href="{{ $products->appends(request()->query())->url($i) }}">
                {{ $i }}
            </a>

        </li>

    @endfor

</ul>


</div>
@endif


        @else

            <div class="text-center py-5">

                <h5 class="text-muted">
                    No Products Found
                </h5>

                <p class="text-muted">
                    Start by adding your first product
                </p>

                <a href="{{ route('products.create') }}"
                   class="btn btn-primary">
                    + Create Product
                </a>

            </div>

        @endif

    </div>
</div>


</div>

@endsection
