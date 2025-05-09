@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="page-header">
    <h1>Categories</h1>
    <div class="header-actions">
        <button class="btn btn-primary" id="openCategoryModal">
            <i class="fas fa-plus"></i> Add Category
        </button>
    </div>
</div>

<div class="category-list-container">
    <div class="category-list-header">
        <h2 class="category-list-title">Your Categories</h2>
        <div class="category-search">
            <div class="input-group" style="max-width: 300px;">
                <input type="text" class="form-control" placeholder="Search categories...">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="category-grid">
        @foreach($categories as $category)
        <div class="category-card">
            <div class="category-icon" style="background-color: {{ $category->color ?? '#4e73df' }};">
                <i class="{{ $category->icon ?? 'fas fa-layer-group' }}"></i>
            </div>
            <h3>{{ $category->name }}</h3>
            <p>{{ $category->short_description }}</p>
            <div class="category-stats">
                <span class="category-stat">
                    <i class="fas fa-box"></i> {{ $category->products_count }} products
                </span>
                <span class="category-stat">
                    <i class="fas fa-eye"></i> {{ $category->views }} views
                </span>
            </div>
            <div class="category-actions">
                <button class="action-btn edit" data-id="{{ $category->id }}">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="action-btn delete" data-id="{{ $category->id }}">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('modals')
<!-- Category Modal -->
<div class="modal" id="categoryModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Add New Category</h3>
            <button class="modal-close" id="closeCategoryModal">&times;</button>
        </div>
        <form id="categoryForm" action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="category-form">
                    <div class="form-column">
                        <!-- Form fields would go here -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancelCategoryForm">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Category specific JavaScript would go here
</script>
@endsection