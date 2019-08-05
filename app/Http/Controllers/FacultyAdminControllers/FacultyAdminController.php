<?php

namespace App\Http\Controllers\FacultyAdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CustomClass\CentralValidator;
use App\Model\FacultyStaff;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class FacultyAdminController extends Controller {

    private $validator;

    public function __construct() {
        $this->validator = new CentralValidator();
    }

    public function index() {
        $facultyStaffs = User::where('role', '!=', 'Admin')->where('id', '!=', Auth::user()->id)->get();
        return view('facultyAdmin.index', ['facultyStaffs' => $facultyStaffs]);
    }

    public function showRegisterForm() {
        return view('facultyAdmin.register');
    }

    public function register(Request $request) {
        $validator = $this->validator->validateRegisterFacultyStaff($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user = new User();
            $user->role = 'Staff';
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $userSaved = $user->save();

            // Add new faculty staff
            $facultyStaff = new FacultyStaff();
            $facultyStaff->id = $user->id;
            $facultyStaff->user_id = $user->id;
            $facultyStaff->name = $request->input('name');
            $facultyStaff->faculty_id = 'FOCS'; //Auth::user()->facultyAdmins->faculty_id
            $facultyStaff->specialization = $request->input('specialization');
            $facultyStaff->area_of_interest = $request->input('interest');
            $facultyStaff->position = $request->input('position');
            $facultyStaffSaved = $facultyStaff->save();

            if ($userSaved && $facultyStaffSaved) {
                return redirect()->back()->with('addStatus', true);
            } else {
                return redirect()->back()->with('addStatus', false)->withInput();
            }
        }
    }

    public function showEditForm($id) {
        $staff = User::find($id);
        return view('facultyAdmin.edit', ['staff' => $staff]);
    }

    public function update(Request $request, $id) {
        $currentUser = User::find($id);

        if ($currentUser->role === 'Faculty Admin') {
            $validator = $this->validator->validateRegisterFacultyStaff($request->all());
        } else {
            $validator = $this->validator->validateRegisterFacultyStaff($request->all());
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            if ($request->input('role') === 'FacultyAdmin') {
                //to faculty admin
                //find user id
                $tmpUser = FacultyStaff::find($currentUser->id);

                //add to faculty admin
                $newFacultyAdmin = new FacultyAdmin();
                $newFacultyAdmin->id = $currentUser->id;
                $newFacultyAdmin->user_id = $currentUser->id;
                $newFacultyAdmin->name = $tmpUser->name;
                $newFacultyAdmin->faculty_id = $request->input('faculty');
                $newFacultyAdminSaved = $newFacultyAdmin->save();

                //remove user from...
                $oldUserDeleted = $tmpUser->delete();
            } else if ($request->input('role') === 'Staff') {
                //to staff
                //find user id
                $tmpUser = FacultyAdmin::find($currentUser->id);

                //add to staff
                $newStaff = new FacultyStaff();
                $newStaff->id = $currentUser->id;
                $newStaff->user_id = $currentUser->id;
                $newStaff->name = $tmpUser->name;
                $newStaff->faculty_id = $request->input('faculty');
                $newStaff->specialization = $request->input('specialization');
                $newStaff->area_of_interest = $request->input('interest');
                $newStaff->position = $request->input('position');
                $newStaffSaved = $newStaff->save();

                //remove user from...
                $oldUserDeleted = $tmpUser->delete();
            }

            if ( ($newFacultyAdminSaved || $newStaffSaved) && $oldUserDeleted ) {
                return redirect()->back()->with('updateStatus', true);
            } else {
                return redirect()->back()->with('updateStatus', false)->withInput();
            }
        }
    }

}
