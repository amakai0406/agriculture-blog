<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vegetable extends Model
{

    use HasFactory;

    //フォームからのデータを直接Vegetableモデルに割り当てるように設定
    protected $fillable = ['name', 'description', 'image'];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'vegetable_blog');
    }
}