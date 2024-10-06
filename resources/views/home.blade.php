<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1>Welcome, {{ auth()->user()->name }}</h1>

        <form action="{{ route('logout') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>

        <div class="mt-5">
            <h2>Your Employees</h2>
            <a href="{{ route('employees.index') }}" class="btn btn-info">View Employees</a>
        </div>
    </div>
</body>
</html>
