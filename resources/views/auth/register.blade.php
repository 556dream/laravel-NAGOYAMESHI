@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8">
            <h1 class="mb-3">新規会員登録</h1>

            <hr>            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group row mb-3">
                    <label for="name" class="col-md-5 col-form-label text-md-left fw-bold">
                        名前
                    </label>
                    <div class="col-md-7">
                        <input id="name" type="name" name="name" class="form-control @error('name') is-invalid @enderror  value="{{ old('name') }}" required autocomplete="name" placeholder="侍　太郎">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>名前を入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="email" class="col-md-5 col-form-label text-md-left fw-bold">
                        メールアドレス
                    </label>
                    <div class="col-md-7">
                        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror  value="{{ old('email') }}" required autocomplete="email" placeholder="samurai@samurai.com">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>メールアドレスを入力してください</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="password" class="col-md-5 col-form-label text-md-left fw-bold">
                        パスワード
                    </label>
                    <div class="col-md-7">
                        <input id="password" type="password" name="pasword" class="form-control @error('password') is-invalid @enderror required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{  $message  }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">
                        新規登録
                    </button>    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection