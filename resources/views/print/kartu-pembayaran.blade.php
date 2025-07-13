<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Pembayaran</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; margin: 20px; }
        .table { border-collapse: collapse; width: 100%; }
        .table td, .table th { border: 1px solid black; padding: 4px; }
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
        .text-lg { font-size: 14px; }
        .text-xl { font-size: 20px; }
        .mt-4 { margin-top: 1rem; }
        .mt-3 { margin-top: 0.75rem; }
        .mt-2 { margin-top: 0.5rem; }
        .mt-1 { margin-top: 0.25rem; }
        .info-table td { padding: 4px; vertical-align: top; }
        .info-table td:first-child { width: 180px; }
        .dotted-line { border-bottom: 1px dotted black; min-height: 20px; display: inline-block; width: 100%; }
        .total { background-color: #c2c2c2; }
        .w-full { width: 100%; }
    </style>
</head>
<body>
    <div class="text-center">
        <table class="w-full">
            <tr>
                <td width="0%" style="vertical-align: middle;">
                    <img src="{{ public_path('images/logobw.png') }}" alt="Logo" height="80">
                </td>
                <td width="100%" style="vertical-align: middle;">
                    <div class="text-bold text-lg">LEMBAGA PENDIDIKAN</div>
                    <div class="text-bold text-xl">UMAR MIRZA</div>
                    <div>JL. Balai Desa Ujung, Gg. Bunga/Gg. Lapangan No.81<br>Desa Marindal II, Kecamatan Patumbak - 20361<br>Kabupaten Deli Serdang, Sumatera Utara<br>Telp. 0811641690 - 082167777712 - 081375757408<br>Email : ra.umarmirza@gmail.com</div>
                </td>
            </tr>
        </table>
        <div class="text-bold text-xl mt-1">KARTU PEMBAYARAN</div>
    </div>

    <div class="mt-3">
        <table class="info-table" style="width: 100%;">
            <tr>
                <td style="width: 180px;">Nama Peserta Didik</td>
                <td style="width: 10px;">:</td>
                <td><span class="dotted-line">{{ $student->name }}</span></td>
            </tr>
            <tr>
                <td>No. Induk Peserta Didik</td>
                <td>:</td>
                <td><span class="dotted-line">{{ $student->student_number }}</span></td>
            </tr>
            <tr>
                <td>Tempat Tanggal Lahir</td>
                <td>:</td>
                <td><span class="dotted-line">{{ $student->birth_place }}{{ $student->birth_date ? ', ' . \Carbon\Carbon::parse($student->birth_date)->format('d-m-Y') : '' }}</span></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><span class="dotted-line">{{ $student->address }}</span></td>
            </tr>
        </table>
    </div>

    <!-- PENDAFTARAN -->
    <div class="mt-4">
        <div class="text-bold">PENDAFTARAN</div>
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Nominal</th>
                    <th>Paraf</th>
                </tr>
            </thead>
            <tbody>
                @if($pendaftaran->isNotEmpty())
                    @foreach($pendaftaran as $i => $payment)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td class="text-center">{{ $payment->paid_at ? $payment->paid_at->format('d/m/Y') : '-' }}</td>
                            <td>{{ $payment->name }}</td>
                            <td style="text-align: right;">Rp{{ number_format($payment->amount, 0, ',', '.') }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">-</td>
                        <td>-</td>
                        <td style="text-align: right;">-</td>
                        <td></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- BUKU PELAJARAN -->
    <div class="mt-4">
        <div class="text-bold">BUKU PELAJARAN</div>
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Nominal</th>
                    <th>Paraf</th>
                </tr>
            </thead>
            <tbody>
                @if($bukuPelajaran->isNotEmpty())
                    @foreach($bukuPelajaran as $i => $payment)
                        <tr>
                            <td class="text-center">{{ $i + 1 }}</td>
                            <td class="text-center">{{ $payment->paid_at ? $payment->paid_at->format('d/m/Y') : '-' }}</td>
                            <td>{{ $payment->name }}</td>
                            <td style="text-align: right;">Rp{{ number_format($payment->amount, 0, ',', '.') }}</td>
                            <td></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">-</td>
                        <td>-</td>
                        <td style="text-align: right;">-</td>
                        <td></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- SPP -->
    <div class="mt-4">
        <div class="text-bold">SPP</div>
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Bulan</th>
                    <th>Nominal</th>
                    <th>Paraf</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bulanSPP as $month => $namaBulan)
                    @php
                        $payment = $spp->where('month', $month)->first();
                    @endphp
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $payment && $payment->paid_at ? $payment->paid_at->format('d/m/Y') : '-' }}</td>
                        <td>{{ $namaBulan }}</td>
                        <td style="text-align: right;">{{ $payment ? 'Rp' . number_format($payment->amount, 0, ',', '.') : ($sppFeeCategory ? 'Rp' . number_format($sppFeeCategory->amount, 0, ',', '.') : '-') }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- RINGKASAN -->
    <div class="mt-4">
        <table class="table">
            <tr>
                <td class="text-bold total" width="60%">TOTAL PEMBAYARAN</td>
                <td class="total">Rp. {{ number_format($student->payments->sum('amount'), 0, ',', '.') }}</td>
            </tr>
        </table>
        <div class="text-center mt-2" style="font-size: 10px;">
            Dicetak pada: {{ now()->format('d/m/Y') }}
        </div>
    </div>
</body>
</html>