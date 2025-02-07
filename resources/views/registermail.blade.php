<!DOCTYPE html>
<html>
<head>
    <title>Example Email</title>
</head>
<body>
    <h1>Hello, {{$user->username}}</h1>
    <p>please verify your email by clicking the link below: </p>
    <a href="{{ $url }}">Verify Email</a>
</body>
</html>
