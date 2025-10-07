<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApplicantController extends Controller
{
    
    public function create()
    {
        $companies = Company::orderBy('name')->get();
        return view('form', ['companies' => $companies]);
    }

    
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:applicants,email',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'graduation_year' => 'required|digits:4',
            'student_id_number' => 'nullable|string|max:50',
            'skills' => 'required|string',
            'portfolio_link' => 'nullable|url',
            'personal_summary' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048', 
            'cv' => 'required|file|mimes:pdf|max:10000', 
            'company_id' => 'required|exists:companies,id',
        ]);

        
        $photoPath = $request->file('photo')->store('photos', 'public');
        $cvPath = $request->file('cv')->store('cvs', 'public');

        
        $applicantData = $validatedData;
        $applicantData['uuid'] = Str::uuid();
        $applicantData['photo_path'] = $photoPath;
        $applicantData['cv_path'] = $cvPath;
        unset($applicantData['photo'], $applicantData['cv']); 

        
        $applicant = Applicant::create($applicantData);

        
        return redirect()->route('qr.show', ['uuid' => $applicant->uuid]);
    }

    
    public function showQr($uuid)
    {
        $applicant = Applicant::where('uuid', $uuid)->firstOrFail();
        return view('qr', ['applicant' => $applicant]);
    }

    
    public function show($uuid)
    {
        $applicant = Applicant::where('uuid', $uuid)->firstOrFail();
        return view('profile', ['applicant' => $applicant]);
    }
}