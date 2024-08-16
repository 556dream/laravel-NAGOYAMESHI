<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{

    public function index(Reservation $reservation)
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', Auth::id())->orderBy('reserve_time', 'asc')->get();
 
        return view('users.reserve', compact('reservations'));
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $reserve = new Reservation();
        $reserve->user_id = Auth::user()->id;
        $reserve->shop_id = $request->id;
        $reserve->count_adult = $request->count_adult;
        $reserve->count_child = $request->count_child;
        $reserve->reserve_time = $request->reserve_time;
        $reserve->save();
    
        return redirect()->route('shops.index')->with('success', '予約が完了しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return redirect()->route('reserve.index')->with('flash_message', '予約をキャンセルしました。');
    }

    public function edit(Reservation $reservation)
    {
        return view('shops.edit', compact('reservation'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $reservation->count_adult = $request->count_adult;
        $reservation->count_child = $request->count_child;
        $reservation->reserve_time = $request->reserve_time;
        $reservation->save();
    
        return redirect()->route('shops.index')->with('success', '予約を変更しました。');
    }
}
