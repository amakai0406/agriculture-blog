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
            'description' => 'required|string|max:5000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,heic|max:2048',
            'nutrients' => 'required|string|max:100',
        ];
    }

}