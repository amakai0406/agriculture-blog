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
            'reservation_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    //予約しようとしているイベントの情報を取得
                    $event = Event::find($this->event_id);

                    //イベントがあるかのチェック
                    if (!$event) {
                        $fail('指定されたイベントは存在しません。');
                        return;
                    }
                    //startOfDayメソッドはCarbonオブジェクトの日付をその日の始まり（0時0分0秒）にセット
                    $startDate = Carbon::parse($event->start_date)->startOfDay();

                    //endOfDayメソッドはCarbonオブジェクトの日付をその日の終わり（23時59分59秒）にセット
                    $endDate = Carbon::parse($event->end_date)->endOfDay();

                    //$valueは予約日
                    $reservationDate = Carbon::parse($value)->startOfDay();

                    //ltメソッドは、左側の日付が右側の日付よりも前かどうかをチェック
                    //gtメソッドは、左側の日付が右側の日付よりも後かどうかをチェック
                    if ($reservationDate->lt($startDate) || $reservationDate->gt($endDate)) {
                        $fail('予約日はイベント期間内でなければなりません。');
                    }

                }
            ],
            'status' => 'required|string|in:confirmed,cancelled,pending,completed'
        ];
    }
}