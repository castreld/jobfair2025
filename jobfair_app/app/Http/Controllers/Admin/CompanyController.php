<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::orderBy('name')->get();
        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:companies,name',
        ]);

        Company::create($request->all());

        return redirect()->route('admin.companies.index')
                         ->with('success', 'Perusahaan berhasil ditambahkan.');
    }

    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:companies,name,' . $company->id,
        ]);

        $company->update($request->all());

        return redirect()->route('admin.companies.index')
                         ->with('success', 'Data perusahaan berhasil diperbarui.');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('admin.companies.index')
                         ->with('success', 'Perusahaan berhasil dihapus.');
    }
}