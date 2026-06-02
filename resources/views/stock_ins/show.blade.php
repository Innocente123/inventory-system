@extends('layouts.app')

@section('title', 'Stock In Details')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 page-header" data-aos="fade-down">
        <h1 class="mb-0"><i class="fas fa-download me-2"></i>Stock In Details</h1>
        <a href="{{ route('stock-ins.index') }}" class="btn btn-glass">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="detail-card" data-aos="fade-up">
        <div class="detail-header">
            <h4 class="mb-0 fw-bold">
                <i class="fas fa-arrow-down me-2" style="color: #6ee7b7;"></i>
                Stock In #{{ $stockIn->stockin_id }}
            </h4>
        </div>
        <div class="detail-body">
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-fingerprint me-2"></i>ID</span>
                <span class="detail-value">{{ $stockIn->stockin_id }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-box me-2"></i>Product</span>
                <span class="detail-value">
                    <a href="{{ route('products.show', $stockIn->product) }}">
                        {{ $stockIn->product->name }}
                    </a>
                </span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-truck me-2"></i>Supplier</span>
                <span class="detail-value">
                    <a href="{{ route('suppliers.show', $stockIn->supplier) }}">
                        {{ $stockIn->supplier->name }}
                    </a>
                </span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-sort-amount-up me-2"></i>Quantity</span>
                <span class="detail-value">
                    <span class="status-badge success">+{{ $stockIn->quantity }}</span>
                </span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-calendar me-2"></i>Date</span>
                <span class="detail-value">{{ $stockIn->date->format('F d, Y') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-clock me-2"></i>Recorded At</span>
                <span class="detail-value">{{ $stockIn->created_at->format('F d, Y H:i:s') }}</span>
            </div>
        </div>
    </div>
@endsection
