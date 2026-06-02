@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 page-header" data-aos="fade-down">
        <h1 class="mb-0"><i class="fas fa-box me-2"></i>Product Details</h1>
        <a href="{{ route('products.index') }}" class="btn btn-glass">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="detail-card" data-aos="fade-up">
        <div class="detail-header">
            <h4 class="mb-0 fw-bold">
                <i class="fas fa-cube me-2" style="color: #93bbfc;"></i>
                {{ $product->name }}
            </h4>
        </div>
        <div class="detail-body">
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-fingerprint me-2"></i>ID</span>
                <span class="detail-value">{{ $product->product_id }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-cubes me-2"></i>Quantity</span>
                <span class="detail-value">
                    <span class="status-badge {{ $product->quantity <= 5 ? ($product->quantity == 0 ? 'danger' : 'warning') : 'success' }}">
                        {{ $product->quantity }}
                    </span>
                </span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-dollar-sign me-2"></i>Price</span>
                <span class="detail-value">${{ number_format($product->price, 2) }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-calendar-plus me-2"></i>Created</span>
                <span class="detail-value">{{ $product->created_at->format('F d, Y H:i') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-clock me-2"></i>Updated</span>
                <span class="detail-value">{{ $product->updated_at->format('F d, Y H:i') }}</span>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2 mt-4" data-aos="fade-up">
        @if(Auth::user()->isAdmin())
            <a href="{{ route('products.edit', $product) }}" class="btn btn-glass-warning">
                <i class="fas fa-edit"></i> Edit Product
            </a>
        @endif
        <a href="{{ route('stock-ins.create', ['product_id' => $product->product_id]) }}" class="btn btn-glass-success">
            <i class="fas fa-download"></i> Stock In
        </a>
        <a href="{{ route('stock-outs.create', ['product_id' => $product->product_id]) }}" class="btn btn-glass">
            <i class="fas fa-upload"></i> Stock Out
        </a>
    </div>
@endsection
