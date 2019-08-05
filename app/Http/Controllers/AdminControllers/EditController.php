<?php

namespace App\Http\Controllers\AdminControllers;

use Auth;
use App\User;
use App\Model\Admin;
use App\Model\FacultyStaff;
use App\Model\FacultyAdmin;
use App\CustomClass\CentralValidator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EditController extends Controller {

    /**
     * Where to redirect users after registration.
     *
     * Author: Chong Jia Herng
     * 
     * @var string
     */
    protected $redirectTo = '/admin/home';
    private $validator;

    public function __construct() {
        $this->validator = new CentralValidator();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    //error : not going into validator
//    protected function validator(array $data) {
//        dd($redirectTo);
//        if ($data['role'] === 'Admin') {
//            return $this->validator->validateEditAdmin($data);
//        } else if ($data['role'] === 'Staff') {
//            return $this->validator->validateEditStaff($data);
//        }
//    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create($id) {
        if (Auth::user()->id == $id) {
            return redirect('/admin/home')->with('selectError', 'Please select an appropriate user.');
        } else {
            $user = User::find($id);

            return view('admin.edit-user')->with('user', $user);
        }
    }

    //add validation
    protected function edit(Request $request, $id) {
        $currentUser = User::find($id);
        $validator;
        $userSaved = false;
        $newAdminSaved = false;
        $newStaffSaved = false;
        $newFacultyAdminSaved = false;
        $oldUserDeleted = false;

        if ($request->input('role') === 'Admin') {
            $validator = $this->validator->validateEditAdmin($request);
        } else if ($request->input('role') === 'Staff') {
            $validator = $this->validator->validateEditFacultyStaff($request);
        } else if ($request->input('role') === 'Faculty Admin') {
            $validator = $this->validator->validateEditFacultyAdmin($request->all());
        } else {
            return redirect()->back()->withInput()->with('roleError', 'Please select an appropriate role');
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            //change from admin table to staff, vice versa
            //add verification : check if already admin or staff
            if ($request->input('role') === $currentUser->role) {
                return redirect()->back()->withInput()->with('roleError', 'Please select role other than current role.');
            } else {
                if ($request->input('role') === 'Admin') {
                    //to admin from...
                    //find user id
                    //find user originate from which table using 
                    if ($currentUser->facultyStaffs !== null) {
                        $tmpUser = FacultyStaff::find($currentUser->id);
                    } else if ($currentUser->facultyAdmins !== null) {
                        $tmpUser = FacultyAdmin::find($currentUser->id);
                    } else {
                        dd('aaaa');
                    }

                    //add to admin
                    $newAdmin = new Admin();
                    $newAdmin->id = $currentUser->id;
                    $newAdmin->user_id = $currentUser->id;
                    $newAdmin->name = $tmpUser->name;
                    $newAdminSaved = $newAdmin->save();

                    //remove user from...
                    $oldUserDeleted = $tmpUser->delete();
                } else if ($request->input('role') === 'Staff') {
                    //to staff from...
                    //find user id
                    //find user originate from which table using 
                    if ($currentUser->admins !== 1) {
                        $tmpUser = Admin::find($currentUser->id);
                    } else if ($currentUser->facultyAdmins !== null) {
                        $tmpUser = FacultyAdmin::find($currentUser->id);
                    }

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
                } else if ($request->input('role') === 'Faculty Admin') {
                    //to faculty admin from...
                    //find user id
                    //find user originate from which table using 
                    if ($currentUser->admins !== null) {
                        $tmpUser = Admin::find($currentUser->id);
                    } else if ($currentUser->facultyStaffs !== null) {
                        $tmpUser = FacultyStaff::find($currentUser->id);
                    }

//                    dd($tmpUser);
                    //add to faculty admin
                    $newFacultyAdmin = new FacultyAdmin();
                    $newFacultyAdmin->id = $currentUser->id;
                    $newFacultyAdmin->user_id = $currentUser->id;
                    $newFacultyAdmin->name = $tmpUser->name;
                    $newFacultyAdmin->faculty_id = $request->input('faculty');
                    $newFacultyAdminSaved = $newFacultyAdmin->save();

                    //remove user from...
                    $oldUserDeleted = $tmpUser->delete();
                }

                //update to new role
                $currentUser->role = $request->input('role');
                $userSaved = $currentUser->save();

                if (($userSaved && ($newAdminSaved || $newStaffSaved || $newFacultyAdminSaved)) && $oldUserDeleted) {
                    return redirect('/admin/home');
                } else {
                    return redirect()->back()->with('editUserError', 'Unable to save user data, please try again.');
                }
            }
        }
    }

}
