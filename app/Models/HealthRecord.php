<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HealthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_id',
        'check_date',
        'diagnosis',
        'treatment',
        'veterinarian',
        'notes',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
