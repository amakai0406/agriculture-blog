<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventReservation extends Model
{

    use HasFactory;

    protected $fillable = [
        'event_id',
        'representative_name',
        'email',
        'phone_number',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}