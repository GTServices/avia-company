<!DOCTYPE html>
<html>
<head>
    <title>Verify Your Email</title>
</head>
<body>
<p>Dear {{ $user->name }},</p>
<p>Please click the link below to verify your email:</p>
<p><a href="{{ $verificationUrl }}">Verify Email</a></p>
<p>If you did not create this account, no further action is required.</p>
</body>
</html>
