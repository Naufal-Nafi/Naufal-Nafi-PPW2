@extends('auth.layouts')
@section('content')

<div class="d-flex justify-content-between">
    <p ><a href="{{ route('dashboard') }}" class="btn btn-primary m-3">Dashboard</a></p>
    <p ><a href="{{ route('buku.create') }}" class="btn btn-primary m-3">Tambah Buku</a></p>
</div>
<table class="table">
    <thead>
        <tr>
            <th>id</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Harga</th>
            <th>Tanggal Terbit</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data_buku as $index => $buku)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $buku->judul }}</td>
                <td>{{ $buku->penulis }}</td>
                <td>{{ "Rp. " . number_format($buku->harga, 2, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                <td>
                    @if ($buku->photo)
                        <img src="{{ asset('storage/' . $buku->photo) }}" alt="Gambar Buku" width="200">
                    @else
                        <p>Tidak ada gambar</p>
                    @endif
                </td>
                <td>
                    <div class="d-flex">
                        <form method="post" action="{{ route('buku.destroy', $buku->id) }}">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin di hapus?')" type="submit"
                                class="btn btn-danger me-3">
                                Hapus
                            </button>
                        </form>
                        <p><a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-primary ">Edit</a></p>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


<p>Total Buku: {{ $total_buku }}</p>

<p>Total Harga Semua Buku: Rp. {{ number_format($total_harga, 2, ',', '.') }}</p>

@endsection