@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-blue-900 text-gray-100">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-blue-800 pb-4">
        <div class="flex justify-between items-center">
            <div>
                <nav class="flex items-center space-x-2 text-sm text-blue-300 mb-2">
                    <span>Pembayaran</span>
                    <span>></span>
                    <span>Tagihan</span>
                </nav>
                <h1 class="text-2xl font-bold text-white">Daftar Tagihan Siswa</h1>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="p-6">
        <div class="bg-white rounded-lg border border-blue- shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-blue-100 border-b border-blue-800">
                            <th class="text-left px-6 py-3 text-xs font-bold text-blue-700 uppercase">Nama</th>
                            <th class="text-left px-6 py-3 text-xs font-bold text-blue-700 uppercase">Kelas</th>
                            <th class="text-left px-6 py-3 text-xs font-bold text-blue-700 uppercase">Bulanan</th>
                            <th class="text-left px-6 py-3 text-xs font-bold text-blue-700 uppercase">Buku</th>
                            <th class="text-left px-6 py-3 text-xs font-bold text-blue-700 uppercase">Pendaftaran</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-blue-600">
                        @forelse ($students as $student)
                        @php
                            $studentPayments = $payments[$student->id] ?? collect([]);
                        
                            // Cocokkan slug yang BENAR
                            $monthlyPayments = $studentPayments->filter(function($p) {
                                return $p->feeCategory?->slug === 'spp';
                            });
                        
                            $bukuPayments = $studentPayments->filter(function($p) {
                                return $p->feeCategory?->slug === 'buku_pelajaran';
                            });
                        
                            $pendaftaranPayments = $studentPayments->filter(function($p) {
                                return $p->feeCategory?->slug === 'pendaftaran';
                            });
                        
                            // PERBAIKAN: Gunakan logika yang sama dengan search payment
                            $bulanSPP = [
                                7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni'
                            ];
                            
                            // Ambil bulan yang sudah dibayar (berdasarkan field month numerik)
                            $paidMonths = $monthlyPayments->pluck('month')->filter()->toArray();
                            
                            // Cari bulan yang belum dibayar
                            $unpaidMonths = [];
                            foreach ($bulanSPP as $monthNumber => $monthName) {
                                if (!in_array($monthNumber, $paidMonths)) {
                                    $unpaidMonths[] = $monthName;
                                }
                            }
                        
                            // Ambil kategori dan limit
                            $bukuCategory = $categories['buku_pelajaran'] ?? null;
                            $pendCategory = $categories['pendaftaran'] ?? null;
                        
                            $bukuLimit = $bukuCategory->limit_amount ?? 0;
                            $bukuPaid = $bukuPayments->sum('amount');
                        
                            $pendLimit = $pendCategory->limit_amount ?? 0;
                            $pendPaid = $pendaftaranPayments->sum('amount');
                        @endphp
                            <tr class="hover:bg-blue-200 text-sm transition-colors duration-200 text-black">
                                <td class="px-6 py-4">{{ $student->name }}</td>
                                <td class="px-6 py-4">{{ $student->classroom->name ?? '-' }}</td>

                                {{-- Bulanan - DIPERBAIKI --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if (empty($unpaidMonths))
                                        <span class="text-green-600 font-semibold">Lunas</span>
                                    @else
                                        <ul class="list-disc ml-4 text-red-500">
                                            @foreach ($unpaidMonths as $monthName)
                                                <li>{{ $monthName }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>

                                {{-- Buku --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($bukuLimit == 0)
                                        <span class="text-gray-400 italic">-</span>
                                    @elseif ($bukuPaid >= $bukuLimit)
                                        <span class="text-green-600 font-semibold">Lunas</span>
                                    @else
                                        <span class="text-red-500">Sisa: Rp{{ number_format($bukuLimit - $bukuPaid, 0, ',', '.') }}</span>
                                    @endif
                                </td>

                                {{-- Pendaftaran --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($pendLimit == 0)
                                        <span class="text-gray-400 italic">-</span>
                                    @elseif ($pendPaid >= $pendLimit)
                                        <span class="text-green-600 font-semibold">Lunas</span>
                                    @else
                                        <span class="text-red-500">Sisa: Rp{{ number_format($pendLimit - $pendPaid, 0, ',', '.') }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-blue-300">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-blue-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p class="text-sm">Tidak ada data siswa.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection