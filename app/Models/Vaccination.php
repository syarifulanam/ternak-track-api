<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vaccination extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_id',
        'vaccination_date',
        'vaccine_type',
        'dosage',
        'staff',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
