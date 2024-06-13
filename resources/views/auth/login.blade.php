@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
            <h1 class="mb-3">ログイン</h1>

            <hr>            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group row mb-3">
                    <label for="email" class="col-md-5 col-form-label text-md-left fw-bold">
                        メールアドレス
                    </label>
                    <div class="col-md-7">
                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror  value="{{ old('email') }}" required autocomplete="email" placeholder="samurai@samurai.com">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>メールアドレスが正しくない可能性があります。</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="password" class="col-md-5 col-form-label text-md-left fw-bold">
                        パスワード
                    </label>
                    <div class="col-md-7">
                        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>パスワードが正しくない可能性があります。</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label w-100" for="remember">
                            次回から自動的にログインする
                        </label>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="btn mt-3">
                        ログイン
                    </button>    
                </div>
            </form>
            <hr>
            <div class="mb-2">
                <a class="btn p-0" href="{{ route('password.request') }}">
                    パスワードをお忘れの場合
                </a>
            </div>
            <div class="mb-2">
                <a class="btn p-0" href="{{ route('register') }}">
                    新規登録
                </a>
            </div>
        </div>
    </div>
</div>
@endsection