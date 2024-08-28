<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(Review $review)
    {
        $user = Auth::user();
        $reviews = Review::where('user_id', Auth::id())->orderBy('created_at', 'asc')->get();
 
        return view('users.review', compact('reviews'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);


        $review = new Review();
        $review->content = $request->input('content');
        $review->shop_id = $request->input('shop_id');
        $review->user_id = Auth::user()->id;
        $review->save();

        return back();
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('review.index')->with('flash_message', 'レビューを削除しました。');
    }

    public function edit(Review $review)
    {
        return view('users.reviewedit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $review->content = $request->content;
        $review->save();
    
        return redirect()->route('review.index')->with('success', 'レビューを変更しました。');
    }

    
}
