<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeedingRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_id',
        'feed_date',
        'feed_type',
        'volume',
        'notes',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
