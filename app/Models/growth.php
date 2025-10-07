<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class growth extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_id',
        'record_date',
        'weight_kg',
        'height_cm',
        'notes',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
