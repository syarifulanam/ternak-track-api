<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Animal extends Model
{
     use HasFactory;

    protected $fillable = [
        'qr_code',
        'species',
        'birth_date',
        'gender',
        'status',
        'sire_id',
        'dam_id',
        'cage_id',
    ];

    // Relasi ke kandang
    public function cage()
    {
        return $this->belongsTo(Cage::class);
    }

    // Relasi ke indukan
    public function sire()
    {
        return $this->belongsTo(Animal::class, 'sire_id');
    }

    public function dam()
    {
        return $this->belongsTo(Animal::class, 'dam_id');
    }
}
