@extends('layouts.app')

@section('title', 'Categories')

@section('content')

<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Categories</h2>
            <small class="text-muted">Manage all your product categories</small>
        </div>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            + Add Category
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            @if($categories->count())

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Products</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td class="fw-bold">#{{ $category->id }}</td>
                                    <td class="fw-semibold">{{ $category->name }}</td>
                                    <td class="text-center">
                                        @if($category->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info text-dark">{{ $category->products->count() }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                           class="btn btn-sm btn-outline-primary me-1">
                                            Edit
                                        </a>

                                        <form method="POST"
                                              action="{{ route('categories.destroy', $category->id) }}"
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this category?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($categories->lastPage() > 1)
                    <div class="d-flex justify-content-center mt-4 mb-3">
                        <ul class="pagination">
                            @for ($i = 1; $i <= $categories->lastPage(); $i++)
                                <li class="page-item {{ $categories->currentPage() == $i ? 'active' : '' }}">
                                    <a class="page-link"
                                       href="{{ $categories->appends(request()->query())->url($i) }}">
                                        {{ $i }}
                                    </a>
                                </li>
                            @endfor
                        </ul>
                    </div>
                @endif

            @else
                <div class="text-center py-5">
                    <h5 class="text-muted">No Categories Found</h5>
                    <p class="text-muted">Start by adding your first category</p>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">
                        + Create Category
                    </a>
                </div>
            @endif

        </div>
    </div>

</div>

@endsection
