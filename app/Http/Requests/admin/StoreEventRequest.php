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
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'participants_count' => 'integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}