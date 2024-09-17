@extends('layouts.app')
 
@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-2">
        @component('components.sidebar', ['categories' => $categories])
        @endcomponent
    </div>
<div class="container col-10">
    <div class="container">
        @if($category !== null)
        <a href="{{ route('shops.index') }}">ホーム</a> > {{ $category->name }}
        <h1>{{ $category->name }}の店舗一覧{{$total_count}}件</h1>
        @elseif ($keyword !== null)
        <a href="{{ route('shops.index') }}">ホーム</a> > 商品一覧
        <h1>"{{ $keyword }}"の検索結果{{$total_count}}件</h1>
        @endif
    </div>
   <h1 class="mb-3">店舗一覧</h1>
        @if(session('success'))
        <div class="alert text-center mx-auto alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div>
            Sort By
            @sortablelink('price','Price')

        <div class="row row-cols-xl-6 row-cols-md-3 row-cols-2 g-3 mb-2">
            @foreach($shops as $shop)
                <div class="col">
                    <a href="{{route('shops.show', $shop)}}">
                        @if ($shop->image != "")
                        <img src="{{ asset($shop->image) }}" class="w-100" >
                        @else
                        <img src="{{ asset('img/dummy.png')}}" class="w-100">
                        @endif
                    </a>
                    <a href="{{route('shops.show', $shop)}}" class="text-decoration-none">
                        <h2 class="mb-0">{{$shop->name}}</h2>
                    </a>
                    <p class="mb-0">￥{{number_format($shop->price)}}</p>
                </div>
            @endforeach
        </div>
        {{ $shops->appends(request()->query())->links() }}
</div>
</div>
</div>
@endsection