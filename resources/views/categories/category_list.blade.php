@extends('comman.layout')
@section('title', 'Categories')
@section('content')
    <div class="content-wrapper">
        <!-- Header with Add Category Button -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-0"><i class="fas fa-list-alt mr-2 text-primary"></i>Categories</h2>
                    <button id="openCategoryModal" class="btn btn-primary btn-lg shadow-sm">
                        <i class="fas fa-plus-circle mr-2"></i> Add Category
                    </button>
                </div>
                <hr class="mt-3 mb-4" style="border-top: 2px solid #eee;">
            </div>
        </div>

        <!-- Category Modal Form -->
        <div id="categoryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>Add New Category</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <form action="add-category" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{Session::get('success')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif
                            @if(Session::has('fail'))
                            <div class="alert alert-danger alert-dismissible fade show">
                                {{Session::get('fail')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="font-weight-bold">Category Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light"><i class="fas fa-tag text-primary"></i></span>
                                            </div>
                                            <input type="text" class="form-control border-left-0" id="name" placeholder="Enter category name" name="name" value="{{old('name')}}">
                                        </div>
                                        <span class="text-danger small">@error('name'){{$message}} @enderror</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="imglink" class="font-weight-bold">Image URL</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light"><i class="fas fa-link text-primary"></i></span>
                                            </div>
                                            <input type="text" class="form-control border-left-0" id="imglink" placeholder="Paste image URL" name="imglink" value="{{old('imglink')}}">
                                        </div>
                                        <span class="text-danger small">@error('imglink'){{$message}} @enderror</span>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mb-3">
                                <div class="image-preview-container">
                                    <img id="imagePreview" src="https://via.placeholder.com/300x200?text=Image+Preview" alt="Image Preview" class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                                    <div class="overlay-text">Preview</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fulldesc" class="font-weight-bold">Full Description</label>
                                <textarea class="form-control" id="fulldesc" placeholder="Enter detailed description..." rows="5" name="fulldesc" style="resize: none;">{{old('fulldesc')}}</textarea>
                                <span class="text-danger small">@error('fulldesc'){{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">
                                <i class="fas fa-times mr-2"></i>Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-2"></i>Save Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Categories List Section -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">
                        @isset($listData)
                            @if(count($listData) > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="border-0" style="width: 60px;">Image</th>
                                                <th class="border-0">Name</th>
                                                <th class="border-0" style="width: 150px;">Status</th>
                                                <th class="border-0">Tag</th>
                                                <th class="border-0">Description</th>
                                                <th class="border-0 text-center" style="width: 100px;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($listData as $cd)
                                            <tr class="align-middle">
                                                <td>
                                                    <div class="img-container">
                                                        <img src="{{ $cd->img_link ?? 'https://via.placeholder.com/50?text=No+Image' }}" 
                                                             alt="Category" 
                                                             class="img-fluid rounded"
                                                             onerror="this.src='https://via.placeholder.com/50?text=Image+Error'">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="font-weight-bold text-dark">{{ $cd->name }}</div>
                                                    <small class="text-muted">ID: {{ $cd->category_id }}</small>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="progress flex-grow-1" style="height: 8px;">
                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <small class="ml-2 font-weight-bold">25%</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-pill badge-light border text-dark">{{ $cd->tag }}</span>
                                                </td>
                                                <td>
                                                    <div class="text-truncate" style="max-width: 200px;" data-toggle="tooltip" title="{{ $cd->short_dtls }}">
                                                        {{ Str::limit($cd->short_dtls, 30) }}
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('Category-edit', $cd->category_id) }}" 
                                                           class="btn btn-outline-primary rounded-left"
                                                           data-toggle="tooltip"
                                                           title="Edit">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                        <form action="{{ route('category-delete', $cd->category_id) }}" 
                                                              method="POST" 
                                                              class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    class="btn btn-outline-danger rounded-right"
                                                                    data-toggle="tooltip"
                                                                    title="Delete"
                                                                    onclick="return confirm('Are you sure you want to delete this category?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="p-3 border-top">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-muted small">
                                            Showing {{ $listData->firstItem() }} to {{ $listData->lastItem() }} of {{ $listData->total() }} entries
                                        </div>
                                        <div>
                                            {{ $listData->links() }}
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="text-center p-5">
                                    <div class="empty-state">
                                        <div class="empty-state-icon bg-light-primary rounded-circle">
                                            <i class="fas fa-box-open fa-3x text-primary"></i>
                                        </div>
                                        <h3 class="mt-4">No categories found</h3>
                                        <p class="text-muted mb-4">It looks like you haven't added any categories yet. Get started by adding your first category.</p>
                                        <button id="openCategoryModal" class="btn btn-primary btn-lg px-4">
                                            <i class="fas fa-plus-circle mr-2"></i> Add Category
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="alert alert-warning m-4">
                                <i class="fas fa-exclamation-triangle mr-2"></i>Categories data not available.
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
       
    </style>

@endsection