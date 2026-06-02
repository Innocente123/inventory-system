@extends('layouts.app')

@section('title', 'Products')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 page-header" data-aos="fade-down">
        <h1 class="mb-0"><i class="fas fa-box me-2"></i>Products</h1>
        <a href="{{ route('products.create') }}" class="btn btn-glass-primary">
            <i class="fas fa-plus-circle"></i> Add Product
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
                <th><i class="fas fa-tag me-1"></i>Name</th>
                <th class="text-center"><i class="fas fa-cubes me-1"></i>Quantity</th>
                <th><i class="fas fa-dollar-sign me-1"></i>Price</th>
                <th><i class="fas fa-calendar me-1"></i>Created</th>
                <th class="text-center"><i class="fas fa-cog me-1"></i>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->product_id }}</td>
                    <td class="fw-medium">{{ $product->name }}</td>
                    <td class="text-center">
                        <span class="status-badge {{ $product->quantity <= 5 ? ($product->quantity == 0 ? 'danger' : 'warning') : 'success' }}">
                            {{ $product->quantity }}
                        </span>
                    </td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->created_at->format('Y-m-d') }}</td>
                    <td class="text-center">
                        <div class="d-flex gap-1 justify-content-center">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-glass-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-glass-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product) }}"
                                      method="POST" class="d-inline-block"
                                      onsubmit="return confirm('Delete this product?');">
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
                    <td colspan="6" class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <p class="empty-state-text">No products found.</p>
                        <a href="{{ route('products.create') }}" class="btn btn-glass-primary mt-2">
                            <i class="fas fa-plus-circle"></i> Add Your First Product
                        </a>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
@endsection
