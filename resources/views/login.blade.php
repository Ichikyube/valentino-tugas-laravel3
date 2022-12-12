<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form method="post">
        @csrf

        <label for="email">Email : </label>
        <input type="email" placeholder="email" id="email">
        <label for="password">Password</label>
        <input type="password">
</body>
</html>
