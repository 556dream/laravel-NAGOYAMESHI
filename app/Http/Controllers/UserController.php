<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
 
    public function mypage()
    {
        $user = Auth::user();

        $premium = $user->ispremium;

        $favorite_shops = $user->favorite_shops;

        
        return view('users.mypage', compact('user', 'premium', 'favorite_shops'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user = Auth::user();

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user = Auth::user();

        $user->name = $request->input('name') ? $request->input('name') : $user->name;
        $user->email = $request->input('email') ? $request->input('email') : $user->email;
        $user->update();
        

        return to_route('mypage');
    }

    public function premium_delete(User $user)
    {
        $user = Auth::user();

        $premium = $user->ispremium;

        if($premium === 1) {
        $user->ispremium = false;
        $user->save();
        } else {
        $user->ispremium = true;
        $user->save();
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Auth::user()->delete();
        return redirect('/');
    }

}
