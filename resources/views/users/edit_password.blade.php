@extends('layouts.app')
 
@section('content')
<div class="container">
    <form method="post" action="{{route('mypage.update_password')}}">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div>
            <label for="password">新しいパスワード</label>

            <div>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div>
            <label for="password-confirm">確認用</label>

            <div>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div>
            <button type="submit" class="btn btn-danger">
                パスワード更新
            </button>
        </div>
    </form>
</div>
@endsection