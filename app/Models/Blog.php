<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class Blog extends Model
{
    //Authenticatable(承認システム機能)追加
    use HasFactory;

    protected $fillable = ['title', 'content', 'image', 'created_at'];

}
