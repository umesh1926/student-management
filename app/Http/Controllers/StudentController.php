<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; // Correctly import the Request class
use App\Models\Student;
use App\Models\Teacher;




class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $students = Student::with('teacher')->paginate(10);
    //     // dd($students);
    //     return view('students.index', compact('students'));
    // }

    public function index(Request $request)
    {

        $search = $request->input('search');

        // Debugging: Check what is being searched
        \Log::info('Search query:', ['search' => $search]);
        // $query = Student::query();

        // if ($request->filled('search')) {
        //     $query->where('student_name', 'like', "%{$request->search}%")
        //         ->orWhere('class', 'like', "%{$request->search}%");
        // }

        // $students = $query->paginate(10);

        $students = Student::with('teacher')
            ->where(function ($query) use ($search) {
                $query->whereRaw('LOWER(student_name) like ?', ['%' . strtolower($search) . '%'])
                    ->orWhereHas('teacher', function ($query) use ($search) {
                        $query->whereRaw('LOWER(teacher_name) like ?', ['%' . strtolower($search) . '%']);
                    });
            })
            ->paginate(10);
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::all(); // Fetch all teachers from the database
        return view('students.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'class_teacher_id' => 'required|exists:teachers,id',
            'class' => 'required|string|max:255',
            'admission_date' => 'required|date',
            'yearly_fees' => 'required|numeric',
        ]);
    
        Student::create($validated);
        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id); // Fetch the student or throw a 404 error

        // Assuming you need to populate the teachers' dropdown again
        $teachers = Teacher::all();

        return view('students.edit', compact('student', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'class_teacher_id' => 'required|exists:teachers,id',
            'class' => 'required|string|max:255',
            'admission_date' => 'required|date',
            'yearly_fees' => 'required|numeric|min:0',
        ]);

        // Find the student or return 404
        $student = Student::findOrFail($id);

        // Update the student's data
        $student->update($validated);

        // Redirect back to the list of students with a success message
        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();

        return redirect()->route('students.index');
    }
}
