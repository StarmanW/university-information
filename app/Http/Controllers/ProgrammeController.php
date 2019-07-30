<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Programme;
use App\Patterns\Strategy\AddProgramme;
use App\Patterns\Strategy\Context;
use Illuminate\Support\Facades\Validator;

class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programmes = Programme::paginate(15);
        return view('programme.index')->with('programmes', $programmes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('programme.create');
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
            'prog_name' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[A-z\-\@\, ]{2,255}$/'],
            'prog_desc' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[A-z0-9\-\@\, ]{2,255}$/'],
            'prog_mer' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[A-z0-9\-\@\, ]{2,255}$/'],
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
