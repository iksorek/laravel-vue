<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    public function bookable()
    {
        return $this->belongsTo(Bookable::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function scopeBeetwenDates(Builder $query, $from, $to)
    {
        return $query->where('to', '>=', $from)->where('from', '<=', $to);
    }

    public static function findByReviewKey(string $reviewKey): ?Booking
    {
        return static::where('review_key', $reviewKey)->with('bookable:id,title,description')->get(['id','from', 'to', 'bookable_id'])->first();
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($booking) {
            $booking->review_key = Str::uuid();
        });
    }
}
