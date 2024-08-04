<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
</head>

<body>
    ADMIN
    <!-- Authentication -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <input type="submit" value="Logout">
    </form>
</body>

</html>