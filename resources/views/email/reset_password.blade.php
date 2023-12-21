<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>

<body>
    <h1>Hai, {{ $payload['nama'] }}</h1>
    <p>Reset password anda dengan klik link dibawah ini</p>

    <a href="{{ url('/register/reset-password-last/' . $payload['verify_token'] . '/' . $payload['email']) }}">
        Reset Password Disini
    </a>
</body>

</html>
