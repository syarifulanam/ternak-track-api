<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cage extends Model
{
    use HasFactory;

    protected $fillable = [
        'farm_id',
        'name',
        'capacity',
    ];

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }
}
