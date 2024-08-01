<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function eventImages()
    {

        return $this->hasMany(EventImage::class, 'event_id');
    }


}

