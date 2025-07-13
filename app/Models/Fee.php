<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = [
        'student_id',
        'fee_category_id',
        'academic_year_id',
        'name',
        'amount',
        'month',
        'is_paid',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function category()
    {
        return $this->belongsTo(FeeCategory::class, 'fee_category_id');
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class); // jika nanti ada relasi ke fee_id
    }
}
