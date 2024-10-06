<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .employee-card {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .employee-card:hover {
            transform: scale(1.02);
        }
        .employee-picture {
            border-radius: 50%;
            width: 60px;
            height: 60px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Employees Managed by You</h1>

        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

       
        <div class="text-right mb-3">
            <a href="{{ route('employees.create') }}" class="btn btn-primary">Add New Employee</a>
        </div>

        
        <div class="row">
            @if($employees->isEmpty())
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No employees found. You can add a new employee by clicking the button above.
                    </div>
                </div>
            @else
                @foreach ($employees as $employee)
                    <div class="col-md-4">
                        <div class="employee-card">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $employee->picture ? asset('storage/' . $employee->picture) : asset('images/default.png') }}" alt="Profile Picture" class="employee-picture">
                                <h5 class="ml-3">{{ $employee->name }}</h5>
                            </div>
                            <p><strong>Email:</strong> {{ $employee->email }}</p>
                            <p><strong>Phone:</strong> {{ $employee->phone }}</p>
                            <div class="text-right">
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <!-- Delete Form -->
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

