@extends('layouts.app')

@section('content')
    <nav class="my-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('mypage') }}">マイページ</a></li>
            <li class="breadcrumb-item active" aria-current="page">有料プラン登録</li>
        </ol>
    </nav>

    <div class="container nagoyameshi-container pb-5">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8">

                <h1 class="mb-3 text-center">有料プラン登録</h1>
                <form id="setup-form" action="{{ route('subscript.register') }}" method="post">
                    @csrf
                    <input id="card-holder-name" type="text" placeholder="カード名義人" name="card-holder-name">
                    <br>
                    <div id="card-element"></div>
                    <br>
                    <button id="card-button" data-secret="{{ $intent->client_secret }}">サブスクリプション</botton>
                </form>
                
            </div>
        </div>
    </div>

@endsection

@push('scripts')
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
                console.log('error');
            } else {
                const form = document.getElementById('setup-form');
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'payment_method');
                hiddenInput.setAttribute('value', setupIntent.payment_method);
                form.appendChild(hiddenInput);

                form.submit();
            }
        });
    </script>

@endpush

