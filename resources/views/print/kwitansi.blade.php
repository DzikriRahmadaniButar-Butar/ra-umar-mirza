<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kwitansi</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            margin-top: -10px;
            padding: 0;
            line-height: 1.4;
        }
        .header-section {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo {
            width: 60px;
            height: 60px;
            margin-right: 15px;
            border: 1px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: #666;
        }
        .school-info {
            flex: 1;
        }
        .school-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .school-address {
            font-size: 10px;
            line-height: 1.3;
            margin-bottom: 3px;
        }
        .receipt-number {
            text-align: right;
            font-size: 11px;
            margin-bottom: 15px;
        }
        .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-top: -15px;
        }
        .receipt-info {
            margin-bottom: 5px;
        }
        .receipt-info table {
            width: 100%;
            border-collapse: collapse;
        }
        .receipt-info td {
            padding: 3px 0;
            vertical-align: top;
        }
        .receipt-info td:first-child {
            width: 120px;
        }
        .payment-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
        }
        .payment-table th,
        .payment-table td {
            border: 1px solid #000;
            text-align: left;
        }
        .payment-table th {
            background-color: #f5f5f5;
            font-weight: bold;
            text-align: center;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .signature-section {
            margin-top: 5px;
            text-align: right;
        }
        .signature-box {
            display: inline-block;
            text-align: center;
            min-width: 150px;
        }
        .signature-line {
            border-bottom: 1px solid #000;
            margin-top: -20px;
        }
        .copy-separator {
            border-top: 2px dashed #000;
            margin: 15px 0;
        }
        .print-info {
            font-size: 10px;
            color: #666;
        }
        .amount-field {
            border-bottom: 1px solid #000;
            min-height: 20px;
            display: inline-block;
            min-width: 200px;
            padding-bottom: 2px;
        }
        .text-lg { font-size: 14px; }
        .text-xl { font-size: 20px; }
        .text-bold { font-weight: bold; }
        .total{ background-color: #c2c2c2; }
        .rapat{margin-bottom: -10px;}
    </style>
</head>
<body>

@for ($copy = 0; $copy < 2; $copy++)

<div class="text-center">
    <table class="w-full">
        <tr>
            <td width="0%" style="vertical-align: middle;">
                <img src="{{ public_path('images/logobw.png') }}" alt="Logo" height="80">
            </td>
            <td width="100%" style="vertical-align: middle;">
                <div class="text-lg text-bold rapat">LEMBAGA PENDIDIKAN</div>
                <div class="text-xl text-bold">UMAR MIRZA</div>
                <div>JL. Balai Desa Ujung, Gg. Bunga/Gg. Lapangan No.81<br>Desa Marindal II, Kecamatan Patumbak - 20361<br>Kabupaten Deli Serdang, Sumatera Utara<br>Telp. 0811641690 - 082167777712 - 081375757408<br>Email : ra.umarmirza@gmail.com</div>
            </td>
        </tr>
    </table>
    <div class="receipt-number">
        No: {{ $paymentId ?? '000' }}/LPUM/KW/{{ date('Y') }}
    </div>
    <div class="title">KWITANSI</div>
</div>

{{-- Debug info - hapus setelah selesai debugging
<div style="border: 1px solid red; padding: 10px; margin: 10px 0; font-size: 10px;">
    <strong>DEBUG INFO:</strong><br>
    Student ID: {{ $student->id ?? 'NULL' }}<br>
    Student Name: {{ $student->name ?? 'NULL' }}<br>
    Payment ID: {{ $paymentId ?? 'NULL' }}<br>
    Payment Items Count: {{ isset($paymentItems) ? $paymentItems->count() : 0 }}<br>
    Total Amount: {{ $totalAmount ?? 0 }}<br>
    Payment Description: {{ $paymentDescription ?? 'NULL' }}<br>
    @if(isset($paymentItems) && $paymentItems->isNotEmpty())
        <strong>Payment Items:</strong><br>
        @foreach($paymentItems as $item)
            - ID: {{ $item->id }}, Name: {{ $item->name }}, Amount: {{ $item->amount }}<br>
        @endforeach
    @endif
</div> --}}

<div class="receipt-info">
    <table>
        <tr>
            <td>Diterima dari</td>
            <td>: Orang Tua <strong>{{ $student->name }}</strong></td>
        </tr>
        <tr>
            <td>Sejumlah</td>
            <td>: <span class="amount-field"><strong>Rp {{ number_format($totalAmount, 0, ',', '.') }}</strong></span></td>
        </tr>
    </table>
</div>

<table class="payment-table">
    <thead>
        <tr>
            <th style="width: 40px;">NO.</th>
            <th>Keterangan</th>
            <th style="width: 120px;">Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($paymentItems) && $paymentItems->isNotEmpty())
            {{-- Multiple payments menggunakan Collection --}}
            @foreach($paymentItems as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->name ?? 'Pembayaran' }}{{ $item->notes ? ' - ' . $item->notes : '' }}</td>
                    <td class="text-right">Rp {{ number_format($item->amount ?? 0, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        @elseif(isset($payment) && $payment)
            {{-- Single payment object --}}
            <tr>
                <td class="text-center">1</td>
                <td>{{ $payment->name }}{{ $payment->notes ? ' - ' . $payment->notes : '' }}</td>
                <td class="text-right">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
            </tr>
        @else
            {{-- Fallback with description --}}
            <tr>
                <td class="text-center">1</td>
                <td>{{ $paymentDescription ?? 'Pembayaran' }}</td>
                <td class="text-right">Rp {{ number_format($totalAmount, 0, ',', '.') }}</td>
            </tr>
        @endif

        {{-- Baris kosong untuk pemisah --}}
        <tr><td colspan="3" style="height: 10px;">&nbsp;</td></tr>

        {{-- Total, Panjar, Sisa --}}
        <tr class="total">
            <td colspan="2" class="text-right"><strong>Total</strong></td>
            <td class="text-right"><strong>Rp {{ number_format($totalAmount, 0, ',', '.') }}</strong></td>
        </tr>
        <tr class="total">
            <td colspan="2" class="text-right">Panjar</td>
            <td class="text-right">Rp {{ number_format($totalAmount, 0, ',', '.') }}</td>
        </tr>
        <tr class="total">
            <td colspan="2" class="text-right">Sisa</td>
            <td class="text-right">Rp -</td>
        </tr>
    </tbody>
</table>

<div class="signature-section">
    <div class="signature-box">
        Marindal II, {{ $paymentDateFormatted }}<br>
        Penerima,<br><br><br><br>
        <div class="signature-line">{{ $receiver ?? 'Bendahara' }}</div>
    </div>
</div>

@if($copy == 0)
    <div class="copy-separator"></div>
@else
    <div class="print-info">
        <em>Dicetak pada: {{ now()->format('d/m/Y') }}</em>
    </div>
@endif

@endfor

</body>
</html>