<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index(Company $company)
    {
        $positions = $company->positions()->orderBy('name')->get();
        return view('admin.positions.index', compact('company', 'positions'));
    }

    public function create(Company $company)
    {
        return view('admin.positions.create', compact('company'));
    }

    public function store(Request $request, Company $company)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $company->positions()->create($request->only('name'));

        return redirect()->route('admin.companies.positions.index', $company)
                         ->with('success', 'Posisi berhasil ditambahkan.');
    }

    public function edit(Company $company, Position $position)
    {
        return view('admin.positions.edit', compact('company', 'position'));
    }

    public function update(Request $request, Company $company, Position $position)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $position->update($request->only('name'));

        return redirect()->route('admin.companies.positions.index', $company)
                         ->with('success', 'Posisi berhasil diperbarui.');
    }

    public function destroy(Company $company, Position $position)
    {
        $position->delete();

        return redirect()->route('admin.companies.positions.index', $company)
                         ->with('success', 'Posisi berhasil dihapus.');
    }
}