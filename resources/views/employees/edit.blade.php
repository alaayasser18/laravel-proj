

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Employee</h2>

       
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Employee Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $employee->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Employee Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $employee->phone) }}" required>
            </div>

            <div class="mb-3">
                <label for="picture" class="form-label">Profile Picture</label>
                <input type="file" name="picture" class="form-control" accept="image/*">
                @if($employee->picture)
                    <img src="{{ asset('storage/' . $employee->picture) }}" alt="Profile Picture" width="150" class="mt-2">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Employee</button>
        </form>

        <div class="mt-3">
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to Employees List</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
