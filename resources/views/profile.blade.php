<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <h1>Hello This is my profile</h1>

</head>

<body>

    <!-- resources/views/profile.blade.php -->

    <h1>User Profile</h1>

    <p>Name: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <!-- Add more user information fields as needed -->


</body>

</html>