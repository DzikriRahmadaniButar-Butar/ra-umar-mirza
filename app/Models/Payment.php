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
        'category',      // TAMBAHKAN INI
        'description',   // TAMBAHKAN INI
        'month'          // TAMBAHKAN INI (untuk SPP)
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}