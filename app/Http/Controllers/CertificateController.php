<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Certificate;
use Illuminate\Support\Facades\Validator;
use App\Model\Programme;
use App\Model\ProgrammeCertificate;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificates = Certificate::all();
        return view('certificates.index')->with('certificates', $certificates);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programmes = Programme::all();
        return view('certificates.create', ['programmes' => $programmes]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate Data
        $validator = Validator::make($request->all(), [
            'cert_name' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[A-z\(\)\-\@\, ]{2,255}$/'],
            'cert_desc' => ['required', 'string', 'min:2', 'regex:/^[\w\W\d\D]+$/'],
        ]);

        // Adding of new certificate
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // Add new certificate
            $certificate = new Certificate();
            $certificate->cert_name = $request->input('cert_name');
            $certificate->cert_desc = $request->input('cert_desc');

            foreach ($request->input('prog_incor') as $prog_id) {
                $progCertificate = new ProgrammeCertificate();
                $progCertificate->prog_id = $prog_id;
                $progCertificate->cert_id = $certificate->id;
                $progCertificate->save();
            }
            
            if ($certificate->save()) {
                return redirect()->back()->with('addStatus', true);
            } else {
                return redirect()->back()->with('addStatus', false)->withInput();
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $certificate = Certificate::find($id);
        $programmes = Programme::all();
        return view('certificates.edit', ['certificate' => $certificate, 'programmes' => $programmes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validate Data
        $validator = Validator::make($request->all(), [
            'cert_name' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[A-z\(\)\-\@\, ]{2,255}$/'],
            'cert_desc' => ['required', 'string', 'min:2', 'regex:/^[\w\W\d\D]+$/'],
        ]);

        // Update of certificate
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // Update of certificate
            $certificate = Certificate::find($id);
            $certificate->cert_name = $request->input('cert_name');
            $certificate->cert_desc = $request->input('cert_desc');

            if ($request->input('prog_incor') !== null) {
                foreach ($certificate->programmeCertificates as $pc) {
                    $pc->delete();
                }
                
                foreach ($request->input('prog_incor') as $prog_id) {
                    $progCertificate = new ProgrammeCertificate();
                    $progCertificate->prog_id = $prog_id;
                    $progCertificate->cert_id = $id;
                    $progCertificate->save();
                }
            }

            if ($certificate->save()) {
                return redirect()->back()->with('updateStatus', true);
            } else {
                return redirect()->back()->with('updateStatus', false)->withInput();
            }
        }
    }
}
