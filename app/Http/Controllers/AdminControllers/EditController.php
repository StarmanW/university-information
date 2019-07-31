<?php

namespace App\Http\Controllers\AdminControllers;

use App\User;
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return $this->validator->validateEditUser($data);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
        $user = User::find($id);

        return view('admin.edit-user')->with($user);
    }

    protected function edit(Request $request) {
        $user = User::find($request->input(id));
        $user->role = $request->input('role');

        if ($user->save()) {
            return redirect('/admin/home');
        } else {
            return redirect()->back()->withInputs()->withErrors();
        }
    }

}
