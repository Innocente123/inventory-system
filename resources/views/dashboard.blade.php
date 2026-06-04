@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4 page-header" data-aos="fade-down">
        <h1 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Dashboard</h1>
    </div>

    {{-- Summary Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-value">{{ $totalProducts }}</div>
                <p class="stat-label">Total Products</p>
            </div>
        </div>

        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="stat-value">{{ $totalSuppliers }}</div>
                <p class="stat-label">Total Suppliers</p>
            </div>
        </div>

        <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-download"></i>
                </div>
                <div class="stat-value">{{ number_format($totalStockInQuantity) }}</div>
                <p class="stat-label">Total Stock In</p>
            </div>
        </div>

        <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-upload"></i>
                </div>
                <div class="stat-value">{{ number_format($totalStockOutQuantity) }}</div>
                <p class="stat-label">Total Stock Out</p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Low Stock Alerts --}}
        <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="section-card section-red h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-exclamation-triangle"></i>
                        Low Stock Alerts
                    </h5>
                    <span class="badge fs-6">{{ $lowStockCount }}</span>
                </div>
                <div class="card-body p-0">
                    @if($lowStockProducts->count() > 0)
                        <div class="table-responsive">
                            <table class="glass-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lowStockProducts as $product)
                                        <tr class="{{ $product->quantity == 0 ? 'table-row-danger' : 'table-row-warning' }}">
                                            <td>
                                                <a href="{{ route('products.show', $product) }}" class="fw-medium">
                                                    {{ $product->name }}
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <span class="status-badge {{ $product->quantity == 0 ? 'danger' : 'warning' }}">
                                                    {{ $product->quantity }}
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('stock-ins.create', ['product_id' => $product->product_id]) }}"
                                                    class="btn btn-sm btn-glass-primary">
                                                    <i class="fas fa-rotate"></i> Restock
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="empty-state-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <p class="empty-state-text">All products are well stocked!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Recent Stock In --}}
        <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="section-card section-green h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-download"></i>
                        Recent Stock In
                    </h5>
                    <a href="{{ route('stock-ins.index') }}" class="btn btn-sm btn-glass">
                        <i class="fas fa-arrow-right"></i> View All
                    </a>
                </div>
                <div class="card-body p-0">
                    @if($recentStockIns->count() > 0)
                        <div class="table-responsive">
                            <table class="glass-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Product</th>
                                        <th>Supplier</th>
                                        <th class="text-center">Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentStockIns as $stockIn)
                                        <tr>
                                            <td class="text-nowrap">{{ $stockIn->date->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('products.show', $stockIn->product) }}">
                                                    {{ $stockIn->product->name }}
                                                </a>
                                            </td>
                                            <td>{{ $stockIn->supplier->name ?? 'N/A' }}</td>
                                            <td class="text-center">
                                                <span class="status-badge success">+{{ $stockIn->quantity }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="empty-state-icon">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <p class="empty-state-text">No stock in records yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Recent Stock Out --}}
        <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="section-card section-yellow h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-upload"></i>
                        Recent Stock Out
                    </h5>
                    <a href="{{ route('stock-outs.index') }}" class="btn btn-sm btn-glass">
                        <i class="fas fa-arrow-right"></i> View All
                    </a>
                </div>
                <div class="card-body p-0">
                    @if($recentStockOuts->count() > 0)
                        <div class="table-responsive">
                            <table class="glass-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Product</th>
                                        <th class="text-center">Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentStockOuts as $stockOut)
                                        <tr>
                                            <td class="text-nowrap">{{ $stockOut->date->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('products.show', $stockOut->product) }}">
                                                    {{ $stockOut->product->name }}
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <span class="status-badge warning">-{{ $stockOut->quantity }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="empty-state-icon">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <p class="empty-state-text">No stock out records yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="section-card section-blue h-100">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body p-3">
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="{{ route('products.create') }}" class="quick-action-btn">
                                <span class="action-icon">
                                    <i class="fas fa-plus-circle"></i>
                                </span>
                                Add Product
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('stock-ins.create') }}" class="quick-action-btn">
                                <span class="action-icon">
                                    <i class="fas fa-download"></i>
                                </span>
                                Stock In
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('stock-outs.create') }}" class="quick-action-btn">
                                <span class="action-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                Stock Out
                            </a>
                        </div>
                        @if(Auth::user()->isAdmin())
                            <div class="col-6">
                                <a href="{{ route('suppliers.create') }}" class="quick-action-btn">
                                    <span class="action-icon">
                                        <i class="fas fa-user-plus"></i>
                                    </span>
                                    Add Supplier
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection