<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Model\Admin;
use App\Model\FacultyStaff;
use App\Model\Faculty;
use App\Http\Controllers\Controller;
use App\CustomClass\CentralValidator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rule;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';
    private $centralValidator;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('RedirectAdmin');
        $this->centralValidator = new CentralValidator();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        if ($data['role'] === 'Admin') {
            return $this->centralValidator->validateRegisterAdmin($data);
        } else if ($data['role'] === 'Staff') {
            return $this->centralValidator->validateRegisterStaff($data);
        } else {
            return redirect()->back()->withInput()->with('roleError', 'Please select an appropriate role');
        }
    }

    public function register(Request $request) {
        if ($request->input('role') === 'Admin' || $request->input('role') === 'Staff') {
            $this->validator($request->all())->validate();

            event(new Registered($user = $this->create($request->all())));

            $this->guard()->login($user);

            return $this->registered($request, $user) ?: redirect($this->redirectPath());
        } else {
            return redirect()->back();
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
        $user;
        $userAdmin;
        $userStaff;

        $user = new User();
        $user->role = $data['role'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $userSaved = $user->save();

        if ($data['role'] === 'Admin') {
            $userAdmin = new Admin();
            $userAdmin->id = $user->id;
            $userAdmin->user_id = $user->id;
            $userAdmin->name = $data['name'];
            $userAdminSaved = $userAdmin->save();
        } elseif ($data['role'] === 'Staff') {
            $userStaff = new FacultyStaff();
            $userStaff->id = $user->id;
            $userStaff->user_id = $user->id;
            $userStaff->name = $data['name'];
            $userStaff->faculty_id = $data['faculty'];
            $userStaff->specialization = $data['specialization'];
            $userStaff->area_of_interest = $data['interest'];
            $userStaff->position = $data['position'];
            $userStaffSaved = $userStaff->save();
        } else {
            return redirect()->back()->withInput()->with('roleError', 'Please select an appropriate role');
        }

        if ($userSaved) {
            return $user;
        } else {
            return redirect()->back()->withInput()->with('registerUserError', 'Unable to save user data, please try again.');
        }
    }

}
