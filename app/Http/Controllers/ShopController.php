<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->category !== null) {
            $shops = Shop::where('category_id', $request->category)->sortable()->paginate(15);
            $total_count = Shop::where('category_id', $request->category)->count();
            $category = Category::find($request->category);
        } else {
            $shops = Shop::sortable()->paginate(15);
            $total_count = "";
            $category = null;
        }
        
        $categories = Category::all();

        $array = compact('shops', 'categories', 'category', 'total_count');
        //$this->redirect('shops.index',$array);

        if(Auth::check()){
            return view('shops.index',$array);
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
        $reviews = $shop->reviews()->get();
        
        //自分自身のidを持ってくる
        $user = Auth::user();
        //ユーザーの有料会員かどうかの情報を渡す
        $premium = $user->ispremium;

        return view('shops.show', compact('shop', 'reviews', 'premium'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        //
    }

    public function redirect($redirectTo, $informations)
    {
        var_dump(Auth::check());
        if(Auth::check()){
            return view($redirectTo, $informations);
        } else {
            redirect()->route('login');
        }
    }
}
