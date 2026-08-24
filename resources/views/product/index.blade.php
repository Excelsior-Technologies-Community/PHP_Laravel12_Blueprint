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

        <div class="d-flex gap-2">
            <a href="{{ route('products.export', request()->query()) }}" class="btn btn-outline-success">
                <i class="bi bi-file-earmark-arrow-down"></i> Export CSV
            </a>
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                + Add Product
            </a>
        </div>
    </div>

    {{-- Search + Filter --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">

            <form method="GET" action="{{ route('products.index') }}">

                <div class="row g-2">

                    {{-- Search --}}
                    <div class="col-md-3">
                        <input type="text"
                               name="search"
                               class="form-control"
                               placeholder="Search by product name..."
                               value="{{ request('search') }}">
                    </div>

                    {{-- Category Filter --}}
                    <div class="col-md-2">
                        <select name="category_id" class="form-select">
                            <option value="">All Categories</option>
                            @foreach(\App\Models\Category::all() as $cat)
                                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status Filter --}}
                    <div class="col-md-2">
                        <select name="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    {{-- Min Price --}}
                    <div class="col-md-2">
                        <input type="number"
                               name="min_price"
                               class="form-control"
                               placeholder="Min Price"
                               value="{{ request('min_price') }}">
                    </div>

                    {{-- Max Price --}}
                    <div class="col-md-2">
                        <input type="number"
                               name="max_price"
                               class="form-control"
                               placeholder="Max Price"
                               value="{{ request('max_price') }}">
                    </div>

                    {{-- Buttons --}}
                    <div class="col-md-1 d-grid">
                        <button type="submit" class="btn btn-sm btn-primary">Apply</button>
                    </div>

                </div>

            </form>

        </div>
    </div>

    {{-- Bulk Actions --}}
    <form id="bulk-form" method="POST" action="{{ route('products.bulkDestroy') }}">
        @csrf

        <div class="card shadow-sm border-0 mb-3" id="bulk-actions-bar" style="display: none;">
            <div class="card-body d-flex align-items-center justify-content-between py-2">
                <span id="selected-count" class="text-muted small"></span>
                <div class="d-flex gap-2">
                    <select name="status" class="form-select form-select-sm w-auto" id="bulk-status-select">
                        <option value="">Change Status</option>
                        <option value="active">Activate</option>
                        <option value="inactive">Deactivate</option>
                    </select>
                    <button type="button" onclick="submitBulkStatus()" class="btn btn-sm btn-outline-primary">Apply</button>
                    <button type="submit" class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Delete selected products?')">
                        Delete Selected
                    </button>
                    <button type="button" onclick="clearSelection()" class="btn btn-sm btn-outline-secondary">Clear</button>
                </div>
            </div>
        </div>

    </form>

    {{-- Products Table --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            @if($products->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-dark">
                            <tr>
                                <th><input type="checkbox" id="select-all" onchange="toggleAll()"></th>
                                <th>
                                    @php
                                        $curDir = request('sort_dir', 'asc');
                                        $dir = $curDir === 'asc' ? 'desc' : 'asc';
                                    @endphp
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'id', 'sort_dir' => $dir]) }}" class="text-dark text-decoration-none">
                                        ID
                                        @if(request('sort_by') == 'id')
                                            <i class="bi bi-arrow-{{ $curDir == 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    @php
                                        $curDir = request('sort_dir', 'asc');
                                        $dir = $curDir === 'asc' ? 'desc' : 'asc';
                                    @endphp
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'name', 'sort_dir' => $dir]) }}" class="text-dark text-decoration-none">
                                        Product
                                        @if(request('sort_by') == 'name')
                                            <i class="bi bi-arrow-{{ $curDir == 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>
                                    @php
                                        $curDir = request('sort_dir', 'asc');
                                        $dir = $curDir === 'asc' ? 'desc' : 'asc';
                                    @endphp
                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'price', 'sort_dir' => $dir]) }}" class="text-dark text-decoration-none">
                                        Price
                                        @if(request('sort_by') == 'price')
                                            <i class="bi bi-arrow-{{ $curDir == 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </a>
                                </th>
                                <th>Image</th>
                                <th>Category</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Created</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($products as $product)

                                <tr>

                                    <td>
                                        <input type="checkbox" name="ids[]" value="{{ $product->id }}"
                                               class="product-checkbox" onchange="updateSelected()">
                                    </td>

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
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                 alt="{{ $product->name }}"
                                                 class="img-thumbnail"
                                                 width="50"
                                                 height="50"
                                                 style="object-fit: cover;">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="badge bg-info text-dark">
                                            {{ $product->category->name ?? '-' }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        @if($product->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <small class="text-muted">
                                            {{ $product->created_at ? $product->created_at->format('Y-m-d') : '-' }}
                                        </small>
                                    </td>

                                    <td class="text-center">

                                        <a href="{{ route('products.edit', $product->id) }}"
                                           class="btn btn-sm btn-outline-primary me-1">
                                            Edit
                                        </a>

                                        <form method="POST"
                                              action="{{ route('products.destroy', $product->id) }}"
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this product?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger">
                                                Delete
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
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

<script>
    let selectedCount = 0;

    function toggleAll() {
        const checkboxes = document.querySelectorAll('.product-checkbox');
        const selectAll = document.getElementById('select-all');
        checkboxes.forEach(cb => cb.checked = selectAll.checked);
        updateSelected();
    }

    function updateSelected() {
        const checkboxes = document.querySelectorAll('.product-checkbox:checked');
        selectedCount = checkboxes.length;
        const bulkBar = document.getElementById('bulk-actions-bar');
        const countSpan = document.getElementById('selected-count');

        if (selectedCount > 0) {
            bulkBar.style.display = 'block';
            countSpan.textContent = selectedCount + ' selected';
        } else {
            bulkBar.style.display = 'none';
            document.getElementById('select-all').checked = false;
        }
    }

    function clearSelection() {
        document.querySelectorAll('.product-checkbox').forEach(cb => cb.checked = false);
        document.getElementById('select-all').checked = false;
        updateSelected();
    }

    function submitBulkStatus() {
        const select = document.getElementById('bulk-status-select');
        if (!select.value) return;

        const checkboxes = document.querySelectorAll('.product-checkbox:checked');
        const ids = Array.from(checkboxes).map(cb => cb.value);

        if (ids.length === 0) return;

        if (!confirm(ids.length + ' products will be ' + (select.value === 'active' ? 'activated' : 'deactivated'))) return;

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('products.bulkStatus') }}';
        form.innerHTML = `
            @csrf
            <input type="hidden" name="ids[]" value="">
            <input type="hidden" name="status" value="${select.value}">
        `;

        const hiddenInput = form.querySelector('input[name="ids[]"]');
        ids.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ids[]';
            input.value = id;
            form.appendChild(input);
        });
        hiddenInput.remove();

        document.body.appendChild(form);
        form.submit();
    }
</script>

@endsection
