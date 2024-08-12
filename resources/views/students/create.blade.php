@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Student</h1>
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="student_name">Student Name</label>
            <input type="text" class="form-control" id="student_name" name="student_name" required>
        </div>
        <div class="form-group">
            <label for="class_teacher_id">Class Teacher</label>
            <select class="form-control" id="class_teacher_id" name="class_teacher_id" required >
                <option value="select">Select</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->teacher_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="class">Class</label>
            <input type="text" class="form-control" id="class" name="class" required>
        </div>
        <div class="form-group">
            <label for="admission_date">Admission Date</label>
            <input type="date" class="form-control" id="admission_date" name="admission_date" required>
        </div>
        <div class="form-group">
            <label for="yearly_fees">Yearly Fees</label>
            <input type="number" class="form-control" id="yearly_fees" name="yearly_fees" required>
        </div>
        </br>
        <button type="submit" class="btn btn-primary mb-3" >Submit</button>
    </form>
</div>
@endsection
