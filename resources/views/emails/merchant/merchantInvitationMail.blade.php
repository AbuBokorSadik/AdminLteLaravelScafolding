<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP</title>
</head>
<body>
    <h2>Dear {{ $user->name }},</h2>
    <p>Your user name: {{ $user->email }}</p>
    <p>Your password: {{ $password }}</p>
    <p>Click on this link <a href="{{ route('login') }}">{{ route('login') }}</a>. Use avobe Username and Password to log in to your account.</p>

</body>
</html>