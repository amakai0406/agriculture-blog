<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{

    use HasFactory;

    protected $fillable = [
        'title',
        'content'
    ];

    public function images()
    {
        return $this->hasMany(BlogImage::class, 'blog_id');
    }
}