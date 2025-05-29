<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
use HasFactory;

protected $fillable = [
'owner_id',
'property_id',
'offer_title',
'offer_type',
'description',
'price',
'deposit',
'rent',
];

public function owner()
{
return $this->belongsTo(User::class, 'owner_id');
}

public function property()
{
return $this->belongsTo(Property::class);
}

public function pictures()
{
return $this->hasMany(OfferPicture::class);
}
}
