<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferPicture extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'path',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function getUrlAttribute()
    {
        return asset('storage/' . $this->path);
    }
}

