@extends('layouts.app')

@section('title', 'Suppliers')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 page-header" data-aos="fade-down">                <h1 class="mb-0"><i class="fas fa-truck me-2"></i>Suppliers</h1>
        @if(Auth::user()->isAdmin())
            <a href="{{ route('suppliers.create') }}" class="btn btn-glass-primary">
                <i class="fas fa-user-plus"></i> Add Supplier
            </a>
        @endif
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
                <th><i class="fas fa-building me-1"></i>Name</th>
                <th><i class="fas fa-phone me-1"></i>Phone</th>
                <th><i class="fas fa-calendar me-1"></i>Created</th>
                <th class="text-center"><i class="fas fa-cog me-1"></i>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->supplier_id }}</td>
                    <td class="fw-medium">{{ $supplier->name }}</td>
                    <td>
                        @if($supplier->phone)
                            <i class="fas fa-phone me-1" style="color: #6ee7b7;"></i>
                            {{ $supplier->phone }}
                        @else
                            <span class="text-muted"><i class="fas fa-minus"></i></span>
                        @endif
                    </td>
                    <td>{{ $supplier->created_at->format('Y-m-d') }}</td>
                    <td class="text-center">
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="{{ route('suppliers.show', $supplier) }}" class="btn btn-sm btn-glass-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-sm btn-glass-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('suppliers.destroy', $supplier) }}"
                                      method="POST" class="d-inline-block"
                                      onsubmit="return confirm('Delete this supplier?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-glass-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <p class="empty-state-text">No suppliers found.</p>
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('suppliers.create') }}" class="btn btn-glass-primary mt-2">
                                <i class="fas fa-user-plus"></i> Add Your First Supplier
                            </a>
                        @endif
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $suppliers->links('pagination::bootstrap-5') }}
    </div>
@endsection
