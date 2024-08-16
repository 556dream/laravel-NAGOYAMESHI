@extends('layouts.app')
 
@section('content')
@csrf
<div class="container">
    <div class="row justify-content-center">
        @if (session('message'))
        {{ session('message') }}
        @endif
        <div class="mb-3">
            <a href="{{ route('shops.index') }}">戻る</a>
        </div>
        <div class="list-group">
            
        </div>

        <h1>予約一覧</h1>
 
        <hr>

            <table class="table">
            <thead>
                <tr>
                    <th scope="col">店舗名</th>
                    <th scope="col">予約日時</th>
                    <th scope="col">人数</th>
                    <th scope="col"></th>
                </tr>
             </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>
                            <a href="{{ route('shops.show', $reservation->id) }}">
                                {{ $reservation->shop->name }}
                            </a>
                        </td>
                        <td>{{ date('Y年n月j日 G時i分', strtotime($reservation->reserve_time)) }}</td>
                        <td>大人{{ $reservation->count_adult }}名　子供{{ $reservation->count_child }}名</td>
                        <td>
                            @if ($reservation->reserve_time > now())
                                <div class="col-2">
                                    <a href="{{ route('reserve.edit', $reservation->id) }}">予約変更</a>
                                </div>
                                <form action="{{ route('reserve.destroy', $reservation) }}" method="POST" onsubmit="return confirm('予約をキャンセルしてもよろしいですか？');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">キャンセル</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


@endsection
