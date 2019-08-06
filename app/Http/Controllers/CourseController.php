<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Course;
use App\Model\ProgrammeCourse;
use App\Model\Programme;
use App\CustomClass\CentralValidator;
use DOMDocument;
use XSLTProcessor;
use SimpleXMLElement;
use Auth;
use App\Http\Resources\Course as CourseResource;

class CourseController extends Controller
{
    private $validator;

    public function __construct()
    {
        $this->validator = new CentralValidator();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $certs = Certificate::all();
        // $jSON = json_decode($certs, true);
        // $xmlCourseData = $this->array2xml($jSON, false);
        // return response($xmlCourseData)->header('Content-Type', 'application/xml');

        $courses = CourseResource::collection(Course::all());
        $jSON = json_decode($courses->collection, true);
        $xmlCourseData = $this->array2xml($jSON, false);

        $xml = new DOMDocument('1.0', 'UTF-8');
        $xslt = $xml->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="course_list.xsl"');
        $xml->appendChild($xslt);
        $xml->loadXML($xmlCourseData);

        // Load XSLT file
        $xsl = new DOMDocument();
        $xsl->load(asset('storage/xml/course_list.xsl'));

        // Create XSLT Processor
        $proc = new XSLTProcessor();
        $proc->importStyleSheet($xsl);

        $courses = $proc->transformToXML($xml);
        return view('courses.index')->with('courses', $courses);
    }

    public function array2xml($array, $xml = false)
    {
        if ($xml === false) {
            $xml = new SimpleXMLElement('<courseList/>');
        }

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->array2xml($value, $xml->addChild("course"));
            } else {
                $xml->addChild($key, $value);
            }
        }
        return $xml->asXML();
    }

    public function getCourses()
    {
        return CourseResource::collection(Course::all());
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
        $validator = $this->validator->valdiateRegisterCourse($request);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // Add new course
            $course = new Course();
            $course->id = $request->input('course_id');
            $course->faculty_id = Auth::user()->facultyStaffs->faculty_id;   
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
        $validator = $this->validator->valdiateEditCourse($request);

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
        $existingProgCourse = ProgrammeCourse::where('prog_id', $id)->where('is_elective', 0)->pluck('course_id')->all();
        $facultyCourses = Course::whereNotIn('id', $existingProgCourse)->get();
        $progCourses = ProgrammeCourse::where('is_elective', '=', 0)->where('prog_id', '=', $id)->get();
        return view('programme.course', ['facultyCourses' => $facultyCourses, 'progCourses' => $progCourses, 'prog_id' => $id]);
    }

    public function addProgCourses(Request $request, $id)
    {
        if (Programme::where('id', $id)->exists()) {
            foreach ($request->input('faculty_courses') as $courseID) {
                $programmeCourse = new ProgrammeCourse();
                $programmeCourse->prog_id = $id;
                $programmeCourse->course_id = $courseID;
                $programmeCourse->is_elective = false;
                $programmeCourse->save();
            }
        }
        return redirect()->back()->with('successAddProgCourses', true);
    }

    public function removeProgCourses(Request $request, $id)
    {
        if (Programme::where('id', $id)->exists()) {
            foreach ($request->input('prog_courses') as $id) {
                $programmeCourse = ProgrammeCourse::find($id);
                $programmeCourse->delete();
            }
        }
        return redirect()->back()->with('successRemoveProgCourses', true);
    }

    public function electiveCourses(Request $request, $id)
    {
        $existingProgCourse = ProgrammeCourse::where('is_elective', 1)->where('prog_id', $id)->pluck('course_id')->all();
        $facultyCourses = Course::whereNotIn('id', $existingProgCourse)->get();
        $progCourses = ProgrammeCourse::where('is_elective', '=', 1)->where('prog_id', '=', $id)->get();
        return view('programme.elective_course', ['facultyCourses' => $facultyCourses, 'progCourses' => $progCourses, 'prog_id' => $id]);
    }

    public function addProgElectiveCourses(Request $request, $id)
    {
        if (Programme::where('id', $id)->exists()) {
            foreach ($request->input('faculty_courses') as $courseID) {
                $programmeCourse = new ProgrammeCourse();
                $programmeCourse->prog_id = $id;
                $programmeCourse->course_id = $courseID;
                $programmeCourse->is_elective = true;
                $programmeCourse->save();
            }
        }
        return redirect()->back()->with('successAddProgElectiveCourses', true);
    }

    public function removeProgElectiveCourses(Request $request, $id)
    {
        if (Programme::where('id', $id)->exists()) {
            foreach ($request->input('prog_courses') as $id) {
                $programmeCourse = ProgrammeCourse::find($id);
                $programmeCourse->delete();
            }
        }
        return redirect()->back()->with('successRemoveProgElectiveCourses', true);
    }

    public function delete($id)
    {
        $course = Course::find($id);
        $course->programmeCourses()->delete();
        $course->delete();
        return redirect()->back()->with('deleteStatus', true);
    }
}
