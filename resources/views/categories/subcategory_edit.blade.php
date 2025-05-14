    @extends('comman.layout')
    @section('title', 'Edit Category')
    @section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Category</h4>
                        <form action="{{ route('Subcategory-update', ['id' => $subcategory->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            @if(Session::has('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            @if(Session::has('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                            @endif

                            <div class="form-group">
                            <label for="name">Subcategory Name</label>
                            <input id="name" type="text"
                                class="form-control" name="name"
                                value="{{ old('name', $subcategory->name) }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                            <div class="form-group">
                                <label for="fulldesc">Full Description</label>
                                <textarea class="form-control" id="description" rows="5"
                                        name="description">{{ old('description', $subcategory->description) }}</textarea>
                                @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="row">
                            <div class="col-md-6">
                                <!-- Price Field -->
                                <div class="form-group">
                                    <label for="price">Price Range</label>
                                    <input id="price" type="text"
                                        class="form-control" name="price"
                                        value="{{ old('price', $subcategory->price) }}" placeholder="e.g. $100-$500" required>
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
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                    id="image" name="image" value="{{ old('image', $subcategory->image) }}" accept="image/*">
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

                            <!-- Status Field -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" class="form-control"
                                name="status" required>
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
                    </div>
                    <div class="modal-footer">
                        
                        <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-save mr-1"></i>Update</button>
                           <button> <a href="{{ route('subcategory-view') }}" class="btn btn-secondary" data-dismiss="modal">Cancel</a></button>
                    </div>

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endsection