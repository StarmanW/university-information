<?php

namespace App\Http\Controllers\FacultyAdminControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CustomClass\CentralValidator;
use App\Model\FacultyStaff;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class FacultyAdminController extends Controller
{
    private $validator;

    public function __construct()
    {
        $this->validator = new CentralValidator();
    }

    public function index()
    {
        $facultyStaffs = User::where('role', '!=', 'Admin')->where('id', '!=', Auth::user()->id)->get();
        return view('facultyAdmin.index', ['facultyStaffs' => $facultyStaffs]);
    }

    public function showRegisterForm()
    {
        return view('facultyAdmin.register');
    }

    public function register(Request $request)
    {
        $validator = $this->validator->validateRegisterFacultyStaff($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user = new User();
            $user->role = 'Faculty Staff';
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

    public function showEditForm($id)
    {
        $staff = User::find($id);
        return view('facultyAdmin.edit', ['staff' => $staff]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($user->role === 'Faculty Admin') {
            $validator = $this->validator->validateRegisterFacultyStaff($request->all());
        } else {
            $validator = $this->validator->validateRegisterFacultyStaff($request->all());
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $user->email = $request->input('email');
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
                return redirect()->back()->with('updateStatus', true);
            } else {
                return redirect()->back()->with('updateStatus', false)->withInput();
            }
        }
    }
}
