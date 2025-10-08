<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offspring extends Model
{
    use HasFactory;

    protected $table = 'offsprings';

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
