<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Payment;
use App\Models\FeeCategory;
use Illuminate\Http\Request;
use App\Helpers\SettingHelper; // Jika kamu gunakan helper Setting

class FeeCategoryController extends Controller
{

    public function index()
    {

        // Ambil tahun ajaran aktif
        $activeYearId = SettingHelper::get('default_academic_year_id');

        // Ambil data siswa yang hanya di tahun ajaran aktif
        $students = Student::with('classroom')
            ->where('academic_year_id', $activeYearId)
            ->get();

        // Ambil pembayaran yang terkait tahun ajaran aktif
        $payments = Payment::with('feeCategory')
            ->where('academic_year_id', $activeYearId)
            ->get()
            ->groupBy('student_id');

        // Ambil kategori pembayaran (buku, pendaftaran, bulanan)
        $categories = FeeCategory::all()->keyBy('slug');

        // Kirim ke view
        return view('fees.index', compact('students', 'payments', 'categories'));
    }
}