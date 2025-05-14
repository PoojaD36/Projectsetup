@extends('comman.layout')
@section('title', 'Categories')
@section('content')
    <div class="content-wrapper">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3 class="page-title">Categories Management</h3>
                </div>
                <div class="col-md-6 text-md-right mt-3 mt-md-0">
                    <button id="openCategoryModal" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Category
                    </button>
                </div>
            </div>
        </div>

        <!-- Category Modal Form -->
        <div id="categoryModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Add New Category</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="add-category" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            @if (Session::has('success'))
                                <div class="alert alert-success">{{ Session::get('success') }}</div>
                            @endif
                            @if (Session::has('fail'))
                                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                            @endif

                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="Enter category name" name="name" value="{{ old('name') }}">
                                </div>
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="image">Image URL</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    </div>
                                    <input type="file" class="form-control" id="image" placeholder="Enter image URL"
                                        name="image" value="{{ old('image') }}">
                                </div>
                                <span class="text-danger">
                                    @error('image')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <div class="mt-2 text-center">
                                    <img id="imagePreview" src="https://via.placeholder.com/300x200?text=Image+Preview"
                                        alt="Preview" class="img-thumbnail" style="max-height: 150px; width: auto;">
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="fulldesc">Description</label>
                                <textarea class="form-control" id="fulldesc" rows="3" name="fulldesc" placeholder="Enter category description">{{ old('fulldesc') }}</textarea>
                                <span class="text-danger">
                                    @error('fulldesc')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <!-- Status Field -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" class="form-control @error('status') is-invalid @enderror" name="status"
                                required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="subcategory-table-container">
                            <table class="subcategory-table table table-hover" id="categoriesTable"
                                style="width: 100% !important;">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($listData)
                                        @if (count($listData) > 0)
                                            @foreach ($listData as $index => $cd)
                                                <tr>
                                                    <td class="text-center">{{ $index + 1 }}</td>
                                                    <td>
                                                        <h5 class="mb-0">{{ $cd->name }}</h5>
                                                        <small class="text-muted">ID: {{ $cd->category_id }}</small>
                                                    </td>
                                                    <td>
                                                        <img src="http://127.0.0.1:8000/{{ $cd->image }}"
                                                            style="width: 80px; height: 60px; object-fit: cover;"
                                                            alt="{{ $cd->image }}">
                                                    </td>
                                                    <td>
                                                        <p class="text-muted mb-0">{{ Str::limit($cd->description, 50) }}</p>
                                                    </td>
                                                    <td>
                                                        @if (strtolower($cd->status) === 'active')
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
                                                            <a href="{{ route('Category-edit', ['id' => $cd->id]) }}"
                                                                class="btn btn-sm btn-primary mr-1 edit-subcategory"
                                                                data-toggle="tooltip" title="Edit">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            {{-- <form action="{{ route('category-delete', $cd->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger delete-subcategory"
                                                                    data-toggle="tooltip" title="Delete"
                                                                    onclick="return confirm('Are you sure you want to delete this category?')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form> --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="6" class="text-center py-4">
                                                    <div class="empty-state">
                                                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                                        <h4>No Categories Found</h4>
                                                        <p class="text-muted">You haven't added any categories yet</p>
                                                        <button id="openCategoryModalEmpty" class="btn btn-primary">
                                                            <i class="fas fa-plus mr-1"></i> Add Category
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <div class="alert alert-warning mb-0">
                                                    Categories data not available.
                                                </div>
                                            </td>
                                        </tr>
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
