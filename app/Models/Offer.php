<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Offer extends Model
{
    use LogsActivity;

    protected $table = 'offers';

    protected $fillable = [
        'id_owner',
        'id_property',
        'offer_title',
        'description',
        'price',
        'deposit',
        'rent',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rides()
    {
        return $this->hasMany(Property::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
