<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PrintController extends Controller
{
    public function kartu($id)
    {
        $student = Student::with(['payments', 'classroom'])->findOrFail($id);
        
        $pdf = Pdf::loadView('print.kartu-pembayaran', compact('student'));
        return $pdf->stream('kartu-pembayaran ' . $student->name . '.pdf');
    }

    /**
     * Helper method untuk menyiapkan data kwitansi
     */
    private function prepareKwitansiData($studentId, $paymentId = null)
    {
        $student = Student::with(['classroom'])->findOrFail($studentId);
        
        // Jika ada paymentId spesifik, ambil payment tersebut
        if ($paymentId) {
            $selectedPayments = Payment::where('student_id', $studentId)
                                     ->where('id', $paymentId)
                                     ->whereNotNull('paid_at') // Pastikan sudah dibayar
                                     ->get();
            
            // Untuk single payment, set juga variable $payment
            $payment = $selectedPayments->first();
        } else {
            // Jika tidak ada paymentId, ambil semua payment yang sudah dibayar
            $selectedPayments = Payment::where('student_id', $studentId)
                                     ->whereNotNull('paid_at')
                                     ->latest('paid_at')
                                     ->get();
            
            $payment = $selectedPayments->first();
        }
        
        // Kalkulasi data berdasarkan payment yang sudah dibayar
        $totalAmount = $selectedPayments->sum('amount');
        $paymentDescription = $selectedPayments->isNotEmpty() 
            ? $selectedPayments->pluck('name')->implode(', ') 
            : 'Pembayaran SPP';
        
        $rawPaymentDate = $selectedPayments->isNotEmpty() 
            ? $selectedPayments->first()->paid_at 
            : now();
        
        $paymentDateFormatted = Carbon::parse($rawPaymentDate)->translatedFormat('d F Y');
        
        $receiver = auth()->user()->name ?? 'Zulkarnaen';
        
        return [
            'student' => $student,
            'payment' => $payment, // Single payment object untuk view
            'paymentItems' => $selectedPayments, // Collection untuk multiple payments
            'totalAmount' => $totalAmount,
            'paymentDescription' => $paymentDescription,
            'paymentDate' => $rawPaymentDate,
            'paymentDateFormatted' => $paymentDateFormatted,
            'receiver' => $receiver,
            'paymentId' => $paymentId
        ];
    }

    /**
     * Generate kwitansi view (untuk preview)
     */
    public function generateKwitansi($studentId, $paymentId = null)
    {
        $data = $this->prepareKwitansiData($studentId, $paymentId);
        $pdf = Pdf::loadView('print.kwitansi', $data);
        return $pdf->stream('kwitansi.pdf');
    }
    
    /**
     * Generate kwitansi PDF (untuk download/stream)
     */
    public function generateKwitansiPdf($studentId, $paymentId = null)
    {
        $data = $this->prepareKwitansiData($studentId, $paymentId);
        
        // Load view dengan data
        $pdf = Pdf::loadView('print.kwitansi', $data);
        
        // Set paper size dan orientasi
        $pdf->setPaper('letter', 'portrait');
        
        // Generate filename
        $filename = 'kwitansi-' . $data['student']->name . '-' . now()->format('Y-m-d') . '.pdf';
        
        // Return PDF stream
        return $pdf->stream($filename);
    }

    /**
     * Generate kwitansi untuk multiple payments
     */
    public function generateKwitansiMultiple($studentId, $paymentId = null, Request $request)
    {
        $student = Student::with(['classroom'])->findOrFail($studentId);
        $paymentIds = $request->input('payment_ids', []);
        
        if (empty($paymentIds)) {
            return redirect()->back()->with('error', 'Pilih minimal satu pembayaran');
        }
        
        $selectedPayments = Payment::whereIn('id', $paymentIds)
                            ->where('student_id', $studentId)
                            ->whereNotNull('paid_at') // Pastikan sudah dibayar
                            ->get();
        
        if ($selectedPayments->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada pembayaran yang valid dipilih');
        }
        
        $rawDate = $selectedPayments->first()->paid_at ?? now();
        $paymentDateFormatted = Carbon::parse($rawDate)->translatedFormat('d F Y');
        
        // Set payment object untuk single payment (jika hanya 1 payment)
        $payment = $selectedPayments->count() === 1 ? $selectedPayments->first() : null;
        
        // Hitung total berdasarkan payment yang sudah dibayar
        $totalAmount = $selectedPayments->sum('amount');
                            
        $data = [
            'student' => $student,
            'payment' => $payment, // Single payment object
            'paymentItems' => $selectedPayments, // Collection untuk multiple payments
            'totalAmount' => $totalAmount,
            'paymentDescription' => $selectedPayments->pluck('name')->implode(', '),
            'paymentDate' => $rawDate,
            'paymentDateFormatted' => $paymentDateFormatted,
            'receiver' => auth()->user()->name ?? 'Zulkarnaen',
            'paymentId' => implode(',', $paymentIds)
        ];
        
        $pdf = Pdf::loadView('print.kwitansi', $data);
        $pdf->setPaper('letter', 'portrait');
    
        $filename = 'kwitansi-' . $student->name . '-multiple-' . now()->format('Y-m-d') . '.pdf';
        return $pdf->stream($filename);
    }
}