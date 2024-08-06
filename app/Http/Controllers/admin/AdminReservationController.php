<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventReservation;
use App\Http\Requests\StoreReservationStatusRequest;
use Illuminate\Support\Facades\Log;


class AdminReservationController extends Controller
{

    public function index()
    {
        Log::error("index");
        $eventReservations = EventReservation::with('event')->get();

        return view('admin.reservations.index', compact('eventReservations'));
    }

    public function update(StoreReservationStatusRequest $request, int $id)
    {
        Log::error("update");
        $reservation = EventReservation::find($id);

        if (!$reservation) {
            return redirect()->route('admin.reservations.index')->withErrors('指定された予約は存在しません。');
        }

        $validated = $request->validated();

        $reservation->status = $validated['status'];
        $reservation->save();

        return redirect()->route('admin.reservations.index')->with('success', '予約状況が更新されました');
    }


}
