<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
  
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
    public function destroy(string $id)
    {
        //
    }
}
