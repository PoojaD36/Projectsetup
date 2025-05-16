@extends('comman.layout')
@section('title', 'Products')
@section('content')
    <div class="content-wrapper">
        <!-- Product Page -->
        <section id="product-page">
            <div class="page-header">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto">
                        <h1 class="page-title">Products</h1>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#productModal">
                            <i class="fas fa-plus"></i> Add Product
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
                <div class="product-table-container">
                    <table class="product-table table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $product)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        <h5 class="mb-0">{{ $product->name }}</h5>
                                        <small class="text-muted">ID: {{ $product->id }}</small>
                                    </td>
                                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                                    <td>{{ $product->subcategory->name ?? 'N/A' }}</td>
                                    <td>₹{{ number_format($product->price, 2) }}</td>
                                    <td>
                                        <p class="text-muted mb-0">{{ Str::limit($product->description, 50) }}</p>
                                    </td>
                                    <td>
                                        <img src="http://127.0.0.1:8000/{{ $product->image }}"
                                            style="width: 80px; height: 60px; object-fit: cover;"
                                            alt="{{ $product->image }}">
                                    </td>
                                    <td>
                                        @if (strtolower($product->status) === 'active')
                                            <span class="badge badge-success status-badge active">
                                                Active
                                            </span>
                                        @else
                                            <span class="badge badge-secondary status-badge inactive">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="actions">
                                            <a href="{{ route('Product-edit', ['id' => $product->id]) }}"
                                                class="btn btn-sm btn-primary mr-1 edit-product" data-toggle="tooltip"
                                                title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Product Modal Form -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="productModalLabel">Add New Product</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form method="POST"  action="{{ isset($selectedCategory) ? route('product.store'): route('product-add')   }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <!-- Name Field -->
                            <div class="form-group">
                                <label for="name">Product Name</label>
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
                                        <label for="price">Price (₹)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                            <input id="price" type="number" step="0.01"
                                                class="form-control @error('price') is-invalid @enderror" name="price"
                                                value="{{ old('price') }}" required>
                                        </div>
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Category Dropdown -->
                                    <div class="form-group">
                                        <label for="category_id">Category</label>
                                        <select class="form-control" id="category_id" name="category_id" required
                                            onchange="this.form.submit()">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $selectedCategory ?? '') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Subcategory Dropdown -->
                                    @if (isset($selectedCategory))
                                        <div class="form-group mb-3">
                                            <label for="subcategory_id">Subcategory</label>
                                            <select class="form-control" id="subcategory_id" name="subcategory_id"
                                                required>
                                                <option value="">Select Subcategory</option>
                                                @foreach ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}"
                                                        {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                                                        {{ $subcategory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            
                                            @error('subcategory_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                    @endif
                                

                            <div class="col-md-6">
                                <!-- Status Field -->
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" class="form-control @error('status') is-invalid @enderror"
                                        name="status" required>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="form-group">
                            <label for="image">Product Image</label>
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
                                <img id="productImagePreview" src="https://via.placeholder.com/300x200?text=Image+Preview"
                                    alt="Preview" class="img-thumbnail"
                                    style="max-width: 100%; height: auto; max-height: 200px;">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Save Product
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
