<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;


    /**
     * @var mixed
     */
    protected $fillable = ['id', 'content', 'rating'];

    public function bookable()
    {
        return $this->belongsTo(Bookable::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }


    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

}
