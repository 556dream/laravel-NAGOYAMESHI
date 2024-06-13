@extends('layouts.app')
 
@section('content')
@csrf
<div class="container">
    <div class="row justify-content-center">
        <h1 class="mb-3">マイページ</h1>

        @if (session('message'))
        {{ session('message') }}
        @endif
        <div class="mb-3">
            <a href="{{ route('shops.index') }}">戻る</a>
        </div>
        <div class="list-group">
            <a href="{{route('mypage.edit')}}" class="list-group-item">会員情報の編集</a>
            <a href="{{ route('mypage.edit') }}" class="list-group-item">メールアドレス変更</a>
            @if($user->ispremium==0)
            <a href="{{ route('subscript.index') }}" class="list-group-item">有料会員登録</a>
            @else
            <a href="{{ route('subscript.edit') }}" class="list-group-item">  クレジットカード情報の変更</a>
            <a href="{{ route('subscript.cancel') }}" class="list-group-item">有料会員の解約</a>
            @endif

            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout').submit(); class="list-group-item">ログアウト</a>
            <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
        </div>

        <h1>お気に入り</h1>
 
        <hr>

        <div class="row">
        @foreach ($favorite_shops as $favorite_shop)
        <div class="col-md-7 mt-2">
            <div class="d-inline-flex">
                <a href="{{ route('shops.show', $favorite_shop->id) }}" class="w-25">
                    <img src="{{ asset('img/dummy.png')}}" class="img-fluid w-100">
                </a>
                <div class="container mt-3">
                    <h5 class="w-100 samuraimart-favorite-item-text">{{ $favorite_shop->name }}</h5>
                    <h6 class="w-100 samuraimart-favorite-item-text">&yen;{{ $favorite_shop->price }}</h6>
                </div>
            </div>
        </div>
        <div class="col-md-2 d-flex align-items-center justify-content-end">
            <a href="{{ route('favorites.destroy', $favorite_shop->id) }}" class="samuraimart-favorite-item-delete" onclick="event.preventDefault(); document.getElementById('favorites-destroy-form{{$favorite_shop->id}}').submit();">
                削除
            </a>
            <form id="favorites-destroy-form{{$favorite_shop->id}}" action="{{ route('favorites.destroy', $favorite_shop->id) }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form>
        </div>
    @endforeach
 </div>

 <hr>
</div>
    </div>
</div>

<hr>
<Form method="POST" action="{{ route('mypage.destroy') }}">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <div class="btn dashboard-delete-link" data-bs-toggle="modal" data-bs-target="#delete-user-confirm-modal">退会する</div>

    <div class="modal fade" id="delete-user-confirm-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><label>本当に退会しますか？</label></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="閉じる">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">一度退会するとデータはすべて削除され復旧はできません。</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn">退会する</button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

