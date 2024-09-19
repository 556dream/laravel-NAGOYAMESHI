@extends('layouts.app')
 
@section('content')
@csrf
<div class="container">
    <div class="row justify-content-center">
        <h1 class="mb-3">予約情報の編集</h1>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="mb-3">
            <a href="{{ route('shops.index') }}">戻る</a>
        </div>

        <div class="container p-0 mb-4">
        <div class="container p-0 mb-4">
        <div class="row g-3">
            <div class="col-12 col-lg-4">
                @if ($reservation->shop->image)
                <img src="{{ asset($reservation->shop->image) }}" class="w-100" >
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
                        <span class="fw-bold">予算：</span>{{ number_format($reservation->shop->price) }}円
                    </p>
                </div>
                <div class="border-bottom mb-2">
                    <p class="mb-2">
                        <span class="fw-bold">営業時間：</span>{{date ("H:i", strtotime($reservation->shop->openingtime))}}～{{date("H:i", strtotime($reservation->shop->closingtime))}}
                        <span class="fw-bold">定休日：</span>{{$reservation->shop->closingday}}
                    </p>
                </div>
                <div class="border-bottom mb-2">
                    <p class="mb-2">
                        {{$reservation->shop->description}}
                    </p>
                </div>
                <div class="border-bottom mb-2">
                    <p class"mb-2">
                        <span class="fw-bold">住所：</span>{{$reservation->shop->address}}
                        <span class="fw-bold">電話番号：</span>{{$reservation->shop->phone}}
                    </p>
                </div>
     
    
        <form method="POST" action="{{ route('reserve.update', $reservation->id ) }}">
            @csrf
            @method('PUT')
                <label>大人の人数</label>
                        <select name="count_adult">
                        @for ($i = 1; $i <= 8; $i++)
                    <option value="{{ $i }}" {{ $reservation->count_adult == $i ? 'selected' : '' }}>{{ $i }}人</option>
                @endfor
                        </select>
                <label>子供の人数</label>
                    <select name="count_child">
                    @for ($i = 0; $i <= 8; $i++)
                    <option value="{{ $i }}" {{ $reservation->count_child == $i ? 'selected' : '' }}>{{ $i }}人</option>
                    @endfor
                        </select>
                        <input type="datetime-local" name="reserve_time" min="2024-04-01T00:00" max="2024-12-31T23:59" value="{{ \Carbon\Carbon::parse($reservation->reserve_time)->format('Y-m-d\TH:i') }}">
                        <input type="hidden" name="id" value="{{$reservation->shop_id}}">
                        
                        <button type="submit" class="btn">予約更新</button>
                    </form>
                    
                    
    </div>
</div>
@endsection
