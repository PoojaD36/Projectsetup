@extends('layouts.app')

@section('title', 'Subcategories')

@section('content')
<div class="page-header">
    <h1>Subcategories</h1>
    <div class="header-actions">
        <button class="btn btn-primary" id="openSubcategoryModal">
            <i class="fas fa-plus"></i> Add Subcategory
        </button>
    </div>
</div>

<div class="subcategory-table-container">
    <table class="subcategory-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Parent Category</th>
                <th>Products</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subcategories as $subcategory)
            <tr>
                <td>{{ $subcategory->name }}</td>
                <td>{{ $subcategory->category->name }}</td>
                <td>{{ $subcategory->products_count }}</td>
                <td>
                    <span class="status-badge {{ $subcategory->is_active ? 'active' : 'inactive' }}">
                        {{ $subcategory->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td>
                    <button class="btn-icon edit-subcategory" data-id="{{ $subcategory->id }}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn-icon delete-subcategory" data-id="{{ $subcategory->id }}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('modals')
<!-- Subcategory Modal would go here -->
@endsection

@section('scripts')
<script>
    // Subcategory specific JavaScript would go here
</script>
@endsection