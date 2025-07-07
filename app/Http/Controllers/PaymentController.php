<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        $search = $request->get('search');
        $perPage = $request->get('per_page', 10);
    
        // Validasi sort field untuk keamanan
        $allowedSorts = ['name', 'amount', 'paid_at', 'created_at', 'notes', 'student', 'user_id'];
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
    
        // Query dasar
        $query = Payment::query()->with(['student', 'user']);
    
        // Search functionality
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('payments.name', 'like', '%' . $search . '%')
                  ->orWhere('payments.notes', 'like', '%' . $search . '%')
                  ->orWhere('payments.amount', 'like', '%' . $search . '%')
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
            $query->orderBy($sort, $direction);
        }
    
        // Pagination dengan append semua parameter
        $payments = $query->paginate($perPage);
        $payments->appends($request->query());
    
        // Jika request biasa (web), return view
        return view('payments.index', compact('payments', 'search', 'sort', 'direction', 'perPage'));
    }
    public function create()
    {
        // Ambil data students untuk dropdown di form
        $students = Student::orderBy('name', 'asc')->get();
        
        return view('payments.create', compact('students'));
    }
    
    public function edit(Payment $payment)
    {
        // Ambil data students untuk dropdown di form edit
        $students = Student::orderBy('name', 'asc')->get();
        
        return view('payments.edit', compact('payment', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'paid_at' => 'nullable|date',
            'notes' => 'nullable|string'
        ]);

        $payment = Payment::create([
            'student_id' => $request->student_id,
            'name' => $request->name,
            'amount' => $request->amount,
            'paid_at' => $request->paid_at,
            'notes' => $request->notes,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('payments.index')->with('success', 'Data pembayaran berhasil disimpan.');
    }

    public function show(Payment $payment)
    {
        // Method show untuk menampilkan detail payment
        return view('payments.show', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        // Method update untuk mengupdate payment
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'paid_at' => 'nullable|date',
            'notes' => 'nullable|string'
        ]);

        $payment->update([
            'student_id' => $request->student_id,
            'name' => $request->name,
            'amount' => $request->amount,
            'paid_at' => $request->paid_at,
            'notes' => $request->notes,
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment berhasil diupdate');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment berhasil dihapus');
    }

    public function getByStudent($id)
    {
        return response()->json(Payment::where('student_id', $id)->with('user')->get());
    }
}