<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class Blog extends Model
{
    use HasFactory;

    //'title', 'content', 'image', 'created_at',は、フォームからのデータを直接Blogモデルに振り当てるように設定
    protected $fillable = ['title', 'content', 'image', 'created_at'];

}