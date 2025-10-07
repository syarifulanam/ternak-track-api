<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OffSpring extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'child_id',
        'birth_date',
        'notes',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
