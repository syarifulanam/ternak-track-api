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

    public function growths()
    {
        return $this->hasMany(growth::class);
    }

    public function healthRecords()
    {
        return $this->hasMany(HealthRecord::class);
    }

    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class);
    }
}
