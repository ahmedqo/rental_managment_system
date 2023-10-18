<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'property',
        'name',
        'nationality',
        'email',
        'phone',
        'startDate',
        'endDate',
        'socialNumber',
        'address',
        'extra',
        'status',
        'price'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property', 'id');
    }
}
