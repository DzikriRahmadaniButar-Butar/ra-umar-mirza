@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-blue-100 px-4 py-12">
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg text-gray-800">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-700 mb-2">DATA PEMBAYARAN</h1>
            <h2 class="text-lg font-semibold text-gray-600">Lembaga Pendidikan Umar Mirza</h2>
        </div>
        
        <!-- Form Pencarian -->
        <form method="POST" action="{{ route('search.payment') }}" class="mb-8">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Masukkan NIPD Siswa:</label>
                    <input type="text" name="nis" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                           placeholder="Contoh: S001" 
                           value="{{ request('nis') }}"
                           required>
                </div>
                <div class="flex items-end">
                    <button type="submit" 
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200 font-medium">
                        Cari Pembayaran
                    </button>
                </div>
            </div>
        </form>

        @if(isset($student))
            @if($student)
                <!-- Data Siswa -->
                <div class="bg-gray-50 p-6 rounded-lg mb-8">
                    <h3 class="text-lg font-bold text-gray-700 mb-4">Data Peserta Didik</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p><span class="font-medium">Nama Peserta Didik:</span> {{ $student->name }}</p>
                            <p><span class="font-medium">No. Induk Peserta Didik:</span> {{ $student->student_number }}</p>
                        </div>
                        <div>
                            <p><span class="font-medium">Kelas:</span> {{ $student->classroom->name ?? 'Tidak ada kelas' }}</p>
                            <p><span class="font-medium">Alamat:</span> {{ $student->address ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                @php
                    // Kelompokkan pembayaran berdasarkan fee_category
                    $pendaftaran = $student->payments->filter(function($payment) {
                        return $payment->feeCategory && 
                            !$payment->feeCategory->is_monthly && 
                            $payment->feeCategory->slug === 'pendaftaran';
                    });
                    
                    $bukuPelajaran = $student->payments->filter(function($payment) {
                        return $payment->feeCategory && 
                            !$payment->feeCategory->is_monthly && 
                            $payment->feeCategory->slug === 'buku_pelajaran';
                    });
                    
                    $spp = $student->payments->filter(function($payment) {
                        return $payment->feeCategory && $payment->feeCategory->is_monthly;
                    });
                    
                    // Untuk SPP, buat array bulan sesuai tahun ajaran (Juli-Juni)
                    $bulanSPP = [
                        7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
                        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni'
                    ];
                    
                    // Dapatkan fee category untuk SPP
                    $sppFeeCategory = \App\Models\FeeCategory::where('is_monthly', true)->first();
                    $sppAmount = $sppFeeCategory ? $sppFeeCategory->amount : 150000;
                @endphp

                <!-- Tabel Pendaftaran -->
                <div class="mb-8">
                    <h4 class="text-lg font-bold text-gray-700 mb-4">PENDAFTARAN & BIAYA LAIN</h4>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-400">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-400 px-1 py-1 text-left">No.</th>
                                    <th class="border border-gray-400 px-4 py-2 text-left">Tanggal</th>
                                    <th class="border border-gray-400 px-4 py-2 text-left">Keterangan</th>
                                    <th class="border border-gray-400 px-4 py-2 text-left">Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $nomorUrut = 1; @endphp
                                @forelse($pendaftaran as $payment)
                                <tr>
                                    <td class="border border-gray-400 px-1 py-1">{{ $nomorUrut++ }}</td>
                                    <td class="border border-gray-400 px-4 py-2">{{ $payment->paid_at ? \Carbon\Carbon::parse($payment->paid_at)->format('d/m/Y') : '-' }}</td>
                                    <td class="border border-gray-400 px-4 py-2">{{ $payment->name }}</td>
                                    <td class="border border-gray-400 px-4 py-2">Rp{{ number_format($payment->amount, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="border border-gray-400 px-1 py-1">1</td>
                                    <td class="border border-gray-400 px-4 py-2">-</td>
                                    <td class="border border-gray-400 px-4 py-2">-</td>
                                    <td class="border border-gray-400 px-4 py-2">-</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tabel Buku Pelajaran -->
                <div class="mb-8">
                    <h4 class="text-lg font-bold text-gray-700 mb-4">BUKU PELAJARAN</h4>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-400">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-400 px-1 py-1 text-left">No.</th>
                                    <th class="border border-gray-400 px-4 py-2 text-left">Tanggal</th>
                                    <th class="border border-gray-400 px-4 py-2 text-left">Keterangan</th>
                                    <th class="border border-gray-400 px-4 py-2 text-left">Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $nomorUrutBuku = 1; @endphp
                                @forelse($bukuPelajaran as $payment)
                                <tr>
                                    <td class="border border-gray-400 px-1 py-1">{{ $nomorUrutBuku++ }}</td>
                                    <td class="border border-gray-400 px-4 py-2">{{ $payment->paid_at ? \Carbon\Carbon::parse($payment->paid_at)->format('d/m/Y') : '-' }}</td>
                                    <td class="border border-gray-400 px-4 py-2">{{ $payment->name }}</td>
                                    <td class="border border-gray-400 px-4 py-2">Rp{{ number_format($payment->amount, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="border border-gray-400 px-1 py-1">1</td>
                                    <td class="border border-gray-400 px-4 py-2">-</td>
                                    <td class="border border-gray-400 px-4 py-2">-</td>
                                    <td class="border border-gray-400 px-4 py-2">-</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tabel SPP -->
                <div class="mb-8">
                    <h4 class="text-lg font-bold text-gray-700 mb-4">SPP</h4>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-400">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-400 px-1 py-1 text-left">No.</th>
                                    <th class="border border-gray-400 px-4 py-2 text-left">Tanggal</th>
                                    <th class="border border-gray-400 px-4 py-2 text-left">Bulan</th>
                                    <th class="border border-gray-400 px-4 py-2 text-left">Nominal</th>
                                    <th class="border border-gray-400 px-4 py-2 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bulanSPP as $monthNumber => $bulan)
                                @php
                                    $paymentBulan = $spp->where('month', $monthNumber)->first();
                                    $index = array_search($monthNumber, array_keys($bulanSPP));
                                @endphp
                                <tr>
                                    <td class="border border-gray-400 px-1 py-1">{{ $index + 1 }}</td>
                                    <td class="border border-gray-400 px-4 py-2">
                                        {{ $paymentBulan ? \Carbon\Carbon::parse($paymentBulan->paid_at)->format('d/m/Y') : '-' }}
                                    </td>
                                    <td class="border border-gray-400 px-4 py-2">{{ $bulan }}</td>
                                    <td class="border border-gray-400 px-4 py-2">
                                        {{ $paymentBulan ? 'Rp' . number_format($paymentBulan->amount, 0, ',', '.') : 'Rp -' }}
                                    </td>
                                    <td class="border border-gray-400 px-2 py-1">
                                        @if($paymentBulan && $paymentBulan->amount >= $sppAmount)
                                            <span class="text-green-600 text-xs font-semibold">Lunas</span>
                                        @elseif($paymentBulan && $paymentBulan->amount > 0 && $paymentBulan->amount < $sppAmount)
                                            <div class="text-xs">
                                                <span class="text-blue-600">Sudah Bayar: Rp {{ number_format($paymentBulan->amount, 0, ',', '.') }}</span><br>
                                                <span class="text-red-600">Sisa: Rp {{ number_format($sppAmount - $paymentBulan->amount, 0, ',', '.') }}</span>
                                            </div>
                                        @else
                                            <span class="text-red-600 text-xs">Belum Bayar</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Ringkasan Pembayaran -->
                <div class="bg-blue-50 p-6 rounded-lg">
                    <h4 class="text-lg font-bold text-gray-700 mb-4">Ringkasan Pembayaran</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="text-center p-4 bg-white rounded-lg shadow">
                            <h5 class="font-semibold text-gray-700">Total Pendaftaran & Biaya Lain</h5>
                            <p class="text-xl font-bold text-blue-600">
                                Rp{{ number_format($pendaftaran->sum('amount'), 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="text-center p-4 bg-white rounded-lg shadow">
                            <h5 class="font-semibold text-gray-700">Total Buku Pelajaran</h5>
                            <p class="text-xl font-bold text-purple-600">
                                Rp{{ number_format($bukuPelajaran->sum('amount'), 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="text-center p-4 bg-white rounded-lg shadow">
                            <h5 class="font-semibold text-gray-700">Total SPP</h5>
                            <p class="text-xl font-bold text-green-600">
                                Rp{{ number_format($spp->sum('amount'), 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h5 class="font-semibold text-gray-700">Total Keseluruhan</h5>
                            <p class="text-2xl font-bold text-red-600">
                                Rp{{ number_format($student->payments->sum('amount'), 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Tombol Cetak dan Unduh -->
                <div class="mt-6 flex flex-col md:flex-row justify-center gap-4">
                    <a href="{{ route('print.kartu-pembayaran', $student->id) }}" target="_blank"
                       class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg shadow transition text-center">
                        Lihat Kartu Pembayaran (PDF)
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-red-700 mb-2">Data Tidak Ditemukan</h3>
                        <p class="text-red-600">Siswa dengan NIPD tersebut tidak ditemukan dalam database.</p>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection