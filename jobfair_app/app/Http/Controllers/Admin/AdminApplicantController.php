<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use Illuminate\Http\Request;

class AdminApplicantController extends Controller
{
    public function index()
    {
        $applicants = Applicant::with(['company', 'position'])->latest()->paginate(15);
        return view('admin.applicants.index', compact('applicants'));
    }

    public function show(Applicant $applicant)
    {
        return view('admin.applicants.show', compact('applicant'));
    }

    public function destroy(Applicant $applicant)
    {
        $applicant->delete();
        return redirect()->route('admin.applicants.index')->with('success', 'Applicant moved to trash.');
    }

    public function trashed()
    {
        $applicants = Applicant::onlyTrashed()->latest()->paginate(15);
        return view('admin.applicants.trashed', compact('applicants'));
    }

    public function restore($id)
    {
        $applicant = Applicant::onlyTrashed()->findOrFail($id);
        $applicant->restore();
        return redirect()->route('admin.applicants.trashed')->with('success', 'Applicant restored successfully.');
    }

    public function forceDelete($id)
    {
        $applicant = Applicant::onlyTrashed()->findOrFail($id);
        $applicant->forceDelete();
        return redirect()->route('admin.applicants.trashed')->with('success', 'Applicant permanently deleted.');
    }
}