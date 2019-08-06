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
 * @author Chong Jia Herng
 */
class CentralValidator {

    private $validationRules;

    public function __construct() {
        $this->validationRules = [
            //general
            'textWithSymbols' => ['required', 'string', 'regex:/^[\w\W\d\D][^\<\>]+$/'],
            'name' => ['required', 'string', 'regex:/^[A-z\(\)\-\@\ ]{1,255}$/'],
            'numeric' => ['required', 'numeric'],
            'numericDigitFour' => ['required', 'integer', 'min:1', 'max:4', 'regex:/^[1-4]$/'],
            //login & registration
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'roleAdmin' => ['required', 'string', Rule::in(['Admin'])],
            'roleStaff' => ['required', 'string', Rule::in(['Staff'])],
            'roleFacultyAdmin' => ['required', 'string', Rule::in(['Faculty Admin'])],
            'roleAll' => ['required', 'string', Rule::in(['Admin', 'Staff', 'Faculty Admin'])],
            'faculty' => ['required', 'string', 'exists:faculties,id', 'regex:/^[A-z]{4}$/'],
            'position' => ['required', 'string', Rule::in(['Dean', 'Lecturer', 'Tutor'])],
            //course
            'course_id' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[A-Z\-]{4}\d{4}$/'],
            //programme
            'prog_id' => ['required', 'string', 'max:3', 'regex:/^[A-Z]{3}$/', 'unique:programmes,id'],
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

    public function validateRegisterFacultyStaff($data) {
        return Validator::make($data, [
                    'name' => $this->validationRules['name'],
                    'email' => $this->validationRules['email'],
                    'password' => $this->validationRules['password'],
                    'specialization' => $this->validationRules['textWithSymbols'],
                    'interest' => $this->validationRules['textWithSymbols'],
                    'position' => $this->validationRules['position']
        ]);
    }

    public function validateRegisterFacultyAdmin($data) {
        return Validator::make($data, [
                    'name' => $this->validationRules['name'],
                    'email' => $this->validationRules['email'],
                    'password' => $this->validationRules['password'],
                    'role' => $this->validationRules['roleFacultyAdmin'],
                    'faculty' => $this->validationRules['faculty'],
        ]);
    }

    public function validateEditAdmin($request) {
        return Validator::make($request->all(), [
                    'id' => $this->validationRules['numeric'],
                    'role' => $this->validationRules['roleAdmin']
        ]);
    }

    public function validateEditFacultyStaff($request) {
        return Validator::make($request->all(), [
                    'id' => $this->validationRules['numeric'],
                    'faculty' => $this->validationRules['faculty'],
                    'role' => $this->validationRules['roleStaff'],
                    'specialization' => $this->validationRules['textWithSymbols'],
                    'interest' => $this->validationRules['textWithSymbols'],
                    'position' => $this->validationRules['position']
        ]);
    }

    public function validateEditFacultyStaffFA($request) {
        return Validator::make($request->all(), [
                    'id' => $this->validationRules['numeric'],
                    'role' => $this->validationRules['roleStaff'],
                    'specialization' => $this->validationRules['textWithSymbols'],
                    'interest' => $this->validationRules['textWithSymbols'],
                    'position' => $this->validationRules['position']
        ]);
    }

    public function validateEditFacultyAdmin($data) {
        return Validator::make($data, [
                    'id' => $this->validationRules['numeric'],
                    'role' => $this->validationRules['roleFacultyAdmin'],
                    'faculty' => $this->validationRules['faculty'],
        ]);
    }

    public function validateEditFacultyAdminFA($data) {
        return Validator::make($data, [
                    'id' => $this->validationRules['numeric'],
                    'role' => $this->validationRules['roleFacultyAdmin'],
        ]);
    }

    public function validateRegisterProgramme($request) {
        return Validator::make($request->all(), [
                    'prog_id' => $this->validationRules['prog_id'],
                    'prog_name' => $this->validationRules['textWithSymbols'],
                    'prog_desc' => $this->validationRules['textWithSymbols'],
                    'prog_mer' => $this->validationRules['textWithSymbols'],
                    'prog_duration' => $this->validationRules['numericDigitFour'],
                    'prog_level' => $this->validationRules['prog_level']
        ]);
    }

    public function validateEditProgramme($request) {
        return Validator::make($request->all(), [
                    'prog_name' => $this->validationRules['textWithSymbols'],
                    'prog_desc' => $this->validationRules['textWithSymbols'],
                    'prog_mer' => $this->validationRules['textWithSymbols'],
                    'prog_duration' => $this->validationRules['numericDigitFour'],
                    'prog_level' => $this->validationRules['prog_level']
        ]);
    }

    public function valdiateRegisterCourse($request) {
        return Validator::make($request->all(), [
                    'course_id' => $this->validationRules['course_id'],
                    'course_name' => $this->validationRules['textWithSymbols'],
                    'course_desc' => $this->validationRules['textWithSymbols'],
                    'course_cred_hour' => $this->validationRules['numericDigitFour'],
                    'course_fee' => $this->validationRules['numeric'],
        ]);
    }

    public function valdiateEditCourse($request) {
        return Validator::make($request->all(), [
                    'course_name' => $this->validationRules['textWithSymbols'],
                    'course_desc' => $this->validationRules['textWithSymbols'],
                    'course_cred_hour' => $this->validationRules['numericDigitFour'],
                    'course_fee' => $this->validationRules['numeric'],
        ]);
    }

    public function validateCertificate($request) {
        return Validator::make($request->all(), [
                    'cert_name' => $this->validationRules['textWithSymbols'],
                    'cert_desc' => $this->validationRules['textWithSymbols'],
        ]);
    }

}
