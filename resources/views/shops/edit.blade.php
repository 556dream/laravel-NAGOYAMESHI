@extends('layouts.app')
 
@section('content')
@csrf
<div class="container">
    <div class="row justify-content-center">
        <h1 class="mb-3">予約情報の編集</h1>

        @if (session('message'))
        {{ session('message') }}
        @endif
        <div class="mb-3">
            <a href="{{ route('shops.index') }}">戻る</a>
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
                    @for ($i = 1; $i <= 8; $i++)
                    <option value="{{ $i }}" {{ $reservation->count_child == $i ? 'selected' : '' }}>{{ $i }}人</option>
                    @endfor
                        </select>
                        <input type="datetime-local" name="reserve_time" min="2024-04-01T00:00" max="2024-12-31T23:59" value="{{ \Carbon\Carbon::parse($reservation->reserve_time)->format('Y-m-d\TH:i') }}">
                        
                        <button type="submit" class="btn">予約更新</button>
                    </form>
                    
                    
    </div>
</div>
@endsection
