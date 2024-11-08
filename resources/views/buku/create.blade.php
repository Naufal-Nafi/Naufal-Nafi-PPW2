@extends('auth.layouts')
@section('content')
<div class="container mt-5">
    <h4 class="mb-4">Tambah Buku</h4>
    <form method="post" action="{{ route('buku.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul buku">
        </div>
        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" name="penulis" id="penulis" class="form-control" placeholder="Masukkan nama penulis">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" name="harga" id="harga" class="form-control" placeholder="Masukkan harga buku">
        </div>
        <div class="mb-3">
            <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
            <input type="text" name="tgl_terbit" id="tgl_terbit" class="form-control"
                placeholder="Masukkan tanggal terbit">
        </div>
        <div class="mb-4">
            <label for="photo" class="form-label">Photo</label>            
            <img id="photo-preview" src="#" alt="Image Preview"
                style="display: none; width: 200px; margin-bottom: 10px;">
            <input type="file" name="photo" id="photo" class="form-control image-input" value="{{ old('photo') }}"
                onchange="previewImage(event)">
            @if ($errors->has('photo'))
                <span class="text-danger">{{ $errors->first('photo') }}</span>
            @endif
        </div>

        <div class="d-flex">
            <button type="submit" class="btn btn-primary me-2">Simpan</button>
            <a href="/buku" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

@endsection