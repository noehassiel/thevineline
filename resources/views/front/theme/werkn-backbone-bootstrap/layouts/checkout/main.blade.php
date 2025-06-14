<!doctype html>
<html class="no-js" lang="">

<head>
    @php
        $store_config = Nowyouwerkn\WeCommerce\Models\StoreConfig::first();
    @endphp

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $store_config->store_name ?? 'The Vineline' }}</title>
    <meta name="description" content="{{ $store_config->store_name ?? 'The Vineline' }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @stack('seo')

    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="The Vineline" />
    <link rel="manifest" href="/site.webmanifest" />
    <meta name="msapplication-TileColor" content="#ff0000">
    <meta name="theme-color" content="#000000">

    <!-- CSS here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="{{ asset('css/w-custom.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/w-checkout.css') }}" rel="stylesheet" type="text/css" />

    @stack('stylesheets')
</head>

<body>
    @if (Auth::check())
        @include('front.theme.werkn-backbone-bootstrap.layouts.partials._werkn_bar')
    @endif
    @include('front.theme.werkn-backbone-bootstrap.layouts.checkout.header')

    <main>
        <div class="loader-standby loader-hidden">
            <div class="info-loader">
                <div class="lds-ripple">
                    <div></div>
                    <div></div>
                </div>
                <h2>-</h2>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col">
                    @include('front.theme.werkn-backbone-bootstrap.layouts.partials._messages')
                    @include('front.theme.werkn-backbone-bootstrap.layouts.partials._messages_errors')
                </div>
            </div>
        </div>

        @yield('content')
    </main>

    @include('front.theme.werkn-backbone-bootstrap.layouts.checkout.footer')

    @include('front.theme.werkn-backbone-bootstrap.layouts.partials._cookies_notice')
    @include('front.theme.werkn-backbone-bootstrap.layouts.partials._modal_popup')

    <!-- Bootstrap -->
    <script src="{{ asset('themes/werkn-backbone-bootstrap/js/vendor/jquery-3.5.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script type="text/javascript">
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));

        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        });
    </script>

    @stack('scripts')

    @php
        $integrations = Nowyouwerkn\WeCommerce\Models\Integration::all();
    @endphp

    @foreach ($integrations as $integration)
        <!-- {{ $integration->name }} -->
        {!! $integration->code !!}

        @if ($integration->name = 'Facebook Pixel')
            @stack('pixel-events')
        @endif
    @endforeach

    @if ($store_config->has_pixel() == null)
        <script type="text/javascript">
            fbq('track', 'InitiateCheckout');
        </script>
    @endif

    <script type="text/javascript">
        $('.contact_action').on('click', function() {
            fbq('track', 'Contact');
        });
    </script>
</body>

</html>
