<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogImage extends Model
{


    use HasFactory;

    use hasFactory;


    protected $fillable = ['blog_id', 'image_path'];

    public function blog()
    {
        //BlogImageクラスがBlogクラスと多対一のリレーションを定義している(子)
        //BlogImageインスタンスからblog_idが一致するBlogインスタンスを取得する
        return $this->belongsTo(Blog::class);


    }
}