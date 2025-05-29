<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = [
        'property_id',
        'owner_id',
        'user_id',
        'transaction_date',
    ];
    protected $casts = [
        'transaction_date' => 'date',
    ];
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function scopeByDate($query, $date)
    {
        return $query->whereDate('transaction_date', $date);
    }
    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('transaction_date', [$startDate, $endDate]);
    }
    public function scopeByOwner($query, $ownerId)
    {
        return $query->where('owner_id', $ownerId);
    }
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
