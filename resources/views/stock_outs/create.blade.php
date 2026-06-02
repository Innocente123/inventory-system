@extends('layouts.app')

@section('title', 'Record Stock Out')

@section('content')
    <div class="page-header" data-aos="fade-down">
        <h1><i class="fas fa-upload me-2"></i>Record Stock Out</h1>
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
        <form action="{{ route('stock-outs.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="product_id" class="form-label">
                    <i class="fas fa-box me-1"></i>Product
                </label>
                <select name="product_id" id="product_id" class="form-select form-glass" required>
                    <option value="">-- Select Product --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->product_id }}"
                            {{ old('product_id', request('product_id')) == $product->product_id ? 'selected' : '' }}>
                            {{ $product->name }} (Available: {{ $product->quantity }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="quantity" class="form-label">
                    <i class="fas fa-sort-amount-down me-1"></i>Quantity
                </label>
                <input type="number" name="quantity" id="quantity" class="form-control form-glass"
                       min="1" value="{{ old('quantity', 1) }}" required placeholder="Enter quantity to remove">
            </div>

            <div class="mb-4">
                <label for="date" class="form-label">
                    <i class="fas fa-calendar me-1"></i>Date
                </label>
                <input type="date" name="date" id="date" class="form-control form-glass"
                       value="{{ old('date', date('Y-m-d')) }}" required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-glass-warning btn-lg">
                    <i class="fas fa-save"></i> Record Stock Out
                </button>
                <a href="{{ route('stock-outs.index') }}" class="btn btn-glass btn-lg">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
