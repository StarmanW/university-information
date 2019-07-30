<?php

namespace App\Patterns\Strategy;

use App\Model\Programme;
use App\Model\CampusProgramme;

class UpdateProgramme implements ProgrammeMaintenance
{
    public function execute($request)
    {
        // Add new programme
        $programme = Programme::find($request->input('prog_id'));
        $programme->prog_name = $request->input('prog_name');
        $programme->prog_desc = $request->input('prog_desc');
        $programme->prog_mer = $request->input('prog_mer');
        $programme->prog_duration = $request->input('prog_duration');
        $programme->prog_level = $request->input('prog_level');

        if ($request->input('branch_offered') !== null) {
            foreach ($programme->campusProgrammes as $cp) {
                $cp->delete();
            }
            
            foreach ($request->input('branch_offered') as $branch) {
                $campusProg = new CampusProgramme();
                $campusProg->prog_id = $request->input('prog_id');
                $campusProg->campus_id = $branch;
                $campusProg->save();
            }
        }

        if ($programme->save()) {
            return true;
        } else {
            return false;
        }
    }
}
