<?php

namespace App\CustomClass;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CentralValidator
 *
 * @author sein
 */
class CentralValidator {

    private $validationRules;

    public function __construct() {
        $this->validationRules = [
            //general
            'textWithSymbols' => ['required', 'string', 'regex:/^[A-z\(\)\-\@\,\& ]{0,255}$/'],
            'name' => ['required', 'string', 'regex:/^[A-z\(\)\-\@\ ]{1,255}$/'],
            'numeric' => ['required', 'numeric'],
            'numericDigitFour' => ['required', 'integer', 'min:1', 'max:4', 'regex:/^[1-4]$/'],
            //login & registration
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roleAdmin' => ['required', 'string', Rule::in(['Admin'])],
            'roleStaff' => ['required', 'string', Rule::in(['Staff'])],
            'roleAdminOrStaff' => ['required', 'string',  Rule::in(['Admin', 'Staff'])],
            'faculty' => ['required', 'string', 'exists:faculties,id', 'regex:/^[A-z]{4}$/'],
            'position' => ['required', 'string', Rule::in(['Dean', 'Lecturer', 'Tutor'])],
            //course
            'course_id' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[A-Z\-]{4}\d{4}$/'],
//            'course_name' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[A-z\(\)\-\@\, ]{2,255}$/'],
//            'course_desc' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[\w\W\d\D]+$/'],
//            'course_cred_hour' => ['required', 'string', 'min:1', 'max:4', 'regex:/^[1-4]$/'],
//            'course_fee' => ['required', 'numeric'],
            //programme
            'prog_id' => ['required', 'string', 'max:3', 'regex:/^[A-Z]{3}$/', 'unique:programmes,id'],
//            'prog_name' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[A-z\(\)\-\@\, ]{2,255}$/'],
//            'prog_desc' => ['required', 'string', 'min:2', 'regex:/^[\w\W\d\D]+$/'],
//            'prog_mer' => ['required', 'string', 'min:2', 'regex:/^[\w\W\d\D]+$/'],
//            'prog_duration' => 'required|integer|min:1|max:4',
            'prog_level' => 'required', 'string', 'regex:/^(Diploma|Bachelor Degree|Master|Doctorate \(PhD\))$/'
        ];
    }

    public function validateRegisterAdmin($data) {
        return Validator::make($data, [
                    'name' => $this->validationRules['name'],
                    'email' => $this->validationRules['email'],
                    'password' => $this->validationRules['password'],
                    'role' => $this->validationRules['roleAdmin']
        ]);
    }

    public function validateRegisterStaff($data) {
        return Validator::make($data, [
                    'name' => $this->validationRules['name'],
                    'email' => $this->validationRules['email'],
                    'password' => $this->validationRules['password'],
                    'role' => $this->validationRules['roleAdmin'],
                    'faculty' => $this->validationRules['faculty'],
                    'specialization' => $this->validationRules['textWithSymbols'],
                    'interest' => $this->validationRules['textWithSymbols'],
                    'position' => $this->validationRules['textWithSymbols']
        ]);
    }
    
    public function validateEditUser($data) {
        return Validator::make($data, [
            'id' => $this->validationRules['numeric'],
            'role' => $this->validationRules['roleAdminOrStaff']
        ]);
    }

}
