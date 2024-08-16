<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{

    public function authorize()
    {

        return true;
    }

    public function rules()
    {

        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'event_date' => 'date',
            'event_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'location' => 'required|string|in:main,content',
            'participants_count' => 'required|integer|min:0',
        ];
    }
    public function messages()
    {
        return [
            'event_image.mimes' => '画像の形式はjpeg, png, jpg, gifでなければなりません。',
        ];
    }
}