<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $shop = Shop::find($request->input('id'));

        // 現在の日時を取得
        $now = Carbon::now();
        
        // 予約日時を取得
        $reservationDateTime = Carbon::parse($request->input('reserve_time'));


        if ($reservationDateTime->isPast()) {
            return back()->with('error', '現在日時より前の予約はできません');
        }

        // 店舗の営業時間を取得
        $OpeningTime = Carbon::parse($reservationDateTime->toDateString() . ' ' .$shop->openingtime);
        $ClosingTime = Carbon::parse($reservationDateTime->toDateString() . ' ' .$shop->closingtime);

        

        if ($reservationDateTime->lt($OpeningTime) || $reservationDateTime->gt($ClosingTime)) {
            return back()->with('error', '営業時間外の予約はできません');
        }

        
        $day_of_week_map = [
            "毎週月曜日" => 1,
            "毎週火曜日" => 2,
            "毎週水曜日" => 3,
            "毎週木曜日" => 4,
            "毎週金曜日" => 5,
            "毎週土曜日" => 6,
            "毎週日曜日" => 7,
        ];
        $closingday = $day_of_week_map[$shop->closingday];

        $reservationDate = $reservationDateTime->format('N');


        if ($closingday == $reservationDate) {
            return redirect()->back()->with('error', '予約日が定休日です。別の日を選択してください。');
        }


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

        $shop = Shop::find($request->input('id'));

        // 現在の日時を取得
        $now = Carbon::now();
        
        // 予約日時を取得
        $reservationDateTime = Carbon::parse($request->input('reserve_time'));


        if ($reservationDateTime->isPast()) {
            return back()->with('error', '現在日時より前の予約はできません');
        }

        // 店舗の営業時間を取得
        $OpeningTime = Carbon::parse($reservationDateTime->toDateString() . ' ' .$shop->openingtime);
        $ClosingTime = Carbon::parse($reservationDateTime->toDateString() . ' ' .$shop->closingtime);

        

        if ($reservationDateTime->lt($OpeningTime) || $reservationDateTime->gt($ClosingTime)) {
            return back()->with('error', '営業時間外の予約はできません');
        }

        
        $day_of_week_map = [
            "毎週月曜日" => 1,
            "毎週火曜日" => 2,
            "毎週水曜日" => 3,
            "毎週木曜日" => 4,
            "毎週金曜日" => 5,
            "毎週土曜日" => 6,
            "毎週日曜日" => 7,
        ];
        $closingday = $day_of_week_map[$shop->closingday];

        $reservationDate = $reservationDateTime->format('N');


        if ($closingday == $reservationDate) {
            return redirect()->back()->with('error', '予約日が定休日です。別の日を選択してください。');
        }


        $reservation->count_adult = $request->count_adult;
        $reservation->count_child = $request->count_child;
        $reservation->reserve_time = $request->reserve_time;
        $reservation->save();
    
        return redirect()->route('shops.index')->with('success', '予約を変更しました。');
    }


}
