@extends('layout')
@section('content')
<div>
    <h4>Tambah Buku</h4>
    <form method="post" action="{{ route('buku.store') }}">
        @csrf
        <div>Judul<input type="text" name="judul"></div>
        <div>Penulis<input type="text" name="penulis"></div>
        <div>Harga<input type="text" name="harga"></div>
        <div>Tgl. Terbit<input type="text" name="tgl_terbit"></div>
        <div><button type="submit">Simpan</button>
        <a href="/buku">Kembali</a></div>
    </form>
</div>
@endsection





