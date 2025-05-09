@extends('comman.layout')
@section('title', 'Subcategories')
@section('content')
    <div class="content-wrapper">
        <!-- Subcategory Page -->
        <section id="subcategory-page">
            <div class="page-header">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="page-title">Subcategories</h1>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#subcategoryModal">
                            <i class="fas fa-plus"></i> Add Subcategory
                        </button>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="page-content">
                <div class="subcategory-table-container">
                    <table class="subcategory-table table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Parent Category</th>
                                <th>Products</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subcategories as $subcategory)
                            <tr>
                                <td>{{ $subcategory->name }}</td>
                                <td>{{ $subcategory->category->name ?? 'N/A' }}</td>
                                <td>{{ $subcategory->products_count }}</td>
                                <td>
                                    <span class="badge badge-{{ $subcategory->status == 'active' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($subcategory->status) }}
                                    </span>
                                </td>
                                <td class="text-right">
                                    <button class="btn btn-sm btn-primary mr-1 edit-subcategory" data-id="{{ $subcategory->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger delete-subcategory" data-id="{{ $subcategory->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Subcategory Modal Form -->
        <div class="modal fade" id="subcategoryModal" tabindex="-1" role="dialog" aria-labelledby="subcategoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="subcategoryModalLabel">Add New Subcategory</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('subcategory-view') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <!-- Name Field -->
                            <div class="form-group">
                                <label for="name">Subcategory Name</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    
                            <!-- Description Field -->
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"
                                    rows="3" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Price Field -->
                                    <div class="form-group">
                                        <label for="price">Price Range</label>
                                        <input id="price" type="text"
                                            class="form-control @error('price') is-invalid @enderror" name="price"
                                            value="{{ old('price') }}" placeholder="e.g. $100-$500" required>
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Category Dropdown -->
                                    <div class="form-group">
                                        <label for="category_id">Parent Category</label>
                                        <select id="category_id"
                                            class="form-control @error('category_id') is-invalid @enderror"
                                            name="category_id" required>
                                            <option value="">-- Select Category --</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                    
                            <!-- Image Upload -->
                            <div class="form-group">
                                <label for="image">Subcategory Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                        id="image" name="image" accept="image/*">
                                    <label class="custom-file-label" for="image">Choose file...</label>
                                </div>
                                <small class="form-text text-muted">
                                    Recommended size: 800x600px (Max 2MB)
                                </small>
                                @error('image')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    
                                <!-- Image Preview -->
                                <div class="mt-3 text-center">
                                    <img id="subcategoryImagePreview"
                                        src="https://via.placeholder.com/300x200?text=Image+Preview" alt="Preview"
                                        class="img-thumbnail" style="max-width: 100%; height: auto; max-height: 200px;">
                                </div>
                            </div>
                    
                            <!-- Status Field -->
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" required>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Save Subcategory
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
