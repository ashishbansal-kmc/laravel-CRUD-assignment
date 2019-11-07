<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
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
        $teachers = Teacher::specificData()->orderBy('id','desc')->simplePaginate(5);
        return view('teachers.index',compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.register');
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
            'subject' => 'required|max:100',
            'image' => 'required|image',
        ]);

        // save request data
        $teacher = new Teacher;
        $teacher->name = $request->input('name');
        $teacher->email = $request->input('email');
        $teacher->subject = $request->input('subject');

        $teacher->image = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $image->move($destinationPath, $name);
            $teacher->image = $name;
        }

        // if record save
        if($result = $teacher->save()){
            flash('Record created successfully')->success();
            return redirect('/teachers');
        }else{
            flash('Record not created')->error();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        return view('teachers.edit',compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        // validate request data
         $request->validate([
            'name' => 'required',
            'email' => 'required|email|max:100',
            'subject' => 'required|max:100',
            'image' => 'nullable|image',
        ]);

        // save request data
        $teacher->name = $request->input('name');
        $teacher->email = $request->input('email');
        $teacher->subject = $request->input('subject');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads');
            $image->move($destinationPath, $name);
            $teacher->image = $name;
        }
        $result = $teacher->save();
        // if record save
        if($result){
            flash('Record updated successfully')->success();
            return redirect('/teachers');
        }else{
            flash('Record not updated')->error();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        flash('Record deleted successfully')->success();
        return redirect('/teachers');
    }

    /**
    * list all students registered with teacher
    * @param Request $request, $id
    * @return \Illuminate\Http\Response
    */
    public function studentsList(Request $request, $id){
        $data = Teacher::where('id', $id)->with('students')->firstOrFail();
        
        return view('teachers.students', compact('data'));
    }
}
