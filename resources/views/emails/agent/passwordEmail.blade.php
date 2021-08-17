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
    <p>Your user name: {{ $user->name }}</p>
    <p>Your password: {{ $password }}</p>
    <p>Use this <a href="http://127.0.0.1:8000/login">Link</a> and the password to log in your account.</p>

</body>
</html>

