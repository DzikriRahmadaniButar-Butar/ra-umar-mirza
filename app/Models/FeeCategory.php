<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeCategory extends Model
{
    protected $fillable = [
        'name', 'slug', 'is_monthly', 'description'
    ];

    public function fees()
    {
        return $this->hasMany(Fee::class); // nanti kita buat model Fee
    }
}
