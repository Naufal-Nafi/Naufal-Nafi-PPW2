@extends('auth.layouts')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @else
                    <div class="alert alert-success">
                        You are logged in!
                    </div>
                @endif
                <p align="center"><a href="{{ route('buku.index') }}" class="btn btn-primary m-3">Ke halaman buku</a>
                </p>
                <form align="center" id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); 
                            document.getElementById('logout-form').submit();">Logout</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection