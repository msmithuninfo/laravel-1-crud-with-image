<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

//Image delete korar jonno nicher aita add kore nite hobe
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index', ['students'=>$students]);
        //return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student;
        $student->name = $request->name; 
        $student->course = $request->course;

        if($request->hasfile('image')){
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/students', $filename);
            $student->image = $filename;
        }
        $student->save();
        return redirect()->back()->with('status','Student Added Successfully.');
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
        $student = Student::find($id);
        return view('students.edit',['student'=>$student]);
        // Student Model ar modde id find korbo

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
        $student = Student::find($id);
        $student->name = $request->name; 
        $student->course = $request->course;

        if($request->hasfile('image')){
            //Start Ager Image Delete korar jonno
            $destination = 'uploads/students/'.$student->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            //End Ager Image Delete korar jonno

            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/students', $filename);
            $student->image = $filename;
        }
        $student->update();
        return redirect()->back()->with('status','Student Updated Successfully.');
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

        $destination = 'uploads/students/'.$student->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
        $student->delete();
        return redirect()->back()->with('status','Student Deleted Successfully.');

    }
}
