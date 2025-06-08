<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>


<div>
    <!-- Display Status Message -->
    @if(session('success'))
    <div class="alert alert-success" id="success">
        {{ Session::get('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger" id="danger">
        {{ Session::get('error') }}
    </div>
    @endif

    <!-- Display Student Lists Table -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 style="float: left;"><strong>Student Lists</strong></h6>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#studentListsModal">
                                Add New Student
                            </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">ID</th>
                                    <th style="text-align: center;">Name</th>
                                    <th style="text-align: center;">Age</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
                                    <td style="text-align: center;">{{ $student->id }}</td>
                                    <td style="text-align: center;">{{ $student->name }}</td>
                                    <td style="text-align: center;">{{ $student->age }}</td>
                                    <td>
                        <!-- Edit Button -->
                        <button type="button" class="btn btn-sm btn-warning" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editStudentModal{{ $student->id }}">
                            Edit
                        </button>
                        
                        <!-- Delete Button -->
                        <form action="{{ route('students.destroy', $student->id) }}" 
                              method="POST" 
                              style="display: inline-block;"
                              onsubmit="return confirm('Are you sure you want to delete this student?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit Modal for each student -->
                <div class="modal fade" id="editStudentModal{{ $student->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('students.update', $student->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Student</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="editStdName{{ $student->id }}" class="form-label">Name</label>
                                        <input type="text" class="form-control" 
                                               id="editStdName{{ $student->id }}" 
                                               name="stdName" 
                                               value="{{ $student->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editStdAge{{ $student->id }}" class="form-label">Age</label>
                                        <input type="number" class="form-control" 
                                               id="editStdAge{{ $student->id }}" 
                                               name="stdAge" 
                                               value="{{ $student->age }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Student</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </tbody>
        </table>


    <!-- Modal -->
    <div class="modal fade" id="studentListsModal" tabindex="-1" aria-labelledby="studentListsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="studentListsModalLabel">Add New Student</h1>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="stdName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="stdName" name="stdName" value="{{ old('stdName') }}" placeholder="Enter Name">
                            @error('stdName')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stdAge" class="form-label">Age</label>
                            <input type="text" class="form-control" id="stdAge" name="stdAge" value="{{ old('stdAge') }}" placeholder="Enter Age">
                            @error('stdAge')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>