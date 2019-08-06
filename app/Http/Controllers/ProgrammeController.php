<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patterns\Strategy\AddProgramme;
use App\Patterns\Strategy\Context;
use App\Patterns\Strategy\DisplayProgramme;
use App\XML\CampusDOMParser;
use App\Patterns\Strategy\UpdateProgramme;
use App\Model\Programme;
use App\CustomClass\CentralValidator;
use App\Http\Resources\Programme as ProgrammeResource;
use App\Patterns\Strategy\DeleteProgramme;

class ProgrammeController extends Controller
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
        $context = new Context(new DisplayProgramme());
        $programmes = $context->executeStrategy();
        return view('programme.index')->with('programmes', $programmes);
    }

    public function getProgrammes()
    {
        return ProgrammeResource::collection(Programme::all());
    }

    public function show($id)
    {
        $prog = Programme::find($id);
        return view('programme.view')->with('prog', $prog);
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
        $validator = $this->validator->validateRegisterProgramme($request);

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
        $validator = $this->validator->validateEditProgramme($request);

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

    public function delete($id)
    {
        $context = new Context(new DeleteProgramme());
        $context->executeStrategy($id);
        return redirect()->back()->with('deleteStatus', true);
    }
}
