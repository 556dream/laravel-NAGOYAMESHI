<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class SubscriptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $intent = Auth::user()->createSetupIntent();

        return view('subscript.index', compact('intent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        $request->validate([
            'card-holder-name' => 'required',
        ]);

        $request->user()->newSubscription(
            'default', 'price_1P3iIsH0TourY52zk8BKzthx'
        )->create($request->payment_method);

        $user = Auth::user();
        $user->ispremium = 1;
        $user->save();
        
        return redirect()->route('mypage')->with('message', '有料会員に登録されました');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user= Auth::user();
        $intent = Auth::user()->createSetupIntent();
        return view('subscript.edit',compact('intent','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->user()->updateDefaultPaymentMethod($request->paymentMethodId);
        return redirect()->route('subscript.edit')->with('message', 'カードを変更しました');
    }

    public function cancel_confirm() {
        return view('subscript.cancel');
    }

    public function cancel() {
        Auth::user()->subscription('default')->delete();

        $user = Auth::user();
        $user->ispremium = 0;
        $user->save();

        return redirect()->route('mypage')->with('message', '有料会員を終了しました');
    }
}
