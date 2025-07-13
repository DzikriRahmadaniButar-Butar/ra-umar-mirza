<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'student_id',
        'user_id',
        'name',
        'amount',
        'paid_at',
        'notes',
        'fee_category_id', // <-- ini ganti dari 'category'
        'month',
        'academic_year_id',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    // Method untuk mendapatkan academic year yang aktif
    public static function getDefaultAcademicYearId()
    {
        // Opsi 2: Dari config atau setting
        return config('app.default_academic_year_id', 1);
    }

    // Boot method untuk set default value
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            if (empty($payment->academic_year_id)) {
                $payment->academic_year_id = self::getDefaultAcademicYearId();
            }
        });
    }

    // Relasi dengan academic year
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(FeeCategory::class, 'fee_category_id');
    }

    public function feeCategory()
    {
        return $this->belongsTo(FeeCategory::class);
    }

}