<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;


class Admin extends Model implements AuthenticatableContract
{
    //Authenticatable(承認システム機能)追加
    use HasFactory, Authenticatable;

    public $timestamps = false;

    protected $fillable = ['name', 'password'];

    public function blogs()
    {
        //hasManyメソッド1対多リレーション
        return $this->hasMany(Blog::class);
    }
}
