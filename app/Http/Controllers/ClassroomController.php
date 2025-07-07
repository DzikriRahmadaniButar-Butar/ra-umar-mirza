<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom;

class ClassroomController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');
        $perPage = $request->get('per_page', 10);
    
        $classrooms = Classroom::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })
        ->orderBy($sort, $direction)
        ->paginate($perPage);
    
        return view('classrooms.index', compact('classrooms', 'search'));
    }

    public function create()
    {
        return view('classrooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:classrooms,name'
        ]);

        Classroom::create($request->all());

        return redirect()->route('classrooms.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function show($id)
    {
        $classroom = Classroom::findOrFail($id);
        return view('classrooms.show', compact('classroom'));
    }

    public function edit($id)
    {
        $classroom = Classroom::findOrFail($id);
        return view('classrooms.edit', compact('classroom'));
    }

    public function update(Request $request, $id)
    {
        $classroom = Classroom::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:classrooms,name,' . $classroom->id
        ]);

        $classroom->update($request->all());

        return redirect()->route('classrooms.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->delete();
        
        return redirect()->route('classrooms.index')->with('success', 'Kelas berhasil dihapus.');
    }
}