<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Major;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ApplicantController extends Controller
{
    
    public function create()
    {
        $companies = Company::orderBy('name')->get();
        $majors = Major::orderBy('name')->get();
        return view('form', [
            'companies' => $companies,
            'majors' => $majors
        ]);
    }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:applicants,email',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'address_other' => 'nullable|string|max:255',
            'school_name' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'graduation_year' => 'required|digits:4',
            'last_education' => 'required|string|max:255',
            'skills' => 'required|string',
            'personal_summary' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:10000',
            'cv' => 'required|file|mimes:pdf|max:10000',
            'company_id' => 'required|exists:companies,id',
            'position_id' => 'required|exists:positions,id',
            'portfolio_type' => 'required|in:link,file',
            'portfolio_link' => 'required_if:portfolio_type,link|nullable|url',
            'portfolio_file' => 'required_if:portfolio_type,file|nullable|file|mimes:pdf|max:10000',
        ]);

        $photoPath = $request->file('photo')->store('pictures', 'public');
        $cvPath = $request->file('cv')->store('cvs', 'public');
        
        $applicantData = $validatedData;
        $applicantData['photo_path'] = $photoPath;
        $applicantData['cv_path'] = $cvPath;

        if ($request->input('portfolio_type') === 'file' && $request->hasFile('portfolio_file')) {
            $portfolioPath = $request->file('portfolio_file')->store('portfolios', 'public');
            $applicantData['portfolio_file_path'] = $portfolioPath;
            $applicantData['portfolio_link'] = null;
        } else {
            $applicantData['portfolio_file_path'] = null;
        }

        $zip = new ZipArchive;
        $applicantNameSlug = Str::slug($validatedData['full_name']);
        $zipFileName = 'compressed/' . $applicantNameSlug . '_' . time() . '.zip';
    
        Storage::disk('public')->makeDirectory('compressed');

        if ($zip->open(Storage::disk('public')->path($zipFileName), ZipArchive::CREATE) === TRUE) {
            $zip->addFile(Storage::disk('public')->path($photoPath), 'photo_' . basename($photoPath));
            $zip->addFile(Storage::disk('public')->path($cvPath), 'cv_' . basename($cvPath));
            if (isset($applicantData['portfolio_file_path'])) {
                $zip->addFile(Storage::disk('public')->path($applicantData['portfolio_file_path']), 'portfolio_' . basename($applicantData['portfolio_file_path']));
            }
            $zip->close();
        }
        
        $address = $validatedData['address'];
        if ($address === 'Lainnya' && !empty($validatedData['address_other'])) {
            $address = $validatedData['address_other'];
        }

        $applicantData['uuid'] = Str::uuid();
        $applicantData['applicant_id'] = 'JF-' . mt_rand(100000, 999999);
        $applicantData['zip_path'] = $zipFileName; 
        $applicantData['address'] = $address;

        unset($applicantData['photo'], $applicantData['cv'], $applicantData['address_other'], $applicantData['portfolio_type'], $applicantData['portfolio_file']);
        
        $applicant = Applicant::create($applicantData);

        return redirect()->route('qr.show', ['uuid' => $applicant->uuid])
                         ->with('success', 'Pendaftaran Berhasil!');
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

    public function lookup(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
        ]);

        $identifier = $request->input('identifier');

        $applicant = Applicant::where('applicant_id', $identifier)
                               ->orWhere('email', $identifier)
                               ->first();

        if ($applicant) {
            return redirect()->route('qr.show', ['uuid' => $applicant->uuid]);
        }

        return redirect()->route('applicant.create')
                         ->with('error', 'Data Tidak Ditemukan')
                         ->with('error_subtitle', 'Mungkin anda belum mendaftar? Silahkan daftar terlebih dahulu!');
    }

    public function fetchPositions(Company $company)
    {
        $positions = $company->positions()->with('majors')->get();
        return response()->json($positions);
    }
}