<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Course;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Model\ProgrammeCourse;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return view('courses.index')->with('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate Data
        $validator = Validator::make($request->all(), [
            'course_id' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[A-Z\-]{4}\d{4}$/'],
            'course_name' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[A-z\(\)\-\@\, ]{2,255}$/'],
            'course_desc' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[\w\W\d\D]+$/'],
            'course_cred_hour' => ['required', 'string', 'min:1', 'max:4', 'regex:/^[1-4]$/'],
            'course_fee' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // Add new course
            $course = new Course();
            $course->id = $request->input('course_id');
            $course->course_name = $request->input('course_name');
            $course->course_desc = $request->input('course_desc');
            $course->course_cred_hour = $request->input('course_cred_hour');
            $course->course_fee = $request->input('course_fee');

            if ($course->save()) {
                return redirect()->back()->with('addStatus', true);
            } else {
                return redirect()->back()->with('addStatus', false)->withInput();
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        return view('courses.edit', ['course' => $course]);
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

        //Validate Data
        $validator = Validator::make($request->all(), [
            'course_name' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[A-z\(\)\-\@\, ]{2,255}$/'],
            'course_desc' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[\w\W\d\D]+$/'],
            'course_cred_hour' => ['required', 'string', 'min:1', 'max:4', 'regex:/^[1-4]$/'],
            'course_fee' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // Update course
            $course = Course::find($id);
            $course->course_name = $request->input('course_name');
            $course->course_desc = $request->input('course_desc');
            $course->course_cred_hour = $request->input('course_cred_hour');
            $course->course_fee = $request->input('course_fee');

            if ($course->save()) {
                return redirect()->back()->with('updateStatus', true);
            } else {
                return redirect()->back()->with('updateStatus', false)->withInput();
            }
        }
    }

    public function courses($id)
    {
        $existingProgCourse = ProgrammeCourse::pluck('course_id')->all();
        $facultyCourses = Course::whereNotIn('id', $existingProgCourse)->get();
        $progCourses = ProgrammeCourse::where('is_elective', '=', 0)->where('prog_id', '=', $id)->get();
        return view('programme.course', ['facultyCourses' => $facultyCourses, 'progCourses' => $progCourses, 'prog_id' => $id]);
    }

    public function addProgCourses()
    { }

    public function removeProgCourses()
    { }

    public function electiveCourses()
    { }

    public function addProgElectiveCourses()
    { }

    public function removeProgElectiveCourses()
    { }

}
