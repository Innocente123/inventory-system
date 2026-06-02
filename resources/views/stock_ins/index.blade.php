@extends('layouts.app')

@section('title', 'Stock In Records')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 page-header" data-aos="fade-down">
        <h1 class="mb-0"><i class="fas fa-download me-2"></i>Stock In Records</h1>
        <a href="{{ route('stock-ins.create') }}" class="btn btn-glass-success">
            <i class="fas fa-circle-plus"></i> Record Stock In
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-glass alert-success" data-aos="fade-down">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif

    <div class="glass-table-wrap" data-aos="fade-up">
        <table class="glass-table">
            <thead>
            <tr>
                <th>#</th>
                <th><i class="fas fa-box me-1"></i>Product</th>
                <th><i class="fas fa-truck me-1"></i>Supplier</th>
                <th class="text-center"><i class="fas fa-sort-amount-up me-1"></i>Quantity</th>
                <th><i class="fas fa-calendar me-1"></i>Date</th>
                <th><i class="fas fa-clock me-1"></i>Recorded At</th>
                <th class="text-center"><i class="fas fa-cog me-1"></i>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($stockIns as $stockIn)
                <tr>
                    <td>{{ $stockIn->stockin_id }}</td>
                    <td class="fw-medium">{{ $stockIn->product->name ?? 'N/A' }}</td>
                    <td>{{ $stockIn->supplier->name ?? 'N/A' }}</td>
                    <td class="text-center">
                        <span class="status-badge success">+{{ $stockIn->quantity }}</span>
                    </td>
                    <td>{{ $stockIn->date->format('Y-m-d') }}</td>
                    <td>{{ $stockIn->created_at->format('Y-m-d H:i') }}</td>
                    <td class="text-center">
                        <a href="{{ route('stock-ins.show', $stockIn) }}" class="btn btn-sm btn-glass-info">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-download"></i>
                        </div>
                        <p class="empty-state-text">No stock in records found.</p>
                        <a href="{{ route('stock-ins.create') }}" class="btn btn-glass-success mt-2">
                            <i class="fas fa-circle-plus"></i> Record First Stock In
                        </a>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $stockIns->links('pagination::bootstrap-5') }}
    </div>
@endsection
