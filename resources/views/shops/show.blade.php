@extends('layouts.app')
 
@section('content')

<div class="container">
    <h1 class="mb-3">{{$shop->name}}
    </h1>
        <div class="mb-3">
            <a href="{{route('shops.index')}}">戻る</a>
        </div>
    <div class="container p-0 mb-4">
        <div class="row g-3">
            <div class="col-12 col-lg-4">
                @if ($shop->image)
                <img src="{{ asset($shop->image) }}" class="w-100" >
                @else
                <img src="{{ asset('img/dummy.png')}}" class="w-100">
                @endif
            </div>
            <div class="col">
                <div class="border-bottom mb-2">
                    <p class="mb-2">
                        <span class="fw-bold">カテゴリ</span>
                    </p>
                </div>
                <div class="border-bottom mb-2">
                    <p class="mb-2">
                        <span class="fw-bold">予算：</span>{{ number_format($shop->price) }}円
                    </p>
                </div>
                <div class="border-bottom mb-2">
                    <p class="mb-2">
                        <span class="fw-bold">営業時間：</span>{{date ("H:i", strtotime($shop->openingtime))}}～{{date("H:i", strtotime($shop->closingtime))}}
                        <span class="fw-bold">定休日：</span>{{$shop->closingday}}
                    </p>
                </div>
                <div class="border-bottom mb-2">
                    <p class="mb-2">
                        {{$shop->description}}
                    </p>
                </div>
                <div class="border-bottom mb-2">
                    <p class"mb-2">
                        <span class="fw-bold">住所：</span>{{$shop->address}}
                        <span class="fw-bold">電話番号：</span>{{$shop->phone}}
                    </p>
                </div>
                @if($premium === 1)
                @if(Auth::user()->favorite_shops()->where('shop_id', $shop->id)->exists())
                <a href="{{ route('favorites.destroy', $shop->id) }}" class="btn" onclick="event.preventDefault(); document.getElementById('favorites-destroy-form').submit();">
                    <i class="fa fa-heart"></i>
                        お気に入り解除
                </a>
                @else
                <a href="{{ route('favorites.store', $shop->id) }}" class="btn" onclick="event.preventDefault(); document.getElementById('favorites-store-form').submit();">
                    <i class="fa fa-heart"></i>
                        お気に入り
                </a>
                @endif
                @endif
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row border-bottom">
            <h4>レビュー</h4>
            @foreach($reviews as $review)
            <div class="">
                <p class"h3">{{$review->content}}</p>
                <label>{{$review->created_at}} {{$review->user->name}}</label>
            </div>
            @endforeach
        </div>
    
            <div class="row">
                @if ($premium === 1)
                <div>
                    <h4>予約の送信</h4>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('reserve.store') }}">
                        @csrf
                        <label>大人の人数</label>
                        <input type="hidden" value="{{$shop->id}}" name="id">
                        <select name="count_adult">
                            <option value="1">１人</option>
                            <option value="2">２人</option>
                            <option value="3">３人</option>
                            <option value="4">４人</option>
                            <option value="5">５人</option>
                            <option value="6">６人</option>
                            <option value="7">７人</option>
                            <option value="8">８人</option>
                        </select>
                        <label>子供の人数</label>
                        <select name="count_child">
                            <option value="0">０人</option>
                            <option value="1">１人</option>
                            <option value="2">２人</option>
                            <option value="3">３人</option>
                            <option value="4">４人</option>
                            <option value="5">５人</option>
                            <option value="6">６人</option>
                            <option value="7">７人</option>
                            <option value="8">８人</option>
                        </select>
                        <input type="datetime-local" name="reserve_time" min="2024-04-01T00:00" max="2024-12-31T23:59">
                        <button type="submit" class="btn">予約</button>
                    </form>
                    

                </div>
                <div>
                    <form method="POST" action="{{ route('reviews.store') }}">
                        @csrf
                        <h4>レビュー内容</h4>
                        @error('content')
                            <strong>レビュー内容を入力してください</strong>
                        @enderror
                        <textarea name="content" class="form-control m-2"></textarea>
                        <input type="hidden" value="{{$shop->id}}" name="shop_id">
                        <button type="submit" class="btn">レビューを追加</button>
                    </form>
                </div>
                @endif

                
            </div>

            <form id="favorites-destroy-form" action="{{ route('favorites.destroy', $shop->id) }}" method="POST" class="d-none">
                     @csrf
                     @method('DELETE')
                 </form>
                 <form id="favorites-store-form" action="{{ route('favorites.store', $shop->id) }}" method="POST" class="d-none">
                     @csrf
                 </form>
    
</div>
@endsection

