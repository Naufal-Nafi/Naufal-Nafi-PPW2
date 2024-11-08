@extends('auth.layouts')

@section('content')
<form action="{{ route('gallery.update', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3 row">
        <label for="title" class="col-md-4 col-form-label text-md-end text-start">Title</label>
        <div class="col-md-6">
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <label for="description" class="col-md-4 col-form-label text-md-end text-start">Description</label>

        <div class="col-md-6">
            <textarea class="form-control" id="description" rows="5"
                name="description">{{ $post->description }}</textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="mb-3 row">
        <label for="input-file" class="col-md-4 col-form-label text-md-end text-start">File input</label>
        <div class="col-md-6">
            <div class="input-group">
                <div class="mb-4">
                    
                    <img id="photo-preview" src="{{ asset('storage/posts_image/' . $post->picture) }}" alt="Image Preview"                        
                        style="width: 200px; margin-bottom: 10px;">
                    <input type="file" name="photo" id="photo" class="form-control image-input"
                        value="{{ old('photo') }}" onchange="previewImage(event)">
                    @if ($errors->has('photo'))
                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection