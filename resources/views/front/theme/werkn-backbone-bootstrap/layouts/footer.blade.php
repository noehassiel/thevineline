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

<footer class="bg-dark text-white pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('index') }}">
                    @if (!empty($store_config))
                        @if ($store_config->store_logo == null)
                            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="img-fluid mb-5"
                                width="300">
                        @else
                            <img src="{{ asset('assets/img/' . $store_config->store_logo) }}" alt="Logo"
                                class="img-fluid mb-5" width="300">
                        @endif
                    @else
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="img-fluid mb-5"
                            width="300">
                    @endif
                </a>
            </div>

            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4">

                    </div>

                    <div class="col-md-4">
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

                    <div class="col-md-4">
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
            </div>
        </div>

        <div class="row list-unstyled reassurance-list text-center mt-5">
            @if (!empty($card_payment))
                <div class="col mt-4">
                    <img src="{{ asset('img/icons/card-info.png') }}" style="height: 35px; width: auto !important;">
                    <p class="mb-0 mt-3">Aceptamos Todas las Tarjetas de Crédito</p>
                </div>
            @endif

            <div class="col mt-4 trust-logo">
                <script type="text/javascript">
                    //<![CDATA[
                    var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" :
                        "http://www.trustlogo.com/");
                    document.write(unescape("%3Cscript src='" + tlJsHost +
                        "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
                    //]]>
                </script>
                <script language="JavaScript" type="text/javascript">
                    TrustLogo("https://www.positivessl.com/images/seals/positivessl_trust_seal_md_167x42.png", "POSDV", "none");
                </script>

                <p class="mb-0 mt-3">Sitio Seguro con Encriptación de 256-Bits</p>
            </div>

            @if (!empty($paypal_payment))
                <div class="col mt-4">
                    <img src="{{ asset('assets/img/brands/paypal.png') }}"
                        style="height: 35px; width: auto !important;">
                    <p class="mb-0 mt-3">Aceptamos pagos por medio de Paypal</p>
                </div>
            @endif

            @if (!empty($mercado_payment))
                <div class="col mt-4">
                    <img src="{{ asset('assets/img/brands/mercado-pago.png') }}"
                        style="height: 35px; margin-bottom: 5px; width: auto !important;">
                    <p>Aceptamos pagos por medio de MercadoPago</p>
                </div>
            @endif

            @if (!empty($cash_payment))
                <div class="col mt-4">
                    <img src="{{ asset('assets/img/brands/oxxopay.png') }}"
                        style="padding-top: 5px; height: 35px; width: auto !important;">
                    <p class="mb-0 mt-3">Aceptamos pagos en efectivo en Oxxo</p>
                </div>
            @endif
        </div>
    </div>
</footer>

<!-- Footer -->
<div class="post-footer bg-light pt-3 pb-3">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="text-uppercase mb-0" style="font-size: .8em">&copy; {{ Carbon\Carbon::now()->format('Y') }}
                    <a
                        href="index.html">{{ $store_config->store_name ?? 'LagerHaus powered by Werkn WeCommerce' }}</a>.
                    Todos los derechos reservados</p>
            </div>
        </div>
    </div>
</div>
