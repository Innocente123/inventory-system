@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
    <div class="page-header" data-aos="fade-down">
        <h1><i class="fas fa-plus-circle me-2"></i>Add Product</h1>
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
        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="form-label">
                    <i class="fas fa-tag me-1"></i>Product Name
                </label>
                <input type="text" name="name" id="name" class="form-control form-glass"
                       value="{{ old('name') }}" required placeholder="Enter product name">
            </div>

            <div class="mb-4">
                <label for="quantity" class="form-label">
                    <i class="fas fa-cubes me-1"></i>Quantity
                </label>
                <input type="number" name="quantity" id="quantity" class="form-control form-glass"
                       min="0" value="{{ old('quantity', 0) }}" required placeholder="0">
            </div>

            <div class="mb-4">
                <label for="price" class="form-label">
                    <i class="fas fa-dollar-sign me-1"></i>Price
                </label>
                <input type="number" name="price" id="price" class="form-control form-glass"
                       min="0" step="0.01" value="{{ old('price', '0.00') }}" required placeholder="0.00">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-glass-success btn-lg">
                    <i class="fas fa-save"></i> Save Product
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-glass btn-lg">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
