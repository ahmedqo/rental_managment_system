<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'property',
        'name',
        'type',
        'size'
    ];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property', 'id');
    }
}
