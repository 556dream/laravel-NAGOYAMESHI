@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <span>
                <a href="{{ route('mypage') }}">マイページ</a> > クレジットカード情報の変更
            </span>

            <p class="display-6">クレジットカード情報の変更</p>
            <hr>
            <!-- 登録中のカード情報 -->
            <div class="d-flex justify-content-between">
                @if (session('message'))
                    {{ session('message') }}
                @endif
                <label class="col-md-5">登録中のクレジットカード</label>
            </div>

            <div class="form-group row">
                <label for="name">カード名義人</label>
                <div>
                    <p>{{$user->defaultPaymentMethod()->billing_details->name}}</p>
                </div>
                <label for="name">カード番号</label>
                <div class="col-md-4">
                    <p>**** **** **** {{$user->defaultPaymentMethod()->card->last4}}</p>
                </div>    
            </div>

            <hr>

            <form id="card_form" action="{{ route('subscript.update') }}" method="POST">
                @csrf
                <!-- 新しいカード情報 -->
                <div>
                    <label>新しいクレジットカード</label>
                </div>
                <!-- カード名義人 -->
                <div>
                    <label for="name">カード名義人</label>
                    <div>
                        <input name="card-holder-name" id="card-holder-name" type="text">
                    </div>
                <!-- カード番号 -->
                    <label>カード番号</label>
                    <div>
                        <div id="card-element"></div>  
                        <input name="payment_method" type="hidden">                                
                    </div>
                </div>
                
                <hr>
                <button type="button" id="card-button" data-secret="{{ $intent->client_secret }}">登録</button>
            </form>
                
                @error('card-holder-name')
                <p>カード名義人を入力してください</p>
                @enderror

            <script src="https://js.stripe.com/v3/"></script>
            <script>
                const stripe = Stripe("{{env('STRIPE_KEY')}}");

                const elements = stripe.elements();
                const cardElement = elements.create('card',{hidePostalCode: true});

                cardElement.mount('#card-element');

                const cardHolderName = document.getElementById('card-holder-name');
                const cardButton = document.getElementById('card-button');
                const clientSecret = cardButton.dataset.secret;

                cardButton.addEventListener('click', async (e) => {
                const { setupIntent, error } = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: { name: cardHolderName.value }
                        }
                    }
                );

                if (error) {
                    console.log(error);
                } else {
                const form = document.getElementById('card_form');
                form.payment_method.value = setupIntent.payment_method;
                form.submit();
                }
            });
            </script>

        </div>
    </div>
</div>
@endsection