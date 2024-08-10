<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Event;
use Carbon\Carbon;

class StoreReservationRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'event_id' => 'required|exists:events,id',
            'representative_name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'reservation_date' => 'date',
            'status' => 'string|in:confirmed,cancelled'
        ];
    }
}