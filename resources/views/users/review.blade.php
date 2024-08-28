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
                    <th scope="col">コメント</th>
                    <th scope="col"></th>
                </tr>
             </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td>
                            <a href="{{ route('shops.show', $review->id) }}">
                                {{ $review->shop->name }}
                            </a>
                        </td>
                        <td>{{ $review->content }}</td>
                        <td>
                            <div class="col-2">
                                <a href="{{ route('review.edit', $review->id) }}">レビュー編集</a>
                            </div>
                            <form action="{{ route('review.destroy', $review) }}" method="POST" onsubmit="return confirm('レビューを削除してもよろしいですか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


@endsection
