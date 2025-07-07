@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h2 class="text-2xl font-bold text-white mb-6">Tambah Pembayaran</h2>

    <form action="{{ route('payments.store') }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf

        <!-- Nama Siswa -->
        <div class="mb-4">
            <label for="student_id" class="block font-semibold mb-1">Nama Siswa</label>
            <select name="student_id" id="student_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->student_number }})</option>
                @endforeach
            </select>
        </div>

        <!-- Nama Tagihan -->
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Nama Tagihan</label>
            <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <!-- Jumlah -->
        <div class="mb-4">
            <label for="amount" class="block font-semibold mb-1">Jumlah Pembayaran</label>
            <input type="number" name="amount" id="amount" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <!-- Tanggal Dibayar -->
        <div class="mb-4">
            <label for="paid_at" class="block font-semibold mb-1">Tanggal Pembayaran</label>
            <input type="date" name="paid_at" id="paid_at" class="w-full border border-gray-300 rounded px-3 py-2" required>
        </div>

        <!-- Catatan -->
        <div class="mb-4">
            <label for="notes" class="block font-semibold mb-1">Catatan (opsional)</label>
            <textarea name="notes" id="notes" rows="3" class="w-full border border-gray-300 rounded px-3 py-2"></textarea>
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('payments.index') }}" class="mr-4 text-gray-600 hover:underline">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        </div>
    </form>
</div>
@endsection
