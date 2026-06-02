@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')
    <div class="page-header" data-aos="fade-down">
        <h1><i class="fas fa-edit me-2"></i>Edit Supplier</h1>
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
        <form action="{{ route('suppliers.update', $supplier) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="form-label">
                    <i class="fas fa-building me-1"></i>Supplier Name
                </label>
                <input type="text" name="name" id="name" class="form-control form-glass"
                       value="{{ old('name', $supplier->name) }}" required placeholder="Enter supplier name">
            </div>

            <div class="mb-4">
                <label for="phone" class="form-label">
                    <i class="fas fa-phone me-1"></i>Phone
                </label>
                <input type="text" name="phone" id="phone" class="form-control form-glass"
                       value="{{ old('phone', $supplier->phone) }}" placeholder="Enter phone number (optional)">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-glass-primary btn-lg">
                    <i class="fas fa-save"></i> Update Supplier
                </button>
                <a href="{{ route('suppliers.index') }}" class="btn btn-glass btn-lg">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </form>
    </div>
@endsection
