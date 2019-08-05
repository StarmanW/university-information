<?php

namespace App\Http\Controllers\FacultyAdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CustomClass\CentralValidator;
use App\Model\FacultyStaff;
use App\Model\FacultyAdmin;
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
        $userSaved = false;
        $facultyStaffSaved = false;

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
            $facultyStaff->faculty_id = Auth::user()->facultyAdmins->faculty_id;
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
        if (Auth::user()->id == $id) {
            return redirect('/faculty_admin')->with('selectError', 'Please select an appropriate user.');
        } else {
            $staff = User::find($id);
            return view('facultyAdmin.edit', ['staff' => $staff]);
        }
    }

    public function update(Request $request, $id) {
        $currentUser = User::find($id);
        $newStaffSaved = false;
        $newFacultyAdminSaved = false;
        $oldUserDeleted = false;

        if ($currentUser->role === 'Staff') {
            $validator = $this->validator->validateEditFacultyAdminFA($request->all());
        } elseif ($currentUser->role === 'Faculty Admin') {
            $validator = $this->validator->validateEditFacultyStaffFA($request);
        } else {
            return redirect()->back()->withInput()->with('roleError', 'Please select an appropriate role');
        }


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            if ($request->input('role') === $currentUser->role) {
                return redirect()->back()->withInput()->with('roleError', 'Please select role other than current role.');
            } else {
                if ($request->input('role') === 'Faculty Admin') {
                    //to faculty admin
                    //find user id
                    $tmpUser = FacultyStaff::find($currentUser->id);

                    //add to faculty admin
                    $newFacultyAdmin = new FacultyAdmin();
                    $newFacultyAdmin->id = $currentUser->id;
                    $newFacultyAdmin->user_id = $currentUser->id;
                    $newFacultyAdmin->name = $tmpUser->name;
                    $newFacultyAdmin->faculty_id = $tmpUser->faculty_id;
                    $newFacultyAdminSaved = $newFacultyAdmin->save();
                    $currentUser->role = "Faculty Admin";
                    $currentUser->save();

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
                    $newStaff->faculty_id = $tmpUser->faculty_id;
                    $newStaff->specialization = $request->input('specialization');
                    $newStaff->area_of_interest = $request->input('interest');
                    $newStaff->position = $request->input('position');
                    $newStaffSaved = $newStaff->save();
                    $currentUser->role = "Staff";
                    $currentUser->save();

                    //remove user from...
                    $oldUserDeleted = $tmpUser->delete();
                }

                if (($newFacultyAdminSaved || $newStaffSaved) && $oldUserDeleted) {
                    return redirect()->back()->with('updateStatus', true);
                } else {
                    return redirect()->back()->with('updateStatus', false)->withInput();
                }
            }
        }
    }

}
