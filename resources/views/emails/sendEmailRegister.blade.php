<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPW2</title>
</head>
<body>
    <h1>Anda telah di registrasi</h1>

    <h4>Nama : {{ $data['name'] }}</h4>
    <h4>Email : {{ $data['email'] }}</h4>
    <h4>Tanggal Pendaftaran : {{ $data['registration_date'] }}</h4>    


    <p>Terima kasih</p>
</body>
</html>


