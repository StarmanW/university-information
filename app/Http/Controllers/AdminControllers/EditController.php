<?php

namespace App\Http\Controllers\AdminControllers;

use App\User;
use App\Model\Admin;
use App\Model\FacultyStaff;
use App\CustomClass\CentralValidator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EditController extends Controller {

    /**
     * Where to redirect users after registration.
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
        $user = User::find($id);

        return view('admin.edit-user')->with('user', $user);
    }

    //add validation
    protected function edit(Request $request, $id) {
        $user = User::find($id);
        $userAdmin = false;
        $userStaff = false;
        $validator;
        $userAdminDeleted = false;
        $userStaffDeleted = false;
        $userAdminSaved = false;
        $userStaffSaved = false;

        if ($request->input('role') === 'Admin') {
            $validator = $this->validator->validateEditAdmin($request);
        } else if ($request->input('role') === 'Staff') {
            $validator = $this->validator->validateEditStaff($request);
        } else {
            return redirect()->back()->withInput()->with('roleError', 'Please select an appropriate role');
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            //change from admin table to staff, vice versa
            //add verification : check if already admin or staff
            if ($request->input('role') === $user->role) {
                return redirect()->back()->withInput()->with('roleError', 'Please select role other than current role.');
            } else {
                $user->role = $request->input('role');

                if ($request->input('role') === 'Admin') {
                    $userStaff = FacultyStaff::find($user->id);

                    //add to admin
                    $userAdmin = new Admin();
                    $userAdmin->id = $user->id;
                    $userAdmin->user_id = $user->id;
                    $userAdmin->name = $userStaff->name;
                    $userAdminSaved = $userAdmin->save();

                    //remove user from staff
                    $userStaffDeleted = $userStaff->delete();
                } else if ($request->input('role') === 'Staff') {
                    $userAdmin = Admin::find($user->id);

                    //add to staff
                    $userStaff = new FacultyStaff();
                    $userStaff->id = $user->id;
                    $userStaff->user_id = $user->id;
                    $userStaff->name = $userAdmin->name;
                    $userStaff->faculty_id = $request->input('faculty');
                    $userStaff->specialization = $request->input('specialization');
                    $userStaff->area_of_interest = $request->input('interest');
                    $userStaff->position = $request->input('position');
                    $userStaffSaved = $userStaff->save();

                    //remove user from admin
                    $userAdminDeleted = $userAdmin->delete();
                }

                $userSaved = $user->save();
                
                if ( ($userSaved && ($userAdminSaved || $userStaffSaved)) && ($userAdminDeleted || $userStaffDeleted) ) {
                    return redirect('/admin/home');
                } else {
                    return redirect()->back()->withInputs()->with('editUserError', 'Unable to save user data, please try again.');
                }
            }
        }
    }

}
