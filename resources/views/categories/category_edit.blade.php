@extends('comman.layout')
@section('title', 'Edit Category')
@section('content')
<form action="{{ route('add-category', $category->category_id) }}" method="post" enctype="multipart/form-data">
    @if(Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if(Session::has('fail'))
    <div class="alert alert-danger">{{Session::get('fail')}}</div>
    @endif

    @csrf
    @method('PUT')

    <div class="main-panel">        
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Category Information</h4>
                            <p class="card-description">
                                All fields are mandatory
                            </p>
                            
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">#</span>
                                    </div>
                                    <input type="text" 
                                           class="form-control" 
                                           placeholder="Category id" 
                                           name="category_id"  
                                           value="{{ old('category_id', $category->category_id) }}">
                                </div>
                                <span class="text-danger">@error('category_id'){{$message}} @enderror</span>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">#</span>
                                    </div>
                                    <input type="text" 
                                           class="form-control" 
                                           placeholder="Category name" 
                                           name="name" 
                                           value="{{ old('name', $category->name) }}">
                                </div>
                                <span class="text-danger">@error('name'){{$message}} @enderror</span>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">#</span>
                                    </div>
                                    <input type="text" 
                                           class="form-control" 
                                           placeholder="Category Short description"  
                                           name="short_dtls" 
                                           value="{{ old('short_dtls', $category->short_dtls) }}">
                                </div>
                                <span class="text-danger">@error('short_dtls'){{$message}} @enderror</span>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" 
                                          id="exampleTextarea1" 
                                          placeholder="Full description" 
                                          rows="10" 
                                          name="fulldesc">{{ old('fulldesc', $category->fulldesc) }}</textarea>
                                <span class="text-danger">@error('fulldesc'){{$message}} @enderror</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">#</span>
                                    </div>
                                    <input type="text" 
                                           class="form-control" 
                                           placeholder="Category image link" 
                                           name="img_link" 
                                           value="{{ old('img_link', $category->img_link) }}"
                                           id="imglink">
                                </div>
                                <span class="text-danger">@error('img_link'){{$message}} @enderror</span>
                            </div>

                            <div class="card">
                                <img src="{{ old('img_link', $category->img_link) ?? 'https://via.placeholder.com/300x200?text=Image+Preview' }}" 
                                     alt="Preview" 
                                     id="imagePreview"
                                     style="width: 100%; height: auto;"/>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Date Details</h4>
                            <p class="card-description">
                                Category created date and last updated date details.
                            </p>
                            <div class="form-inline">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">#</div>
                                    </div>
                                    <input type="text" 
                                           class="form-control" 
                                           placeholder="{{ $category->created_at->format('Y-m-d H:i:s') }}" 
                                           disabled>
                                </div>

                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">#</div>
                                    </div>
                                    <input type="text" 
                                           class="form-control" 
                                           placeholder="{{ $category->updated_at->format('Y-m-d H:i:s') }}" 
                                           disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mb-2">Update</button>
        </div>
    </div>
</form>
@endsection
