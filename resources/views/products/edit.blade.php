@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="page-header" data-aos="fade-down">
        <h1><i class="fas fa-edit me-2"></i>Edit Product</h1>
    </div>

    @if($errors->any())
        <div class="alert alert-glass alert-danger" data-aos="fade-down">
            <i class="fas fa-exclamation-circle me-2"></i> Please fix the following errors:
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="glass-form-wrap" data-aos="fade-up">
        <form action="{{ route('products.update', $product) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="form-label">
                    <i class="fas fa-tag me-1"></i>Product Name
                </label>
                <input type="text" name="name" id="name" class="form-control form-glass"
                       value="{{ old('name', $product->name) }}" required placeholder="Enter product name">
            </div>

            <div class="mb-4">
                <label for="quantity" class="form-label">
                    <i class="fas fa-cubes me-1"></i>Quantity
                </label>
                <input type="number" name="quantity" id="quantity" class="form-control form-glass"
                       min="0" value="{{ old('quantity', $product->quantity) }}" required placeholder="0">
            </div>

            <div class="mb-4">
                <label for="price" class="form-label">
                    <i class="fas fa-dollar-sign me-1"></i>Price
                </label>
                <input type="number" name="price" id="price" class="form-control form-glass"
                       min="0" step="0.01" value="{{ old('price', $product->price) }}" required placeholder="0.00">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-glass-primary btn-lg">
                    <i class="fas fa-save"></i> Update Product
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-glass btn-lg">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </form>
    </div>
@endsection
