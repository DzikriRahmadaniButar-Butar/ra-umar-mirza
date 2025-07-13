@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h2 class="text-2xl font-bold text-white mb-6">Edit Data Pembayaran</h2>

    <form action="{{ route('payments.update', $payment) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')
        
        <!-- Nama Siswa -->
        <div class="mb-4">
            <label for="student_id" class="block font-semibold mb-1">Nama Siswa</label>
            <div class="relative">
                <input type="text" id="student_search" placeholder="Ketik nama siswa atau nomor siswa..." 
                       class="w-full border border-gray-300 rounded px-3 py-2 pr-8" autocomplete="off">
                <div class="absolute right-2 top-2 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
            <select name="student_id" id="student_id" class="w-full border border-gray-300 rounded px-3 py-2 mt-2" required style="display: none;">
                <option value="">Pilih Siswa</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" data-name="{{ strtolower($student->name) }}" data-number="{{ $student->student_number }}" 
                        {{ (old('student_id') ?? $payment->student_id) == $student->id ? 'selected' : '' }}>
                        {{ $student->name }} ({{ $student->student_number }})
                    </option>
                @endforeach
            </select>
            <div id="student_dropdown" class="absolute z-10 w-full bg-white border border-gray-300 rounded mt-1 max-h-60 overflow-y-auto" style="display: none;">
                <!-- Dropdown items akan diisi oleh JavaScript -->
            </div>
            @error('student_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nama Tagihan -->
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Nama Tagihan</label>
            <input type="text" name="name" id="name" value="{{ old('name') ?? $payment->name }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            @error('name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
            <p class="text-xs text-gray-500 mt-1">Hapus "Bulan ..." sebelum nama tagihan</p>
        </div>

        <!-- Kategori -->
        <div class="mb-4">
            <label for="fee_category_id" class="block font-semibold mb-1">Kategori</label>
            <select id="fee_category_id" name="fee_category_id" class="form-select w-full border border-gray-300 rounded px-3 py-2" data-monthly='@json($monthlyCategoryIds)'>
                <option value="">Pilih Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ (old('fee_category_id') ?? $payment->fee_category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>            
            @error('fee_category_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Bulan -->
        <div id="monthCheckboxGroup" class="mt-4 hidden">
            <label class="block text-sm font-medium text-gray-700">Pilih Bulan</label>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-2 mt-2">
                @for ($i = 1; $i <= 12; $i++)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="months[]" value="{{ $i }}" class="form-checkbox text-blue-600"
                            {{ is_array(old('months', $payment->months ?? [])) && in_array($i, old('months', $payment->months ?? [])) ? 'checked' : '' }}>
                        <span class="ml-2">
                            {{ \Carbon\Carbon::createFromDate(null, $i, 1)->locale('id')->translatedFormat('F') }}
                        </span>
                    </label>
                @endfor
            </div>
            @error('months')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Jumlah -->
        <div class="mb-4">
            <label for="amount" class="block font-semibold mb-1">Jumlah Pembayaran</label>
            <input type="number" name="amount" id="amount" value="{{ old('amount') ?? $payment->amount }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            @error('amount')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tanggal Dibayar - Read Only -->
        <div class="mb-4">
            <label for="paid_at" class="block font-semibold mb-1">Tanggal Pembayaran</label>
            <input type="date" name="paid_at" id="paid_at" 
                value="{{ old('paid_at') ?? ($payment->paid_at ? $payment->paid_at->format('Y-m-d') : now()->format('Y-m-d')) }}" 
                class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100 cursor-not-allowed" 
                readonly required>
            @error('paid_at')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Catatan -->
        <div class="mb-4">
            <label for="notes" class="block font-semibold mb-1">Catatan (opsional)</label>
            <textarea name="notes" id="notes" rows="3" class="w-full border border-gray-300 rounded px-3 py-2">{{ old('notes') ?? $payment->notes }}</textarea>
            @error('notes')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('payments.index') }}" class="mr-4 text-gray-600 hover:underline">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // === HANDLE BULAN ===
        const select = document.getElementById('fee_category_id');
        const monthGroup = document.getElementById('monthCheckboxGroup');
        const monthlyIds = JSON.parse(select.dataset.monthly || '[]');
    
        function checkMonthly() {
            const selectedId = parseInt(select.value);
            if (monthlyIds.includes(selectedId)) {
                monthGroup.classList.remove('hidden');
            } else {
                monthGroup.classList.add('hidden');
            }
        }
    
        select.addEventListener('change', checkMonthly);
        checkMonthly(); // run once on load
    
        // === HANDLE STUDENT SEARCH ===
        const studentSearch = document.getElementById('student_search');
        const studentSelect = document.getElementById('student_id');
        const studentDropdown = document.getElementById('student_dropdown');
        const studentOptions = Array.from(studentSelect.options).slice(1);
    
        // Set initial value for student search field
        const selectedStudent = studentSelect.value;
        if (selectedStudent) {
            const selectedOption = studentOptions.find(opt => opt.value === selectedStudent);
            if (selectedOption) {
                studentSearch.value = selectedOption.text;
            }
        }
    
        studentSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            studentDropdown.innerHTML = '';
    
            if (searchTerm.length === 0) {
                studentDropdown.style.display = 'none';
                return;
            }
    
            const filteredOptions = studentOptions.filter(option => {
                const name = option.dataset.name;
                const number = option.dataset.number;
                return name.includes(searchTerm) || number.includes(searchTerm);
            });
    
            if (filteredOptions.length > 0) {
                filteredOptions.forEach(option => {
                    const div = document.createElement('div');
                    div.className = 'px-3 py-2 hover:bg-gray-100 cursor-pointer';
                    div.textContent = option.text;
                    div.addEventListener('click', function() {
                        studentSearch.value = option.text;
                        studentSelect.value = option.value;
                        studentDropdown.style.display = 'none';
                    });
                    studentDropdown.appendChild(div);
                });
                studentDropdown.style.display = 'block';
            } else {
                studentDropdown.style.display = 'none';
            }
        });
    
        document.addEventListener('click', function(event) {
            if (!studentSearch.contains(event.target) && !studentDropdown.contains(event.target)) {
                studentDropdown.style.display = 'none';
            }
        });
    });
</script>
    
@endsection