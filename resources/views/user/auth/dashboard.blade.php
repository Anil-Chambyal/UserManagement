<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Welcome, {{ $user->name }}!</h1>
        <p>Email: {{ $user->email }}</p>
        <a href="{{ route('user.logout') }}" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
