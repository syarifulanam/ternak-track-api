<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Breeding extends Model
{
    use HasFactory;

    protected $fillable = [
        'dam_id',
        'sire_id',
        'mating_date',
        'status',
        'expected_birth_date',
        'notes',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function dam()
    {
        return $this->belongsTo(Animal::class, 'dam_id');
    }

    public function sire()
    {
        return $this->belongsTo(Animal::class, 'sire_id');
    }
}
