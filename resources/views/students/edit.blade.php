
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Student</h1>

        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label" for="student_name">Student Name</label>
                <input type="text" name="student_name" class="form-control" id="student_name" value="{{ $student->student_name }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="class">Class</label>
                <input type="text" name="class" class="form-control" id="class" value="{{ $student->class }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="class_teacher_id">Class Teacher</label>
                <select name="class_teacher_id" id="class_teacher_id" class="form-control" required>
                    <option value="select">Select</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ $student->class_teacher_id == $teacher->id ? 'selected' : '' }}>{{ $teacher->teacher_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="admission_date">Admission Date</label>
                <input type="date" name="admission_date" class="form-control" id="admission_date" value="{{ $student->admission_date }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="yearly_fees">Yearly Fees</label>
                <input type="number" name="yearly_fees" class="form-control" id="yearly_fees" value="{{ $student->yearly_fees }}" required>
            </div>
            </br>
            <button type="submit" class="btn btn-primary">Update Student</button>
        </form>
    </div>
@endsection
