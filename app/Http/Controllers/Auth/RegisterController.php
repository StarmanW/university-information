<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Model\Faculty;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        if ($data['role'] === 'Admin') {
            return Validator::make($data, [
                        'name' => ['required', 'string', 'regex:/^[A-z\(\)\-\@\ ]{1,255}$/'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                        'role' => ['required', 'string', Rule::in(['Admin'])]
            ]);
        } else if ($data['role'] === 'Staff') {
            if (Faculty::where('faculty_name', '=', $data['faculty'])->first()) {
                return Validator::make($data, [
                            'name' => ['required', 'string', 'regex:/^[A-z\(\)\-\@\ ]{1,255}$/'],
                            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                            'password' => ['required', 'string', 'min:8', 'confirmed'],
                            //problem
                            'role' => ['required', 'string', Rule::in(['Staff'])],
                            //problem
                            'faculty' => ['required', 'string', 'regex:/^[A-z\(\)\-\@\, ]{2,255}$/'],
                            'specialization' => ['nullable', 'string', 'regex:/^[A-z\(\)\-\@\, ]{0,255}$/'],
                            'interest' => ['nullable', 'string', 'regex:/^[A-z\(\)\-\@\, ]{0,255}$/'],
                            'position' => ['required', 'string', Rule::in(['Dean', 'Lecturer', 'Tutor'])]
                ]);
            } else {
                //problem
                return redirect()->back()->with('addStatus', false);
            }
        }


        //mk validator for staff
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
        $user = User::create([request(),
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'role' => $data['role'],
        ]);


//        if($data) {
//            new Admin
//            save
//        }
        return $user;
    }

}
