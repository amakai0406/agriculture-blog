<?php

namespace App\Http\Rquests\admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventController extends FormRequest
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
        ];
    }
}