
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Students</h1>
        </div>

        <!-- Search form -->
        <form action="{{ route('students.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by student name or teacher name" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <!-- Students table -->
        <table class="table table-bordered border-primarytable mt-4">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Class</th>
                    <th>Teacher</th>
                    <th>Admission Date</th>
                    <th>Yearly Fees</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->student_name }}</td>
                        <td>{{ $student->class }}</td>
                        <td>{{ $student->teacher->teacher_name }}</td>
                        <td>{{ $student->admission_date }}</td>
                        <td>{{ $student->yearly_fees }}</td>
                        <td>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No students found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination links -->
        {{ $students->appends(['search' => request('search')])->links() }}
    </div>
@endsection
