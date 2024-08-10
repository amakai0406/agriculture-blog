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
            'participants_count' => 'integer',
            'location' => 'required|string|max:50',
            'event_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}