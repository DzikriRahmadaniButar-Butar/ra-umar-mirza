@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h2 class="text-2xl font-bold text-white mb-6">Edit Data Siswa</h2>

    <form action="{{ route('students.update', $student->id) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Nama Lengkap</label>
            <input type="text" name="name" id="name" value="{{ $student->name }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="student_number" class="block font-semibold mb-1">NIS</label>
            <input type="text" name="student_number" id="student_number" value="{{ $student->student_number }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="birth_place" class="block font-semibold mb-1">Tempat Lahir</label>
            <input type="text" name="birth_place" id="birth_place" value="{{ $student->birth_place }}" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="birth_date" class="block font-semibold mb-1">Tanggal Lahir</label>
            <input type="date" name="birth_date" id="birth_date" value="{{ $student->birth_date }}" class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="address" class="block font-semibold mb-1">Alamat</label>
            <textarea name="address" id="address" rows="3" class="w-full border border-gray-300 rounded px-3 py-2">{{ $student->address }}</textarea>
        </div>

        <div class="mb-4">
            <label for="classroom" class="block font-semibold mb-1">Kelas</label>
            <div class="relative">
                <input type="text" 
                       name="classroom_name" 
                       id="classroom_input" 
                       class="w-full border border-gray-300 rounded px-3 py-2 pr-10" 
                       placeholder="Ketik nama kelas atau pilih dari dropdown" 
                       autocomplete="off"
                       value="{{ $student->classroom->name ?? '' }}"
                       required>
                <input type="hidden" name="classroom_id" id="classroom_id" value="{{ $student->classroom_id }}">
                <button type="button" id="classroom_dropdown_btn" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="classroom_dropdown" class="absolute z-10 w-full bg-white border border-gray-300 rounded mt-1 max-h-40 overflow-y-auto hidden">
                    @foreach($classrooms as $class)
                        <div class="classroom-option px-3 py-2 hover:bg-gray-100 cursor-pointer" 
                             data-id="{{ $class->id }}" 
                             data-name="{{ $class->name }}">
                            {{ $class->name }}
                        </div>
                    @endforeach
                </div>
            </div>
            <small class="text-gray-600">Jika kelas belum ada, ketik nama kelas baru</small>
        </div>

        <div class="mb-4">
            <label for="academic_year" class="block font-semibold mb-1">Tahun Ajaran</label>
            <div class="relative">
                <input type="text" 
                       name="academic_year_name" 
                       id="academic_year_input" 
                       class="w-full border border-gray-300 rounded px-3 py-2 pr-10" 
                       placeholder="Ketik tahun ajaran atau pilih dari dropdown" 
                       autocomplete="off"
                       value="{{ $student->academicYear->year ?? '' }}"
                       required>
                <input type="hidden" name="academic_year_id" id="academic_year_id" value="{{ $student->academic_year_id }}">
                <button type="button" id="academic_year_dropdown_btn" class="absolute right-2 top-2 text-gray-500 hover:text-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div id="academic_year_dropdown" class="absolute z-10 w-full bg-white border border-gray-300 rounded mt-1 max-h-40 overflow-y-auto hidden">
                    @foreach($academicYears as $year)
                        <div class="academic-year-option px-3 py-2 hover:bg-gray-100 cursor-pointer" 
                             data-id="{{ $year->id }}" 
                             data-name="{{ $year->year }}">
                            {{ $year->year }}
                        </div>
                    @endforeach
                </div>
            </div>
            <small class="text-gray-600">Jika tahun ajaran belum ada, ketik tahun ajaran baru (contoh: 2024/2025)</small>
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('students.index') }}" class="mr-4 text-gray-600 hover:underline">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Classroom functionality
    const classroomInput = document.getElementById('classroom_input');
    const classroomId = document.getElementById('classroom_id');
    const classroomDropdown = document.getElementById('classroom_dropdown');
    const classroomDropdownBtn = document.getElementById('classroom_dropdown_btn');
    const classroomOptions = document.querySelectorAll('.classroom-option');

    // Academic Year functionality
    const academicYearInput = document.getElementById('academic_year_input');
    const academicYearId = document.getElementById('academic_year_id');
    const academicYearDropdown = document.getElementById('academic_year_dropdown');
    const academicYearDropdownBtn = document.getElementById('academic_year_dropdown_btn');
    const academicYearOptions = document.querySelectorAll('.academic-year-option');

    // Generic function to handle dropdown functionality
    function setupDropdown(input, hiddenInput, dropdown, dropdownBtn, options) {
        // Toggle dropdown
        dropdownBtn.addEventListener('click', function() {
            dropdown.classList.toggle('hidden');
        });

        // Handle option selection
        options.forEach(option => {
            option.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                
                input.value = name;
                hiddenInput.value = id;
                dropdown.classList.add('hidden');
            });
        });

        // Filter options based on input
        input.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            
            // Only clear hidden input if the current value doesn't match any existing option
            let matchFound = false;
            options.forEach(option => {
                const optionText = option.getAttribute('data-name').toLowerCase();
                if (optionText === searchTerm) {
                    matchFound = true;
                    hiddenInput.value = option.getAttribute('data-id');
                }
            });
            
            // Clear hidden input only if no exact match found
            if (!matchFound) {
                hiddenInput.value = '';
            }
            
            // Filter visible options
            options.forEach(option => {
                const optionText = option.getAttribute('data-name').toLowerCase();
                if (optionText.includes(searchTerm)) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
            
            // Show dropdown when typing
            if (searchTerm.length > 0) {
                dropdown.classList.remove('hidden');
            }
        });

        // Hide dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!input.contains(event.target) && 
                !dropdown.contains(event.target) && 
                !dropdownBtn.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    }

    // Setup both dropdowns
    setupDropdown(classroomInput, classroomId, classroomDropdown, classroomDropdownBtn, classroomOptions);
    setupDropdown(academicYearInput, academicYearId, academicYearDropdown, academicYearDropdownBtn, academicYearOptions);
});
</script>
@endsection