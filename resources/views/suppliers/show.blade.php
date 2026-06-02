@extends('layouts.app')

@section('title', 'Supplier Details')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 page-header" data-aos="fade-down">
        <h1 class="mb-0"><i class="fas fa-truck me-2"></i>Supplier Details</h1>
        <a href="{{ route('suppliers.index') }}" class="btn btn-glass">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="detail-card" data-aos="fade-up">
        <div class="detail-header">
            <h4 class="mb-0 fw-bold">
                <i class="fas fa-building me-2" style="color: #6ee7b7;"></i>
                {{ $supplier->name }}
            </h4>
        </div>
        <div class="detail-body">
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-fingerprint me-2"></i>ID</span>
                <span class="detail-value">{{ $supplier->supplier_id }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-phone me-2"></i>Phone</span>
                <span class="detail-value">
                    @if($supplier->phone)
                        {{ $supplier->phone }}
                    @else
                        <span class="text-muted">Not provided</span>
                    @endif
                </span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-calendar-plus me-2"></i>Created</span>
                <span class="detail-value">{{ $supplier->created_at->format('F d, Y H:i') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-clock me-2"></i>Updated</span>
                <span class="detail-value">{{ $supplier->updated_at->format('F d, Y H:i') }}</span>
            </div>
        </div>
    </div>

    <div class="d-flex gap-2 mt-4" data-aos="fade-up">
        @if(Auth::user()->isAdmin())
            <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-glass-warning">
                <i class="fas fa-edit"></i> Edit Supplier
            </a>
        @endif
    </div>
@endsection
