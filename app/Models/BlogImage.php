<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\hasFactory;

class BlogImage extends Model
{

    use hasFactory;

    protected $fillable = ['blog_id', 'image_path'];

    public function blog()
    {

        return $this->BelongsTo(Blog::class, 'blog_id');
    }
}