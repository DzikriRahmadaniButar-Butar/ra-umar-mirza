@extends('layouts.app')

@section('content')

@php
    use App\Models\AcademicYear;
    $activeYearId = \App\Helpers\SettingHelper::get('default_academic_year_id');
    $activeYearName = AcademicYear::find($activeYearId)?->year ?? '-';
@endphp
<div class="py-6 px-6">
    <!-- Header & Profile Dropdown -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-100">Dashboard<span class="ml-2 inline-block px-2 py-1 text-xs font-semibold rounded bg-blue-600 text-white">
            TA {{ $activeYearName }}
        </span></h1>

        <!-- Profile Dropdown (bawaan Laravel Breeze) -->
        <div class="ml-3 relative">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center text-sm font-medium text-white hover:text-gray-300 focus:outline-none focus:text-gray-300 transition duration-150 ease-in-out">
                        <!-- Avatar -->
                        <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold mr-2">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <div>{{ Auth::user()->name }}</div>
                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.65a.75.75 0 01-1.08 0l-4.25-4.65a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            Logout
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Siswa -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-gray-400 uppercase mb-1">Total Siswa</h2>
                    <p class="text-3xl font-bold text-black">{{ $totalStudents ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Pembayaran -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-gray-400 uppercase mb-1">Total Pembayaran</h2>
                    <p class="text-3xl font-bold text-black">Rp{{ number_format($totalPayments ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Kelas -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-gray-400 uppercase mb-1">Total Kelas</h2>
                    <p class="text-3xl font-bold text-black">{{ $totalClassrooms ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pembayaran Bulan Ini -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-gray-400 uppercase mb-1">Bulan Ini</h2>
                    <p class="text-3xl font-bold text-black">Rp{{ number_format($monthlyPayments ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Chart Siswa per Tahun Ajaran -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-bold text-black mb-4">Jumlah Siswa per Tahun Ajaran</h2>
            <div class="relative h-64 w-full">
                <canvas id="studentChart"></canvas>
            </div>
        </div>

        <!-- Chart Pembayaran per Bulan -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-bold text-black mb-4">Pembayaran per Bulan</h2>
            <div class="relative h-64 w-full">
                <canvas id="paymentChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activities Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Pembayaran Terbaru -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-bold text-black mb-4">Pembayaran Terbaru</h2>
            <div class="space-y-4">
                @forelse($recentPayments ?? [] as $payment)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-semibold text-black">{{ $payment->student->name }}</p>
                        <p class="text-sm text-gray-600">{{ $payment->name }}</p>
                        <p class="text-xs text-gray-500">{{ $payment->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-green-600">Rp{{ number_format($payment->amount, 0, ',', '.') }}</p>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">Belum ada pembayaran terbaru</p>
                @endforelse
            </div>
            <div class="mt-4">
                <a href="{{ route('payments.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    Lihat Semua Pembayaran →
                </a>
            </div>
        </div>

        <!-- Siswa Terbaru -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-bold text-black mb-4">Siswa Terbaru</h2>
            <div class="space-y-4">
                @forelse($recentStudents ?? [] as $student)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-semibold text-black">{{ $student->name }}</p>
                        <p class="text-sm text-gray-600">{{ $student->student_number }}</p>
                        <p class="text-xs text-gray-500">{{ $student->classroom->name ?? 'Belum ada kelas' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">{{ $student->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">Belum ada siswa terbaru</p>
                @endforelse
            </div>
            <div class="mt-4">
                <a href="{{ route('students.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    Lihat Semua Siswa →
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-bold text-black mb-4">Aksi Cepat</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('students.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-3 rounded-lg flex items-center justify-center transition duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Siswa
            </a>
            <a href="{{ route('payments.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-3 rounded-lg flex items-center justify-center transition duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Pembayaran
            </a>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
    // Tunggu DOM selesai loading
    document.addEventListener('DOMContentLoaded', function() {
        // Chart Siswa per Tahun Ajaran
        const studentCanvas = document.getElementById('studentChart');
        const studentCtx = studentCanvas.getContext('2d');
        
        // Pastikan data ada sebelum membuat chart
        const studentLabels = @json($chartLabels ?? []);
        const studentData = @json($chartData ?? []);
        
        if (studentLabels.length > 0 && studentData.length > 0) {
            const studentChart = new Chart(studentCtx, {
                type: 'bar',
                data: {
                    labels: studentLabels,
                    datasets: [{
                        label: 'Jumlah Siswa',
                        data: studentData,
                        backgroundColor: 'rgba(37, 99, 235, 0.5)',
                        borderColor: 'rgba(37, 99, 235, 1)',
                        borderWidth: 1,
                        borderRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            titleColor: '#fff',
                            bodyColor: '#fff'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    animation: {
                        duration: 1000
                    }
                }
            });
        } else {
            // Jika tidak ada data, tampilkan pesan
            studentCanvas.style.display = 'none';
            studentCanvas.parentElement.innerHTML = '<p class="text-gray-500 text-center py-16">Belum ada data siswa untuk ditampilkan</p>';
        }

        // Chart Pembayaran per Bulan
        const paymentCanvas = document.getElementById('paymentChart');
        const paymentCtx = paymentCanvas.getContext('2d');
        
        const paymentLabels = @json($paymentChartLabels ?? []);
        const paymentData = @json($paymentChartData ?? []);
        
        if (paymentLabels.length > 0 && paymentData.length > 0) {
            const paymentChart = new Chart(paymentCtx, {
                type: 'line',
                data: {
                    labels: paymentLabels,
                    datasets: [{
                        label: 'Pembayaran',
                        data: paymentData,
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        intersect: false
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            callbacks: {
                                label: function(context) {
                                    return 'Rp' + new Intl.NumberFormat('id-ID').format(context.raw);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp' + new Intl.NumberFormat('id-ID').format(value);
                                }
                            }
                        }
                    },
                    animation: {
                        duration: 1000
                    }
                }
            });
        } else {
            paymentCanvas.style.display = 'none';
            paymentCanvas.parentElement.innerHTML = '<p class="text-gray-500 text-center py-16">Belum ada data pembayaran untuk ditampilkan</p>';
        }
    });
</script>
@endsection