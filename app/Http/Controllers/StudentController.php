<?php

namespace App\Http\Controllers;

use App\Student;
use App\Teacher;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // simple paginate consume less database sql query rahter than paginate
        // paginate method consume 2 sql query
        $students = Student::specificData()->orderBy('id','desc')->simplePaginate(5);
        return view('students.index',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = Teacher::select('id','name')->get();
        return view('students.register', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate request data
        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'address' => 'required|max:255',
            'teacher' => 'required|numeric',
            'image' => 'required|image',
        ]);

        // save request data
        $student = new Student;
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->address = $request->input('address');
        $student->teacher_id = $request->input('teacher');

        $student->image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $image->move($destinationPath, $name);
            $student->image = $name;
        }

        // if record save
        if($result = $student->save()){
            flash('Record created successfully')->success();
            return redirect('/students');
        }else{
            flash('Record not created')->error();
            return redirect()->back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $teachers = Teacher::select('id','name')->get();
        return view('students.edit',compact('student','teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        // validate request data
         $request->validate([
            'name' => 'required',
            'email' => 'required|email|max:100',
            'address' => 'required|max:255',
            'teacher' => 'required|numeric',
            'image' => 'nullable|image',
        ]);

        // save request data
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->address = $request->input('address');
        $student->teacher_id = $request->input('teacher');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $image->move($destinationPath, $name);
            $student->image = $name;
        }
        $result = $student->save();
        // if record save
        if($result){
            flash('Record updated successfully')->success();
            return redirect('/students');
        }else{
            flash('Record not updated')->error();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        flash('Record deleted successfully')->success();
        return redirect('/teachers');
    }
}
