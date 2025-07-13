<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classroom;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Helpers\SettingHelper;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $activeYearId = SettingHelper::get('default_academic_year_id');

        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);
    
        // Validasi sort field untuk keamanan
        $allowedSorts = ['name', 'student_number', 'birth_place', 'birth_date', 'address', 'created_at', 'classroom', 'academic_year'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }
    
        // Validasi sort direction
        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }
    
        // Validasi per page
        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }
    
        // Query dasar
        $query = Student::query()->with(['classroom', 'academicYear']);
        
        // Filter by active academic year if exists
        if ($activeYearId) {
            $query->where('academic_year_id', $activeYearId);
        }
    
        // Search functionality
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('students.name', 'like', '%' . $search . '%')
                  ->orWhere('students.student_number', 'like', '%' . $search . '%')
                  ->orWhere('students.birth_place', 'like', '%' . $search . '%')
                  ->orWhere('students.address', 'like', '%' . $search . '%')
                  ->orWhereHas('classroom', function($classroomQuery) use ($search) {
                      $classroomQuery->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('academicYear', function($academicYearQuery) use ($search) {
                      $academicYearQuery->where('year', 'like', '%' . $search . '%');
                  });
            });
        }
    
        // Sorting dengan join yang benar
        if ($sort === 'classroom') {
            $query->join('classrooms', 'students.classroom_id', '=', 'classrooms.id')
                ->orderBy('classrooms.name', $direction)
                ->select('students.*');
        } elseif ($sort === 'academic_year') {
            $query->join('academic_years', 'students.academic_year_id', '=', 'academic_years.id')
                ->orderBy('academic_years.year', $direction)
                ->select('students.*');
        } else {
            $query->orderBy($sort, $direction);
        }
    
        // Pagination dengan append semua parameter
        $students = $query->paginate($perPage);
        $students->appends($request->query());
    
        return view('students.index', compact('students', 'search', 'sort', 'direction', 'perPage'));
    }

    public function create()
    {
        $classrooms = Classroom::all();
        $academicYears = AcademicYear::all();
        return view('students.create', compact('classrooms', 'academicYears'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'student_number' => 'required|unique:students,student_number',
            'birth_place' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string|max:500',
            'classroom_name' => 'required|string|max:255',
            'academic_year_name' => 'required|string|max:255',
        ]);

        // Handle Classroom
        $classroom = null;
        if ($request->classroom_id) {
            // Existing classroom selected
            $classroom = Classroom::find($request->classroom_id);
        }
        
        if (!$classroom) {
            // Create new classroom
            $classroom = Classroom::firstOrCreate([
                'name' => $request->classroom_name
            ]);
        }

        // Handle Academic Year
        $academicYear = null;
        if ($request->academic_year_id) {
            // Existing academic year selected
            $academicYear = AcademicYear::find($request->academic_year_id);
        }
        
        if (!$academicYear) {
            // Create new academic year
            $academicYear = AcademicYear::firstOrCreate([
                'year' => $request->academic_year_name
            ]);
        }

        // Create student
        Student::create([
            'name' => $request->name,
            'student_number' => $request->student_number,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'classroom_id' => $classroom->id,
            'academic_year_id' => $academicYear->id,
        ]);

        return redirect()->route('students.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $classrooms = Classroom::all();
        $academicYears = AcademicYear::all();
        return view('students.edit', compact('student', 'classrooms', 'academicYears'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'student_number' => 'required|unique:students,student_number,' . $student->id,
            'birth_place' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string|max:500',
            'classroom_name' => 'required|string|max:255',
            'academic_year_name' => 'required|string|max:255',
        ]);

        // Handle Classroom
        $classroom = null;
        if ($request->classroom_id) {
            $classroom = Classroom::find($request->classroom_id);
        }
        
        if (!$classroom) {
            $classroom = Classroom::firstOrCreate([
                'name' => $request->classroom_name
            ]);
        }

        // Handle Academic Year
        $academicYear = null;
        if ($request->academic_year_id) {
            $academicYear = AcademicYear::find($request->academic_year_id);
        }
        
        if (!$academicYear) {
            $academicYear = AcademicYear::firstOrCreate([
                'year' => $request->academic_year_name
            ]);
        }

        // Update student
        $student->update([
            'name' => $request->name,
            'student_number' => $request->student_number,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'classroom_id' => $classroom->id,
            'academic_year_id' => $academicYear->id,
        ]);

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}