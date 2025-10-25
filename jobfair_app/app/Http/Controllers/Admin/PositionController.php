<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Position;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PositionController extends Controller
{
    protected $education_levels = ['SMK/SMA Sederajat', 'D3', 'D4/S1', 'S2'];

    public function index(Company $company)
    {
        $positions = $company->positions()->with('majors')->orderBy('name')->get();
        return view('admin.positions.index', compact('company', 'positions'));
    }

    public function create(Company $company)
    {
        $majors = Major::orderBy('name')->get();
        $education_levels = $this->education_levels;
        $position = new Position();
        return view('admin.positions.create', compact('company', 'majors', 'education_levels', 'position'));
    }

    public function store(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'education_toggle' => 'required|in:ada,tidak',
            'majors_toggle' => 'required|in:ada,tidak',
            'minimum_education' => ['nullable', 'required_if:education_toggle,ada', Rule::in($this->education_levels)],
            'majors' => ['nullable', 'array', 'required_if:majors_toggle,ada'],
            'majors.*' => 'exists:majors,id'
        ]);

        $positionData = [
            'name' => $validated['name'],
            'minimum_education' => $validated['education_toggle'] === 'ada' ? $validated['minimum_education'] : null,
        ];

        $position = $company->positions()->create($positionData);

        if ($validated['majors_toggle'] === 'ada' && !empty($validated['majors'])) {
            $position->majors()->attach($validated['majors']);
        }

        return redirect()->route('admin.companies.positions.index', $company)
                         ->with('success', 'Posisi berhasil ditambahkan.');
    }

    public function edit(Company $company, Position $position)
    {
        $majors = Major::orderBy('name')->get();
        $education_levels = $this->education_levels;
        $position->load('majors');
        return view('admin.positions.edit', compact('company', 'position', 'majors', 'education_levels'));
    }

    public function update(Request $request, Company $company, Position $position)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'education_toggle' => 'required|in:ada,tidak',
            'majors_toggle' => 'required|in:ada,tidak',
            'minimum_education' => ['nullable', 'required_if:education_toggle,ada', Rule::in($this->education_levels)],
            'majors' => ['nullable', 'array', 'required_if:majors_toggle,ada'],
            'majors.*' => 'exists:majors,id'
        ]);

        $positionData = [
            'name' => $validated['name'],
            'minimum_education' => $validated['education_toggle'] === 'ada' ? $validated['minimum_education'] : null,
        ];
        
        $position->update($positionData);

        if ($validated['majors_toggle'] === 'ada' && !empty($validated['majors'])) {
            $position->majors()->sync($validated['majors']);
        } else {
            $position->majors()->sync([]);
        }

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