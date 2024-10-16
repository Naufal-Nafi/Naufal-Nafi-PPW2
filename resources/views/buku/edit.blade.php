@extends('layout')
@section('content')
<div>
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
</div>
@endsection


