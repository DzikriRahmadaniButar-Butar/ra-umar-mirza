<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\SettingHelper;
use App\Models\FeeCategory;

class PaymentController extends Controller
{
    
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);

        $activeYearId = SettingHelper::get('default_academic_year_id');
    
        // Validasi sort field untuk keamanan
        $allowedSorts = ['name', 'amount', 'paid_at', 'created_at', 'notes', 'student', 'user_id', 'category', 'month'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }
    
        // Validasi sort direction
        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }
    
        // Validasi per page
        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }
    
        // Query dasar - HANYA SATU QUERY YANG DIGUNAKAN
        $query = Payment::query()
            ->with(['student', 'user', 'feeCategory'])
            ->where('academic_year_id', $activeYearId);
    
        // Search functionality
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('payments.name', 'like', '%' . $search . '%')
                  ->orWhere('payments.notes', 'like', '%' . $search . '%')
                  ->orWhere('payments.amount', 'like', '%' . $search . '%')
                  ->orWhere('payments.category', 'like', '%' . $search . '%')
                  ->orWhereHas('student', function($studentQuery) use ($search) {
                      $studentQuery->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', '%' . $search . '%');
                  });
            });
        }
    
        // Sorting dengan join yang benar
        if ($sort === 'student') {
            $query->join('students', 'payments.student_id', '=', 'students.id')
                ->orderBy('students.name', $direction)
                ->select('payments.*');
        } elseif ($sort === 'user_id') {
            $query->join('users', 'payments.user_id', '=', 'users.id')
                ->orderBy('users.name', $direction)
                ->select('payments.*');
        } else {
            $query->orderBy('payments.' . $sort, $direction);
        }
    
        // Pagination dengan append semua parameter
        $payments = $query->paginate($perPage);
        $payments->appends($request->query());
    
        // Jika request biasa (web), return view
        return view('payments.index', compact('payments', 'search', 'sort', 'direction', 'perPage'));
    }
    
    // Method untuk mendapatkan data tagihan yang dikelompokkan
    public function getPaymentsByStudent()
    {
        $activeYearId = SettingHelper::get('default_academic_year_id');
        
        return Payment::with(['student', 'feeCategory'])
            ->where('academic_year_id', $activeYearId)
            ->get()
            ->groupBy('student_id');
    }

    public function create()
    {
        $students = Student::where('academic_year_id', \App\Helpers\SettingHelper::get('default_academic_year_id'))
                        ->orderBy('name', 'asc')
                        ->get();

        $categories = FeeCategory::all();
        $monthlyCategoryIds = FeeCategory::where('is_monthly', true)->pluck('id');
        return view('payments.create', compact('students', 'categories', 'monthlyCategoryIds'));
    }

    public function edit(Payment $payment)
    {
        $activeYearId = SettingHelper::get('default_academic_year_id');
        
        // Load relationship untuk memastikan data tersedia
        $payment->load(['student', 'user', 'feeCategory']);
        
        // Ambil data students untuk dropdown di form edit (hanya tahun ajaran aktif)
        $students = Student::where('academic_year_id', $activeYearId)
                        ->orderBy('name', 'asc')
                        ->get();
        
        $categories = FeeCategory::all();
        $monthlyCategoryIds = FeeCategory::where('is_monthly', true)->pluck('id')->toArray();
        
        // Jika kategori monthly, ambil months yang sudah dibayar
        if ($payment->feeCategory && $payment->feeCategory->is_monthly) {
            $paidMonths = Payment::where('student_id', $payment->student_id)
                                ->where('fee_category_id', $payment->fee_category_id)
                                ->where('academic_year_id', $activeYearId)
                                ->pluck('month')
                                ->toArray();
            $payment->months = $paidMonths;
        }
        
        return view('payments.edit', compact('payment', 'students', 'categories', 'monthlyCategoryIds'));   
    }
    
    function bulanIndonesia($m) {
        return [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ][$m] ?? 'Bulan tidak valid';
    }
    
    public function store(Request $request)
    {
        $category = FeeCategory::findOrFail($request->fee_category_id);
        $activeYearId = SettingHelper::get('default_academic_year_id');
        

        $rules = [
            'student_id' => 'required|exists:students,id',
            'name' => 'required|string|max:255',
            'fee_category_id' => 'required|exists:fee_categories,id',
            'amount' => 'required|numeric|min:1000',
            'paid_at' => 'required|date',
            'notes' => 'nullable|string',
        ];

        if ($category->is_monthly) {
            $rules['months'] = 'required|array|min:1';
        }

        $validated = $request->validate($rules);

        // Validasi: Siswa harus berada di tahun ajaran aktif
        $student = Student::find($validated['student_id']);
        if (!$student || $student->academic_year_id != $activeYearId) {
            return back()->withErrors(['student_id' => 'Siswa tidak terdaftar di tahun ajaran aktif.'])->withInput();
        }

        // Simpan berdasarkan kategori
        if ($category->is_monthly) {
            $months = $request->input('months');
            $totalAmount = $validated['amount'];
            $amountPerMonth = $totalAmount / count($months); // 💡 Bagi rata ke bulan
        
            foreach ($months as $month) {
                $month = (int) $month;
        
                // Cek duplikat bulan
                $exists = Payment::where('student_id', $validated['student_id'])
                    ->where('fee_category_id', $category->id)
                    ->where('month', $month)
                    ->where('academic_year_id', $activeYearId)
                    ->exists();
        
                if ($exists) {
                    return back()->withErrors([
                        'months' => 'Pembayaran untuk bulan ' . \Carbon\Carbon::create()->month($month)->locale('id')->translatedFormat('F') . ' sudah pernah dilakukan.',
                    ])->withInput();
                }
        
                Payment::create([
                    'student_id' => $validated['student_id'],
                    'name' => $validated['name'] . ' Bulan ' . \Carbon\Carbon::create()->month($month)->locale('id')->translatedFormat('F'),
                    'fee_category_id' => $category->id,
                    'amount' => $amountPerMonth, // ✅ Disesuaikan
                    'month' => $month,
                    'paid_at' => $validated['paid_at'],
                    'notes' => $validated['notes'] ?? null,
                    'academic_year_id' => $activeYearId,
                    'user_id' => Auth::id(),
                ]);
            }

        } else {
            // Cek total yang sudah dibayar
            $totalPaid = Payment::where('student_id', $validated['student_id'])
                ->where('fee_category_id', $category->id)
                ->sum('amount');

            $sisaTagihan = $category->limit_amount - $totalPaid;

            if ($validated['amount'] > $sisaTagihan) {
                return back()->withErrors([
                    'amount' => 'Sisa tagihan hanya Rp ' . number_format($sisaTagihan, 0, ',', '.'),
                ])->withInput();
            }

            // Simpan satu entri pembayaran (bebas)
            Payment::create([
                'student_id' => $validated['student_id'],
                'name' => $validated['name'],
                'fee_category_id' => $category->id,
                'amount' => $validated['amount'],
                'month' => null,
                'paid_at' => $validated['paid_at'],
                'notes' => $validated['notes'] ?? null,
                'academic_year_id' => $activeYearId,
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->route('payments.index')->with('success', 'Data pembayaran berhasil disimpan.');
    }

    public function show(Payment $payment)
    {
        // Load relationship untuk detail view
        $payment->load(['student', 'user']);
        return view('payments.show', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $category = FeeCategory::findOrFail($request->fee_category_id);
        $activeYearId = SettingHelper::get('default_academic_year_id');
    
        // Validasi sesuai dengan form
        $rules = [
            'student_id' => 'required|exists:students,id',
            'name' => 'required|string|max:255',
            'fee_category_id' => 'required|exists:fee_categories,id',
            'amount' => 'required|numeric|min:1000',
            'notes' => 'nullable|string',
        ];
    
        // Tambahkan validasi months jika kategori monthly
        if ($category->is_monthly) {
            $rules['months'] = 'required|array|min:1';
        }
    
        $validated = $request->validate($rules);
    
        try {
            // Validasi: Siswa harus berada di tahun ajaran aktif
            $student = Student::find($validated['student_id']);
            if (!$student || $student->academic_year_id != $activeYearId) {
                return back()->withErrors(['student_id' => 'Siswa tidak terdaftar di tahun ajaran aktif.'])->withInput();
            }
    
            // Jika kategori monthly, handle update untuk bulan yang dipilih
            if ($category->is_monthly && $request->has('months')) {
                $months = $request->input('months');
                $totalAmount = $validated['amount'];
                $amountPerMonth = $totalAmount / count($months);
    
                // Hapus pembayaran lama untuk kategori ini
                Payment::where('student_id', $validated['student_id'])
                    ->where('fee_category_id', $category->id)
                    ->where('academic_year_id', $activeYearId)
                    ->delete();
    
                // Buat pembayaran baru untuk setiap bulan
                foreach ($months as $month) {
                    $month = (int) $month;
    
                    Payment::create([
                        'student_id' => $validated['student_id'],
                        'name' => $validated['name'] . ' Bulan ' . \Carbon\Carbon::create()->month($month)->locale('id')->translatedFormat('F'),
                        'fee_category_id' => $category->id,
                        'amount' => $amountPerMonth,
                        'month' => $month,
                        'paid_at' => now(), // Force ke hari ini
                        'notes' => $validated['notes'] ?? null,
                        'academic_year_id' => $activeYearId,
                        'user_id' => Auth::id(),
                    ]);
                }
            } else {
                // Update payment biasa (non-monthly)
                $payment->update([
                    'student_id' => $validated['student_id'],
                    'name' => $validated['name'],
                    'fee_category_id' => $validated['fee_category_id'],
                    'amount' => $validated['amount'],
                    'paid_at' => now(), // Force ke hari ini
                    'notes' => $validated['notes'],
                    'user_id' => Auth::id(),
                ]);
            }
    
            return redirect()->route('payments.index')->with('success', 'Data pembayaran berhasil diperbarui.');
            
        } catch (\Exception $e) {
            \Log::error('Payment update error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengupdate pembayaran: ' . $e->getMessage()])->withInput();
        }
    }
    public function destroy(Payment $payment)
    {
        try {
            $payment->delete();
            return redirect()->route('payments.index')->with('success', 'Payment berhasil dihapus');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus payment: ' . $e->getMessage()]);
        }
    }

    public function getByStudent($id)
    {
        return response()->json(Payment::where('student_id', $id)->with('user')->get());
    }

    public function tagihan()
    {
        $activeYearId = SettingHelper::get('default_academic_year_id');
        
        // Ambil data siswa dengan relasi yang diperlukan
        $students = Student::with(['classroom', 'payments.feeCategory'])
            ->where('academic_year_id', $activeYearId)
            ->get();

        // Ambil pembayaran yang dikelompokkan berdasarkan student_id
        $payments = Payment::with('feeCategory')
            ->where('academic_year_id', $activeYearId)
            ->get()
            ->groupBy('student_id');

        // Ambil kategori pembayaran (buku, pendaftaran, bulanan)
        $categories = FeeCategory::all()->keyBy('slug');

        return view('payments.tagihan', compact('students', 'payments', 'categories'));
    }

    public function searchPayment(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|string'
        ]);

        $activeYearId = SettingHelper::get('default_academic_year_id');
        
        // Cari student berdasarkan student_number (NIPD)
        $student = Student::with(['classroom', 'payments.feeCategory'])
            ->where('student_number', $validated['nis'])
            ->where('academic_year_id', $activeYearId)
            ->first();

        if (!$student) {
            return view('payments.search', compact('student'));
        }

        // Load payments dengan relasi yang diperlukan
        $student->load(['payments' => function($query) use ($activeYearId) {
            $query->where('academic_year_id', $activeYearId)
                ->with('feeCategory')
                ->orderBy('paid_at', 'desc');
        }]);

        return view('payments.search', compact('student'));
    }
}