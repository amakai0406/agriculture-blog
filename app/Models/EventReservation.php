<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventReservation extends Model
{

    use HasFactory;

    protected $fillable = [
        'representative_name',
        'phone_number',
        'questions'
    ];
}