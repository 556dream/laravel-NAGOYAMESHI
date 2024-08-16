@extends('layouts.app')
 
@section('content')
@csrf
<div class="container">
    <div class="row justify-content-center">
        <h1 class="mb-3">会員情報の編集</h1>

        @if (session('message'))
        {{ session('message') }}
        @endif
        <div class="mb-3">
            <a href="{{ route('shops.index') }}">戻る</a>
        </div>
        <form method="POST" action="{{ route('mypage') }}">
        @csrf
            <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="name">氏名</label>
                    </div>
                    <div class="collapse show editUserName">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="侍 太郎">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>氏名を入力してください</strong>
                        </span>
                        @enderror
                    </div>

                <br>
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="email">メールアドレス</label>
                    </div>
                    <div class="collapse show editUserMail">
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus placeholder="samurai@samurai.com">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>メールアドレスを入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <br>

                
        </form>
        <button type="submit" class="btn samuraimart-submit-button mt-3 w-25">
            保存
        </button>
    

    
    </div>
</div>
@endsection
