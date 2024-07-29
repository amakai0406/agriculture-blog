<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreVegetableRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        //検証する際のルールを設定する
        return [
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:1000',
            'image' => 'image|mimes:jpeg,png,jpg,gif,heic|max:2048',
        ];
    }

}