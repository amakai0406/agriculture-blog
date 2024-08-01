<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{

    use HasFactory;

    //フォームからのデータのtitle・contentをBlogモデルに直接振り当てる設定
    protected $fillable = [
        'title',
        'content'
    ];

    public function images()
    {
        //BlogモデルがBlogImageモデルに1対多のリレーションを定義している(親)
        //blog_idを指定することでBlogモデルと関連するBlogImageモデルインスタンスの取得
        //つまり、Blog記事に関連する画像をすべて取得している
        return $this->hasMany(BlogImage::class);
    }
}






class Blog extends Model
{
    use HasFactory;

    //'title', 'content', 'image', 'created_at',は、フォームからのデータを直接Blogモデルに振り当てるように設定

    protected $fillable = ['title', 'content', 'image', 'created_at',];

    public function admin()
    {
        //belongsToメソッド(多対1)
        return $this->belongsTo(Admin::class);
    }

    public function images()
    {
        //hasManyメソッド(１対多)1つのブログに複数の画像が表示される
        return $this->hasMany(BlogImage::class, 'blog_id');
    }
}


