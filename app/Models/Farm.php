<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Farm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'owner',
    ];

    public function cages()
    {
        return $this->hasMany(Cage::class);
    }
}
