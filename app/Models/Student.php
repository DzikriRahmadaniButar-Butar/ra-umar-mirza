<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'student_number',
        'birth_place',
        'birth_date',
        'address',
        'academic_year_id',
        'classroom_id'
    ];

    protected $casts = [
        'months' => 'array',
        'paid_at' => 'datetime'
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    // TAMBAHKAN RELATIONSHIP INI
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}