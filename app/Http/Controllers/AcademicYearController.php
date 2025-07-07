<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $sort = $request->get('sort', 'year');
        $direction = $request->get('direction', 'asc');
        $perPage = $request->get('per_page', 10);
    
        $academicYears = AcademicYear::when($search, function ($query) use ($search) {
            return $query->where('year', 'like', '%' . $search . '%');
        })
        ->orderBy($sort, $direction)
        ->paginate($perPage);
    
        return view('academic_years.index', compact('academicYears', 'search'));
    }

    public function create()
    {
        return view('academic_years.create');
    }
        
    public function store(Request $request)
    {
        $request->validate([
            'year' => 'required|string|unique:academic_years,year'
        ]);

        AcademicYear::create($request->all());

        return redirect()->route('academic_years.index')->with('success', 'Tahun ajaran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $academicYear = AcademicYear::findOrFail($id);
        return view('academic_years.show', compact('academicYear'));
    }

    public function edit($id)
    {
        $academicYear = AcademicYear::findOrFail($id);
        return view('academic_years.edit', compact('academicYear'));
    }

    public function update(Request $request, $id)
    {
        $academicYear = AcademicYear::findOrFail($id);
        
        $request->validate([
            'year' => 'required|string|unique:academic_years,year,' . $academicYear->id
        ]);

        $academicYear->update($request->all());

        return redirect()->route('academic_years.index')->with('success', 'Tahun ajaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $academicYear = AcademicYear::findOrFail($id);
        $academicYear->delete();
        
        return redirect()->route('academic_years.index')->with('success', 'Tahun ajaran berhasil dihapus.');
    }
}