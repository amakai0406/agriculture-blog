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

        ];
    }
}