<?php

namespace App\Patterns\Strategy;

use App\Model\Programme;
use App\Model\CampusProgramme;

class AddProgramme implements ProgrammeMaintenance
{
    public function execute($request)
    {
        // Add new programme
        $programme = new Programme();
        $programme->id = $request->input('prog_id');
        $programme->faculty_id = Auth::user()->facultyStaffs->faculty_id;
        $programme->prog_name = $request->input('prog_name');
        $programme->prog_desc = $request->input('prog_desc');
        $programme->prog_mer = $request->input('prog_mer');
        $programme->prog_duration = $request->input('prog_duration');
        $programme->prog_level = $request->input('prog_level');

        foreach ($request->input('branch_offered') as $branches) {
            $campusProg = new CampusProgramme();
            $campusProg->prog_id = $request->input('prog_id');
            $campusProg->campus_id = $branches;
            $campusProg->save();
        }

        if ($programme->save()) {
            return true;
        } else {
            return false;
        }
    }
}
