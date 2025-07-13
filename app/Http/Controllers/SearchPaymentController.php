<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class SearchPaymentController extends Controller
{
    public function show(Request $request)
    {
        $student = null;
        
        if ($request->has('nis') && $request->nis) {
            // Cari student berdasarkan NIS dengan load payments dan classroom
            $student = Student::with([
                'payments.feeCategory',  // tambahkan ini
                'classroom'
            ])
            ->where('student_number', $request->nis)
            ->first();
        }
        
        return view('search-payment', compact('student'));
    }
}