<?php

// app/Models/Property.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'region',
        'town',
        'postal_code',
        'street',
        'building_number',
        'apartment_number',
        'type',
        'surface',
        'number_of_rooms',
        'floor',
        'technical_condition',
        'furnishings',
    ];

    public function offer()
    {
        return $this->hasOne(Offer::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
