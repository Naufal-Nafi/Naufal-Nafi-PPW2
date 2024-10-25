@extends('master')

@section('title')
Halaman Utama
@endsection

@section('content')
<?php                
    $message = Session::get('error')
?>
<div class="alert alert-danger">
    {{$message}}
</div>
<form align="center" id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); 
                            document.getElementById('logout-form').submit();">Logout</a>
                </form>
<h2>Selamat Datang di Halaman Utama</h2>
<p>Ini adalah contoh website sederhana menggunakan Laravel dengan praktik @@section, @@extends, dan @@yield.</p>
@endsection