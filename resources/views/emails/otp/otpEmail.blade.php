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
    <p>{{ $otp }} use this code as your OTP. This otp is valid for 5 min!</p>

</body>
</html>

