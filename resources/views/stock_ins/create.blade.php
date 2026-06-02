@extends('layouts.app')

@section('title', 'Record Stock In')

@section('content')
    <div class="page-header" data-aos="fade-down">
        <h1><i class="fas fa-download me-2"></i>Record Stock In</h1>
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
        <form action="{{ route('stock-ins.store') }}" method="POST">
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
                            {{ $product->name }} (Qty: {{ $product->quantity }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="supplier_id" class="form-label">
                    <i class="fas fa-truck me-1"></i>Supplier
                </label>
                <select name="supplier_id" id="supplier_id" class="form-select form-glass" required>
                    <option value="">-- Select Supplier --</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->supplier_id }}"
                            {{ old('supplier_id') == $supplier->supplier_id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="quantity" class="form-label">
                    <i class="fas fa-sort-amount-up me-1"></i>Quantity
                </label>
                <input type="number" name="quantity" id="quantity" class="form-control form-glass"
                       min="1" value="{{ old('quantity', 1) }}" required placeholder="Enter quantity">
            </div>

            <div class="mb-4">
                <label for="date" class="form-label">
                    <i class="fas fa-calendar me-1"></i>Date
                </label>
                <input type="date" name="date" id="date" class="form-control form-glass"
                       value="{{ old('date', date('Y-m-d')) }}" required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-glass-success btn-lg">
                    <i class="fas fa-save"></i> Record Stock In
                </button>
                <a href="{{ route('stock-ins.index') }}" class="btn btn-glass btn-lg">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
