<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'city_id']; // Pastikan city_id ada

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
