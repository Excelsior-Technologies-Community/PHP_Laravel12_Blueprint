@extends('layouts.app')

@section('title', 'Products List')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Products</h2>
    <a href="#" class="btn btn-primary">Add Product</a>
</div>

@if($products->count() > 0)

<div class="card">
    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th width="150">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>₹ {{ $product->price }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning">Edit</button>
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

@else

<div class="alert alert-info">
    No Products Found
</div>

@endif

@endsection
