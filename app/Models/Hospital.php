<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $fillable = [
        'name',
        'address',
        'email',
        'phone_number',
    ];

    public function patients()
    {
        return $this->hasMany(Patient::class, 'hospital_id');
    }

    protected static function booted () {
        static::deleting(function(Hospital $hospital) {
             $hospital->patients()->delete();
        });
    }
}
