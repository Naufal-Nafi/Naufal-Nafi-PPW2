<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_buku as $index => $buku)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis}}</td>
                    <td>{{ "Rp. ".number_format($buku->harga, 2, ',', '.')}}</td>
                    <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Total Buku: {{ $total_buku }}</p>

    <p>Total Harga Semua Buku: Rp. {{ number_format($total_harga, 2, ',', '.') }}</p>
    
</body>
</html>



