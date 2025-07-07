<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Payment;
use App\Models\Classroom;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
{
    $totalStudents = Student::count();
    $totalPayments = Payment::sum('amount');
    $totalClassrooms = Classroom::count();
    $monthlyPayments = Payment::whereMonth('paid_at', now()->month)
    ->whereYear('paid_at', now()->year)
    ->sum('amount');


    // Chart Data - Siswa per Tahun Ajaran
    $studentsByAcademicYear = Student::join('academic_years', 'students.academic_year_id', '=', 'academic_years.id')
    ->select('academic_years.year', DB::raw('count(*) as total'))
    ->groupBy('academic_years.year')
    ->orderBy('academic_years.year')
    ->get();

    $chartLabels = $studentsByAcademicYear->pluck('year')->toArray();
    $chartData = $studentsByAcademicYear->pluck('total')->toArray();

    // Chart Data - Pembayaran per Bulan (6 bulan terakhir)
    $paymentsByMonth = Payment::select(
    DB::raw('MONTH(paid_at) as month'),
    DB::raw('YEAR(paid_at) as year'),
    DB::raw('SUM(amount) as total')
    )
    ->where('paid_at', '>=', now()->subMonths(6))
    ->groupBy(DB::raw('YEAR(paid_at)'), DB::raw('MONTH(paid_at)'))
    ->orderBy('year')
    ->orderBy('month')
    ->get();

    $paymentChartLabels = [];
    $paymentChartData = [];

    foreach ($paymentsByMonth as $payment) {
    $monthName = Carbon::create($payment->year, $payment->month)->format('M Y');
    $paymentChartLabels[] = $monthName;
    $paymentChartData[] = $payment->total;
    }

    // Recent Activities
    $recentPayments = Payment::with(['student'])
    ->latest()
    ->take(5)
    ->get();

    $recentStudents = Student::with(['classroom'])
    ->latest()
    ->take(5)
    ->get();

    return view('dashboard', compact(
    'totalStudents',
    'totalPayments', 
    'totalClassrooms',
    'monthlyPayments',
    'chartLabels',
    'chartData',
    'paymentChartLabels',
    'paymentChartData',
    'recentPayments',
    'recentStudents'
    ));
    }

    
}
