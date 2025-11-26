@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Product</h1>
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"
                    rows="4">{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ $product->price }}"
                    required>
            </div>
            <div class="form-group">
                <label for="image">Product Image</label>
                @if($product->image_path)
                    <div class="mb-2">
                        <img src="{{ asset('images/' . $product->image_path) }}" width="100" alt="Current Image">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Product</button>
        </form>
    </div>
@endsection