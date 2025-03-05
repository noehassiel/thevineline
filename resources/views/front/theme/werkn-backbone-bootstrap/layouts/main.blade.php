<!doctype html>
<html lang="es">

<head>
    @php
        $store_config = Nowyouwerkn\WeCommerce\Models\StoreConfig::first(['store_name', 'contact_email', 'phone']);
    @endphp

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $store_config->store_name ?? 'WeCommerce' }}</title>

    <!-- SEO -->
    <meta name="description" content="{{ $store_config->store_name ?? 'WeCommerce' }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('seo')

    <!-- FAVICON -->

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        @font-face {
            font-family: 'uqr';
            src: url('../fonts/u-q_r.otf');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'pqf';
            src: url('../fonts/p-q_f.woff2');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'nhm';
            src: url('../fonts/n-h_m.woff2');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'nhr';
            src: url('../fonts/n-h_r.woff2');
            font-weight: normal;
            font-style: normal;
        }
    </style>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Figtree:ital,wght@0,300..900;1,300..900&family=Sora:wght@100..800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/w-custom.css') }}">

    <link rel="stylesheet" href="https://use.typekit.net/lnu1fpi.css">
    @vite('resources/js/app.js')

    @stack('stylesheets')
</head>

<body>

    <div class="load-container">
        <div class="loading-screen"></div>
    </div>
    @if (Auth::check())
        @include('front.theme.werkn-backbone-bootstrap.layouts.partials._werkn_bar')
    @endif

    @include('front.theme.werkn-backbone-bootstrap.layouts.partials._headerbands')
    @include('front.theme.werkn-backbone-bootstrap.layouts.header')

    <main class="mb-5">
        @include('front.theme.werkn-backbone-bootstrap.layouts.partials._messages')
        @include('front.theme.werkn-backbone-bootstrap.layouts.partials._modal_messages')
        @yield('content')
    </main>

    @include('front.theme.werkn-backbone-bootstrap.layouts.footer')

    @include('front.theme.werkn-backbone-bootstrap.layouts.partials._cookies_notice')
    @include('front.theme.werkn-backbone-bootstrap.layouts.partials._modal_popup')


    <svg class="cursor" width="25" height="25" viewBox="0 0 25 25">
        <circle class="cursor__inner" cx="12.5" cy="12.5" r="6.25" />
    </svg>
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Owl Carousel -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/owl.carousel.min.js"></script>

    <!-- Icon Pack -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="{{ asset('js/w-scripts.js') }}"></script>

    @stack('scripts')

    @php
        $integrations = Nowyouwerkn\WeCommerce\Models\Integration::where('is_active', true)->get(['name', 'code']);
    @endphp

    @foreach ($integrations as $integration)
        <!-- {{ $integration->name }} -->
        {!! $integration->code !!}

        @if ($integration->name = 'Facebook Pixel')
            @stack('pixel-events')
        @endif
    @endforeach

    <script type="text/javascript">
        $('.contact_action').on('click', function() {
            fbq('track', 'Contact');
        });
    </script>
</body>

</html>
