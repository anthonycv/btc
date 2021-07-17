@extends('layout.structure')

@section('css')

@endsection

@section('counter')
    <div class="container d-flex flex-column align-items-center">

        <h1>Bticoin Live Price</h1>
        <h2>The price of bitcoin is updated every 10 seconds</h2>
        <div class="countdown d-flex justify-content-center">
            <div>
                <h2 id="priceDay" class="animate">0</h2>
                <h4>Price 24H</h4>
            </div>
            <div>
                <h2 id="volumeDay" class="animate">0</h2>
                <h4>Volume 24H</h4>
            </div>
            <div>
                <h2 id="LastTradePrice" class="animate">0</h2>
                <h4>Last trade price</h4>
            </div>
            <div>
                <h2 id="variationPercentage" class="animate">0%</h2>
                <h4>Variation percentage</h4>
            </div>
        </div>
    </div>
@endsection

@section('About Us')
    <div class="container">
        <div class="row content">
            <div class="col-lg-6">
                <h2>Eum ipsam laborum deleniti velitena</h2>
                <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assum perenda sruen jonee trave</h3>
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0">
                <p>
                    Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                    voluptate
                    velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                    sunt in
                    culpa qui officia deserunt mollit anim id est laborum
                </p>
                <ul>
                    <li><i class="bi bi-check"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequa</li>
                    <li><i class="bi bi-check"></i> Duis aute irure dolor in reprehenderit in voluptate velit</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const data = {
            crypto: 'BTC',
            currency: 'USD'
        };
        let lastPrice = 0;
        let percentageDiff = 0;
        getBtcPriceInfo();
        setInterval(function(){
            getBtcPriceInfo();
        }, 10000);
        function getBtcPriceInfo() {
            $.get("/api/get-btc-price", data, function (data) {
                if (data.status) {
                    let lastTradePRice = data.data.last_trade_price.toFixed(2);
                    percentageDiff = ((lastTradePRice / lastPrice) * 100) - 100;
                    lastPrice = lastTradePRice;
                    percentageDiff = (percentageDiff == 'Infinity') ? 0 : percentageDiff;
                    $('#priceDay').html(data.data.price_24h.toFixed(2));
                    $('#volumeDay').html(data.data.volume_24h.toFixed(2));
                    $('#variationPercentage').html(percentageDiff.toFixed(2) + '%');
                    $('#LastTradePrice').html(lastTradePRice);
                    $('.animate').animate({height: 'toggle'});
                    setTimeout(function() {
                        $('.animate').animate({height: 'toggle'});
                    }, 550);
                } else {
                    alert('ERROR: ' + data.message);
                    console.log(data);
                }
            });
        }
    </script>
@endsection
