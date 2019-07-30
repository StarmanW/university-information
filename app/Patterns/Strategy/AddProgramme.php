<?php

namespace App\Patterns\Strategy;

use App\Model\Programme;

class AddProgramme implements ProgrammeMaintenance
{
    public function execute($request)
    {
        $programme = new Programme();
        $programme->id = $request->input('prog_id');
        $programme->faculty_id = 'FOCS';
        $programme->prog_name = $request->input('prog_name');
        $programme->prog_desc = $request->input('prog_desc');
        $programme->prog_mer = $request->input('prog_mer');
        $programme->prog_duration = $request->input('prog_duration');
        $programme->prog_level = $request->input('prog_level');
        if ($programme->save()) {
            return true;
        } else {
            return false;
        }
    }
}
