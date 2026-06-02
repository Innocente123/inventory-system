@extends('layouts.app')

@section('title', 'Stock Out Records')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 page-header" data-aos="fade-down">
        <h1 class="mb-0"><i class="fas fa-upload me-2"></i>Stock Out Records</h1>
        <a href="{{ route('stock-outs.create') }}" class="btn btn-glass-warning">
            <i class="fas fa-circle-minus"></i> Record Stock Out
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
                <th class="text-center"><i class="fas fa-sort-amount-down me-1"></i>Quantity</th>
                <th><i class="fas fa-calendar me-1"></i>Date</th>
                <th><i class="fas fa-clock me-1"></i>Recorded At</th>
                <th class="text-center"><i class="fas fa-cog me-1"></i>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($stockOuts as $stockOut)
                <tr>
                    <td>{{ $stockOut->stockout_id }}</td>
                    <td class="fw-medium">{{ $stockOut->product->name ?? 'N/A' }}</td>
                    <td class="text-center">
                        <span class="status-badge warning">-{{ $stockOut->quantity }}</span>
                    </td>
                    <td>{{ $stockOut->date->format('Y-m-d') }}</td>
                    <td>{{ $stockOut->created_at->format('Y-m-d H:i') }}</td>
                    <td class="text-center">
                        <a href="{{ route('stock-outs.show', $stockOut) }}" class="btn btn-sm btn-glass-info">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-upload"></i>
                        </div>
                        <p class="empty-state-text">No stock out records found.</p>
                        <a href="{{ route('stock-outs.create') }}" class="btn btn-glass-warning mt-2">
                            <i class="fas fa-circle-minus"></i> Record First Stock Out
                        </a>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $stockOuts->links('pagination::bootstrap-5') }}
    </div>
@endsection
