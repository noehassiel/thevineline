@php
    $legals = Nowyouwerkn\WeCommerce\Models\LegalText::orderBy('priority', 'asc')->orderBy('created_at', 'asc')->get();
    $faq = Nowyouwerkn\WeCommerce\Models\FAQ::first();

    $card_payment = Nowyouwerkn\WeCommerce\Models\PaymentMethod::where('supplier', '!=', 'Paypal')
        ->where('type', 'card')
        ->where('is_active', true)
        ->first();
    $cash_payment = Nowyouwerkn\WeCommerce\Models\PaymentMethod::where('type', 'cash')
        ->where('is_active', true)
        ->first();
    $paypal_payment = Nowyouwerkn\WeCommerce\Models\PaymentMethod::where('supplier', 'Paypal')
        ->where('is_active', true)
        ->first();
    $mercado_payment = Nowyouwerkn\WeCommerce\Models\PaymentMethod::where('supplier', 'MercadoPago')
        ->where('is_active', true)
        ->first();

    $categories = Nowyouwerkn\WeCommerce\Models\Category::where('parent_id', 0)
        ->orWhere('parent_id', null)
        ->get(['name', 'slug']);
@endphp


<footer>
    <div class="content">
        <div class="row">
            <div class="col-md-6 mb-md-0 mb-4 d-flex justify-content-center">
                <img src="{{ asset('assets/img/tvl/logo.svg') }}" alt="" style="width: 80%">
            </div>
            <div class="col-md-3 col-6">
                <ul class="list-unstyled">
                    <li class="mb-3"><strong>Tienda</strong></li>
                    <li><a href="{{ route('index') }}">Inicio</a></li>
                    <li><a href="{{ route('catalog.all') }}">Catálogo</a></li>
                    @foreach ($categories as $category)
                        <li>
                            <a href="{{ route('catalog', $category->slug) }}">{{ $category->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3 col-6">
                <ul class="list-unstyled">
                    <li class="mb-3"><strong>Soporte y Ayuda</strong></li>
                    @foreach ($legals as $legal)
                        <li>
                            <a href="{{ route('legal.text', $legal->slug) }}">
                                {{ $legal->title }}
                            </a>
                        </li>
                    @endforeach

                    @if (!empty($faq))
                        <li><a href="{{ route('faqs.text') }}">Preguntas Frecuentes</a></li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="row flex-md-row flex-column-reverse" style="margin-top: 8rem">
            <div class="col-md-6">
                <div class="d-flex align-items-center justify-content-md-start justify-content-between"
                    style="gap: 2.6rem">
                    @if (!empty($card_payment))
                        <img src="{{ asset('assets/img/visa.webp') }}" alt="visa" width="46" height="15">
                        <img src="{{ asset('assets/img/master.webp') }}" alt="Mastercard" width="50" height="30">
                    @endif

                    @if (!empty($paypal_payment))
                        <img src="{{ asset('assets/img/paypal.webp') }}" alt="paypal" width="60" height="16">
                    @endif

                    @if (!empty($mercado_payment))
                        <div class="col mt-4">
                            <img src="{{ asset('assets/img/brands/mercado-pago.png') }}"
                                style="height: 35px; margin-bottom: 5px; width: auto !important;">
                        </div>
                    @endif

                    @if (!empty($cash_payment))
                        <div class="col mt-4">
                            <img src="{{ asset('assets/img/brands/oxxopay.png') }}"
                                style="padding-top: 5px; height: 35px; width: auto !important;">
                        </div>
                    @endif

                    <script type="text/javascript">
                        //<![CDATA[
                        var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" :
                            "http://www.trustlogo.com/");
                        document.write(unescape("%3Cscript src='" + tlJsHost +
                            "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
                        //]]>
                    </script>
                </div>
            </div>
            <div class="col-md-3">
                <div class="d-flex align-items-center justify-content-md-start justify-content-center">
                    <a href="https://www.instagram.com/the.vineline/" class="btn btn-media">
                        <ion-icon name="logo-instagram"></ion-icon>
                    </a>
                </div>
            </div>

            <div class="col-md-3 d-md-block d-none d-flex justify-content-end">
                <img src="{{ asset('assets/img/tvl/iso.svg') }}" alt="" width="30">
            </div>
        </div>
    </div>

    <div class="d-flex align-items-start justify-content-between">
        <p>&copy; {{ Carbon\Carbon::now()->format('Y') }} The Vineline</p>

        <p>Website designed and coded by <br><a href="">noehassiel</a></p>
    </div>

    <div class="highlight"></div>
</footer>
