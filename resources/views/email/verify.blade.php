<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verifikasi Email Anda</title>
</head>
<body>
    <h1>Hai, {{ $payload['nama'] }}</h1>
    <p>Verifikasi email anda dengan klik link dibawah ini</p>

    <a href="{{ url('/register/verifikasi/'.$payload['verify_token']) }}">verifikasi sekarang</a>
</body>
</html>