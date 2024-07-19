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

        return [
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:5000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nutrients' => 'required|string|max:50',
        ];
    }
    public function messages()
    {
        return [
            'image.mimes' => '画像の形式は jpeg, png, jpg, gif のいずれかである必要があります。',
        ];
    }
}