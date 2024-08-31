<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
{
    public function authorize()
    {
        //リクエストを許可している
        return true;
    }

    public function rules()
    {

        return [
            //required(必須)、string(文字列)、max:255(最大255文字)
            'title' => 'required|string|max:255',
            //required(必須)、string(文字列)、max:1000(最大1000文字)
            'content' => 'required|string|max:1000',
            //required(必須)、image(画像ファイル)、mimes:jpeg,png,jpg,gif(画像ファイルの形式指定)、max:2048(最大2048キロバイト（2MB）)
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'required|string|in:eyecatch,content',
        ];
    }
}