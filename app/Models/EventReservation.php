<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class EventReservation extends Model
{

    use HasFactory;

    protected $fillable = [
        'event_id',
        'representative_name',
        'email',
        'phone_number',
    ];

    public function getReservationDateAttribute($value)
    {

        return Carbon::parse($value)->format('Y-m-d H:i');

    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'confirmed' => '確定',
            'cancelled' => 'キャンセル',
            'pending' => '保留',
            'completed' => '完了',
            default => '不明',
        };
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}