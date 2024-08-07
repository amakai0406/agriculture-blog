<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{

    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'participants_count',
    ];

    public function getStartDateAttribute($value)
    {

        return Carbon::parse($value)->format('Y-m-d');
    }

    public function getEndDateAttribute($value)
    {

        return Carbon::parse($value)->format('Y-m-d');
    }

    public function eventImages()
    {

        return $this->hasMany(EventImage::class);
    }

    public function reservation()
    {
        return $this->hasOne(EventReservation::class);
    }
}

