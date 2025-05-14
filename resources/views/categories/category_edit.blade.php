    @extends('comman.layout')
    @section('title', 'Edit Category')
    @section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Category</h4>
                        <form action="{{ route('Category-update', ['id' => $category->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            @if(Session::has('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif
                            @if(Session::has('fail'))
                            <div class="alert alert-danger">{{Session::get('fail')}}</div>
                            @endif

                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control" id="name" 
                                    name="name" value="{{ old('name', $category->name) }}">
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-group">
                                <label for="fulldesc">Full Description</label>
                                <textarea class="form-control" id="description" rows="5"
                                        name="description">{{ old('description', $category->description) }}</textarea>
                                @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Image URL</label>
                                <input type="file" class="form-control" id="image" 
                                    name="image" value="{{ old('image', $category->image) }}"
                                    onchange="document.getElementById('imagePreview').src = this.value || 'https://via.placeholder.com/300x200?text=Image+Preview'">
                                @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                                <div class="mt-3 text-center">
                                    {{-- <img id="imagePreview" 
                                        src="{{ $category->image ?? 'https://via.placeholder.com/300x200?text=Image+Preview' }}" 
                                        alt="Preview" class="img-thumbnail" style="max-height: 200px;"> --}}
                                        <img src="http://127.0.0.1:8000/{{ $category->image }}"
                                                            style="width: 80px; height: 60px; object-fit: cover;"
                                                            alt="{{ $category->image }}">
                                </div>
                            </div>
                            <!-- Status Field -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" class="form-control @error('status') is-invalid @enderror"
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

                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                            <a href="{{ route('Categorylist') }}" class="btn btn-light">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection