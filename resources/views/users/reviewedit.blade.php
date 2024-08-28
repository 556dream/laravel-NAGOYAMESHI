@extends('layouts.app')
 
@section('content')
@csrf
<div class="container">
    <div class="row justify-content-center">
        <h1 class="mb-3">レビューの編集</h1>

        @if (session('message'))
        {{ session('message') }}
        @endif
        <div class="mb-3">
            <a href="{{ route('shops.index') }}">戻る</a>
        </div>
        
    
        <form method="POST" action="{{ route('review.update', $review->id ) }}">
            @csrf
            @method('PUT')
            <lavel>{{ $review->shop->name }}</label>
            
            <div>
                <lavel>レビュー内容</lavel>
                <textarea id="content" name="content">{{ old('content', $review->content) }}</textarea>
            </div>
                           
            <button type="submit" class="btn">レビュー更新</button>
        </form>
                    
                    
    </div>
</div>
@endsection