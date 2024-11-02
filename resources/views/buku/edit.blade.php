@extends('auth.layouts')
@section('content')
<div class="container mt-5">
    <h4 class="mb-4">Tambah Buku</h4>
    <form method="post" action="{{ route('buku.update', $buku->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ $buku->judul }}">
        </div>
        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" name="penulis" id="penulis" class="form-control" value="{{ $buku->penulis }}">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" name="harga" id="harga" class="form-control" value="{{ $buku->harga }}">
        </div>
        <div class="mb-3">
            <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
            <input type="text" name="tgl_terbit" id="tgl_terbit" class="form-control" value="{{ $buku->tgl_terbit }}">
        </div>
        <div class="mb-4 d-block">
            <label for="photo" class="form-label">Photo</label>
            <!-- Existing Image from Database or Preview -->
            <img id="photo-preview" src="{{ asset('storage/' . $buku->photo) }}" alt="Gambar Buku"
                style="width: 200px; margin-bottom: 10px;">

            <input type="file" name="photo" id="photo" class="form-control" value="{{ old('photo') }}"
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

<!-- <div>
    <h4>Edit Data Buku</h4>
    <form method="post" action="{{ route('buku.update', $buku->id) }}">
        @csrf
        @method('PUT')
        
        <div>Judul <input type="text" name="judul" value="{{ $buku->judul }}"></div>
        <div>Penulis <input type="text" name="penulis" value="{{ $buku->penulis }}"></div>
        <div>Harga <input type="text" name="harga" value="{{ $buku->harga }}"></div>
        <div>Tgl. Terbit <input type="text" name="tgl_terbit" value="{{ $buku->tgl_terbit }}"></div>
        <div><button type="submit">Simpan</button>
        <a href="/buku">Kembali</a></div>
    </form>
</div> -->
@endsection