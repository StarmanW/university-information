<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patterns\Strategy\AddProgramme;
use App\Patterns\Strategy\Context;
use Illuminate\Support\Facades\Validator;
use App\Patterns\Strategy\DisplayProgramme;
use App\XML\CampusDOMParser;
use App\Patterns\Strategy\UpdateProgramme;

class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $context = new Context(new DisplayProgramme());
        $programmes = $context->executeStrategy();
        return view('programme.index')->with('programmes', $programmes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $worker = new CampusDOMParser();
        $campuses = $worker->getParsedCampusesData();
        return view('programme.create', ['campuses' => $campuses]);
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
            'prog_id' => ['required', 'string', 'max:3', 'regex:/^[A-Z]{3}$/', 'unique:programmes,id'],
            'prog_name' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[A-z\(\)\-\@\, ]{2,255}$/'],
            'prog_desc' => ['required', 'string', 'min:2', 'regex:/^[\w\W\d\D]+$/'],
            'prog_mer' => ['required', 'string', 'min:2', 'regex:/^[\w\W\d\D]+$/'],
            'prog_duration' => 'required|integer|min:1|max:4',
            'prog_level' => 'required', 'string', 'regex:/^(Diploma|Bachelor Degree|Master|Doctorate \(PhD\))$/'
        ]);

        // Adding of new programme
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $context = new Context(new AddProgramme());
            $context->executeStrategy($request);

            if ($context) {
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
        $context = new Context(new DisplayProgramme());
        $worker = new CampusDOMParser();
        $programme = $context->executeStrategy($id);
        $campuses = $worker->getParsedCampusesData();
        return view('programme.edit', ['programme' => $programme, 'campuses' => $campuses]);
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
            'prog_name' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[A-z\(\)\-\@\, ]{2,255}$/'],
            'prog_desc' => ['required', 'string', 'min:2', 'regex:/^[\w\W\d\D]+$/'],
            'prog_mer' => ['required', 'string', 'min:2', 'regex:/^[\w\W\d\D]+$/'],
            'prog_duration' => 'required|integer|min:1|max:4',
            'prog_level' => 'required', 'string', 'regex:/^(Diploma|Bachelor Degree|Master|Doctorate \(PhD\))$/'
        ]);

        // Adding of new programme
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $context = new Context(new UpdateProgramme());
            $context->executeStrategy($request);
            if ($context) {
                return redirect()->back()->with('updateStatus', true);
            } else {
                return redirect()->back()->with('updateStatus', false)->withInput();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
