@extends('layouts.app')
 
 @section('content')
 <div class="container">
    <div class="row justify-content-center">
    <div>
        <span>
            <a href="{{ route('mypage') }}">マイページ</a> > 有料会員の解約
        </span>

        <p>有料会員の解約</p>
        <hr>

        <form action="{{ route('subscript.cancel') }}" method="POST">
          @csrf
            <button>有料会員を解約する</button>
        </form>

    </div>
    </div>
</div>
@endsection