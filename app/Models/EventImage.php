<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{

    use HasFactory;

    protected $fillable = [

        'event_id',
        'image_path'
    ];

    public function event()
    {
        //belongsTo　多対１のリレーションにより一つのイベントに対して複数の画像保存できる
        return $this->belongsTo(Event::class);
    }
}