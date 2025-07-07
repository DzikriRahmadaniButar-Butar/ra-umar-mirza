@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h2 class="text-2xl font-bold text-white mb-6">Edit Tahun Ajaran</h2>

    <form action="{{ route('academic_years.update', $academicYear->id) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="year" class="block font-semibold mb-1">Tahun Ajaran</label>
            <input type="text" name="year" id="year" value="{{ $academicYear->year }}" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Contoh: 2024/2025" required>
            <small class="text-gray-600">Format: YYYY/YYYY (contoh: 2024/2025)</small>
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('academic_years.index') }}" class="mr-4 text-gray-600 hover:underline">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>
@endsection