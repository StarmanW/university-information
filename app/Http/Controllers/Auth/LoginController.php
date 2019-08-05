<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * Author: Chong Jia Herng
     * 
     * @var string
     */
//    protected $redirectTo = '/home';
    protected function authenticated(Request $request, $user) {
        if ($user->role === 'Admin') {
            return redirect('/admin/home');
        } else if ($user->role === 'Staff') {
            return redirect('/faculty_staff/programme');
        } else if ($user->role === 'FacultyAdmin') {
            return redirect('/faculty_admin');
        } else {
            return redirect('/login');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

}
