@extends('front.theme.werkn-backbone-bootstrap.layouts.main')

@push('seo')
@endpush

@push('stylesheets')
@endpush

@section('content')

    <!-- Preloader starts -->
    <div class="preloader">
        <div class="wrapper-loader">
            <div class="position-relative w-100">
                <img src="{{ asset('assets/img/tvl/tvl-white.png') }}" alt="thevineline" style="width: 64px"
                    class="left-star star-loader">
                <img src="{{ asset('assets/img/tvl/tvl-white.png') }}" alt="thevineline" style="width: 64px"
                    class="med-star star-loader">
                <img src="{{ asset('assets/img/tvl/tvl-white.png') }}" alt="thevineline" style="width: 64px"
                    class="right-star star-loader">
            </div>
            <img src="{{ asset('assets/img/tvl/tvl-logo-white.png') }}" alt="thevineline" width="120"
                style="margin-top: 6rem" class="logo-loader">
        </div>
    </div>

    @php
        $banner_main = Nowyouwerkn\WeCommerce\Models\Banner::where('is_promotional', false)
            ->where('priority', 1)
            ->first();
    @endphp

    <section class="vine-section">
        <div class="section-body">
            <div class="hero vine-container">

                @if (empty($banner_main))
                    <div class="vine-container-bg">
                        <img src="{{ asset('themes/thevineline/img/hero.jpg') }}" alt="thevineline">
                        <div class="overlay"></div>
                    </div>
                    <div class="vine-container-content text-center">

                        <div></div>

                        <div class="col-12 d-flex flex-column align-items-center">

                            <img class="brand-name mb-4" src="{{ asset('assets/img/tvl/tvl-logo-white.png') }}"
                                alt="thevineline" width="150">

                            <h1 class="title-1"><span>S</span>ee the world, not your screen.</h1>
                            <a class="vine-btn" href="{{ route('catalog.all') }}" class="btn btn-primary">Comprar</a>
                        </div>


                        <div class="col-md-8">
                            <h2 class="hero-subtitle">Ai Pin is your intelligent, voice-powered wearable companion — keeping
                                you
                                connected and in
                                the
                                moment with just a touch.
                            </h2>
                        </div>
                    </div>
                @else
                    <div class="vine-container-bg">
                        <img src="{{ asset('img/banners/' . $banner_main->image) }}" alt="thevineline">
                        <div class="overlay"></div>
                    </div>

                    <div class="vine-container-content text-center">
                        <div></div>

                        <div class="col-12">
                            <h3 class="brand-name">The Vineline</h3>
                            <h1 class="title-1">{{ $banner_main->title }}</h1>

                            <a class="hero-btn" href="{{ $banner_main->link }}"
                                class="btn btn-primary">{{ $banner_main->text_button }}</a>
                        </div>


                        <div class="col-md-8">
                            <h2 class="hero-subtitle">{{ $banner_main->subtitle }}
                            </h2>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <div class="vine-section title-editions">
        <div class="section-body">
            <div class="vine-container">
                <div class="vine-container-content">
                    <h2><span>E</span>xpression <br> on your own terms</h2>
                </div>
            </div>
        </div>
    </div>

    <section class="editions">
        <div class="division-line"></div>
        <div class="sticky-element vine-section">
            <div class="section-body">
                <div class="vine-container">
                    <div class="container-fluid px-0">

                        <div class="row">
                            <div class="col-md-6 px-0 cards-wrapper">
                                <div class="card-half card-left">
                                    <div class="card-slide">
                                        <div class="slide-content">
                                            <div class="slide-text">
                                                <div>The spirit of street culture with high-quality craftsmanship</div>
                                                <a href="">Comprar</a>
                                            </div>
                                            <div class="slide-bg">
                                                <div class="overlay"></div>
                                                <img src="{{ asset('themes/thevineline/img/video-vl1.jpg') }}" alt="thevineline">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-slide">
                                        <div class="slide-content">
                                            <div class="slide-text white">
                                                <div>The spirit of street culture with high-quality craftsmanship</div>
                                                <a href="">Comprar</a>
                                            </div>
                                            <div class="slide-bg">
                                                <div class="overlay"></div>
                                                <img src="{{ asset('themes/thevineline/img/video-vl2.jpg') }}" alt="thevineline">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 px-0 cards-wrapper">
                                <div class="card-half card-right">
                                    <div class="card-slide">
                                        <div class="slide-content">
                                            <div class="slide-text">
                                                <div>The spirit of street culture with high-quality craftsmanship</div>
                                                <a href="">Comprar</a>
                                            </div>
                                            <div class="slide-bg">
                                                <div class="overlay"></div>
                                                <img src="{{ asset('themes/thevineline/img/video-vl3.jpg') }}" alt="thevineline">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-slide">
                                        <div class="slide-content">
                                            <div class="slide-text white">
                                                <div>The spirit of street culture with high-quality craftsmanship</div>
                                                <a href="">Comprar</a>
                                            </div>
                                            <div class="slide-bg">
                                                <div class="overlay"></div>
                                                <img src="{{ asset('themes/thevineline/img/video-vl4.jpg') }}" alt="thevineline">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="editions-mobile">
        <div class="container-fluid px-0">

            <div class="row w-100 m-0">
                <div class="col-md-12 px-0">
                    <div class="card-mobile">
                        <div class="card-slide">
                            <div class="slide-content">
                                <div class="slide-text">
                                    <div>The spirit of street culture with high-quality craftsmanship</div>
                                    <a href="">Comprar</a>
                                </div>
                                <div class="slide-bg">
                                    <div class="overlay"></div>
                                    <img src="{{ asset('themes/thevineline/img/video-vl1.jpg') }}" alt="thevineline">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 px-0">
                    <div class="card-mobile">
                        <div class="card-slide">
                            <div class="slide-content">
                                <div class="slide-text white">
                                    <div> The spirit of street culture with high-quality craftsmanship</div>
                                    <a href="">Comprar</a>
                                </div>
                                <div class="slide-bg">
                                    <div class="overlay"></div>
                                    <img src="{{ asset('themes/thevineline/img/video-vl2.jpg') }}" alt="thevineline">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- best-selling-area -->
    <section class="vine-section fav-products">
        <div class="section-body">
            <div class="vine-container">
                <div class="vine-container-content">

                    <div class="d-flex justify-content-between align-items-center fav-heading">
                        <h2><span>S</span>hop</h2>
                        <a href="{{ route('catalog.all') }}" class="vine-btn">Comprar ahora</a>
                        <h2><span>N</span>ow</h2>
                    </div>

                    <div class="d-flex justify-content-between flex-products">
                        @foreach ($products_favorites->take(4) as $product_info)
                            @include('front.theme.werkn-backbone-bootstrap.layouts.utilities._product_card')
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="vine-section">
        <div class="section-body">
            <div class="mission vine-container">
                <div class="vine-container-bg js-parallax-in">
                    <img src="{{ asset('themes/thevineline/img/mission.jpg') }}" alt="thevineline">
                </div>
                <div class="vine-container-content">
                    <div class="container-fluid">
                        <div class="col-md-12 mission-manifesto">
                            <div class="blur-text blur-text--2" data-effect-2>
                                The mental equipment of the average individual consists of a mass of judgments on most of
                                the subjects which touch his daily physical or mental life.
                            </div>
                        </div>

                        <div class="mission-visual col-md-12">
                            <h5>We are here</h5>
                            <div class="mission-img js-parallax-in">
                                <img src="{{ asset('themes/thevineline/img/mission-center.jpg') }}" alt="thevineline">
                            </div>
                            <h5>thanks to him</h5>
                        </div>

                        <div class="mission-bottom col-md-12 text-center">
                            <h4>We are here</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="vine-section min-catalog">
        <div class="section-body">
            <div class="vine-container">
                <div class="vine-container-bg">
                </div>
                <div class="vine-container-content">
                    <div class="d-flex justify-content-between align-items-center mb-4 min-heading">
                        <h1 class="mb-0"><span>C</span>atalog</h1>

                        <a href="" class="vine-btn">
                            Go shop
                        </a>
                    </div>

                    <div class="products-grid">
                        @foreach ($products->take(6) as $index => $product_info)
                            @if ($index === 3)
                                <div class="product-wow">

                                    <img src="{{ asset('themes/thevineline/img/warm.webp') }}" class="img-fluid"
                                        alt="thevineline">

                                    @include('front.theme.werkn-backbone-bootstrap.layouts.utilities._product_card')
                                </div>
                            @else
                                <div class="product">
                                    @include('front.theme.werkn-backbone-bootstrap.layouts.utilities._product_card')
                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- PROMO BANNER -->
    @php
        $banner_promo = Nowyouwerkn\WeCommerce\Models\Banner::where('is_promotional', true)
            ->where('priority', 1)
            ->first();
    @endphp

    @if (!empty($banner_promo))
        <section class="vine-section promo-banner">
            <div class="section-body">
                <div class="vine-container">
                    <div class="vine-container-bg">
                        @if ($banner_promo->image == null)
                            <img src="{{ asset('img/banners/' . $banner_promo->image_desktop) }}" alt="thevineline">
                        @else
                            <img src="{{ asset('themes/thevineline/img/hero.jpg') }}" alt="thevineline">
                        @endif
                    </div>
                    <div class="vine-container-content"></div>
                    <div class="banner-wrap" style="position: relative;">
                        <div class="container">
                            <div class="row">
                                <div class="col-12" style="position: relative;">

                                    <div style="z-index: 3; position: relative;" class="banner-content">
                                        <h3 style="color: {{ $banner_promo->hex_text_title }}">
                                            {{ $banner_promo->subtitle }}
                                        </h3>
                                        <h2 style="color: {{ $banner_promo->hex_text_subtitle }}">
                                            {{ $banner_promo->title }}
                                        </h2>
                                        <p style="color: {{ $banner_promo->hex_text_subtitle }}">
                                            {{ $banner_promo->text }}
                                        </p>

                                        @if ($banner_promo->has_button == true)
                                            <a style="color: {{ $banner_promo->hex_text_button }}; background-color: {{ $banner_promo->hex_button }}; border: none;"
                                                href="{{ $banner_promo->link }}"
                                                class="btn btn-primary">{{ $banner_promo->text_button }}</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif




    <section class="banner-main" style="background:#f9f8f5;">
        @if (empty($banners))
            <h2 class="text-center p-5">No se ha configurado un banner</h2>
        @else
            @foreach ($banners as $banner)
                <div class="banner-wrap" style="position: relative;">
                    @if (empty($banners->video_background))
                    @else
                        <iframe frameborder="0" height="100%" width="100%"
                            src="https://youtube.com/{{ $banner->video_background }}?autoplay=1&controls=0&showinfo=0&autohide=1"
                            style="z-index: 2; position: absolute;"></iframe>
                    @endif
                    <div class="container">
                        <div class="row">
                            <div class="col-12" style="position: relative;">

                                <div style="z-index: 3; position: relative; text-align:{{ $banner->position }}"
                                    class="banner-content">
                                    <h3 style="color: {{ $banner->hex_text_title }}">{{ $banner->subtitle }}</h3>
                                    <h2 style="color: {{ $banner->hex_text_subtitle }}">{{ $banner->title }}</h2>
                                    <p style="color: {{ $banner->hex_text_subtitle }}">{{ $banner->text }}</p>

                                    @if ($banner->has_button == true)
                                        <a style="color: {{ $banner->hex_text_button }}; background-color: {{ $banner->hex_button }}; border: none;"
                                            href="{{ $banner->link }}"
                                            class="btn btn-primary">{{ $banner->text_button }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="banner-img">
                        @if ($banner->image == null)
                        @else
                            <img style="z-index: 1; position: relative;"
                                src="{{ asset('img/banners/' . $banner->image) }}" alt="thevineline" class="main-img">
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </section>

    {{--
    @if (Session::has('watch_history'))
        <section class="vine-section watch-history">
            <div class="section-body">
                <div class="vine-container">
                    <div class="vine-container-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    @php
                                        $oldRecommend = Session::get('watch_history');
                                        $recommendations = new Nowyouwerkn\WeCommerce\Models\WatchHistory(
                                            $oldRecommend,
                                        );

                                        foreach ($recommendations->items as $r) {
                                            $categories = $r['category'];
                                        }

                                        $recommeded_products = Nowyouwerkn\WeCommerce\Models\Product::whereIn(
                                            'category_id',
                                            [$categories],
                                        )
                                            ->take(4)
                                            ->inRandomOrder()
                                            ->get();
                                    @endphp

                                    @foreach ($recommeded_products as $rec_products)
                                        <div class="col-md-3">
                                            <a class="small-product-card"
                                                href="{{ route('detail', [$rec_products->category->slug, $rec_products->slug]) }}">
                                                <img alt="{{ $rec_products->name }}" style="width: 100px;"
                                                    src="{{ asset('img/products/' . $rec_products->image) }}">

                                                <div class="small-product-card-info">
                                                    <h5 class="fs-6 mb-1">{{ $rec_products->name }}</h5>
                                                    @if ($rec_products->has_discount == true && $rec_products->discount_end > Carbon\Carbon::today())
                                                        <div class="wk-price" style="font-size:.8em;">
                                                            ${{ number_format($rec_products->discount_price, 2) }}</div>
                                                        <div class="wk-price wk-price-discounted"
                                                            style="font-size:.7em !important; ">
                                                            ${{ number_format($rec_products->price, 2) }}</div>
                                                    @else
                                                        <div class="wk-price" style="font-size:.8em;">
                                                            ${{ number_format($rec_products->price, 2) }}</div>
                                                    @endif
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
         --}}

    <!--COOL CTA-->
    {{--
    <section class="vine-section">
        <div class="section-body">
            <div class="vine-container">
                <div class="vine-container-bg">
                </div>
                <div class="vine-container-content">
                    <h1>Hello</h1>
                </div>
            </div>
        </div>
    </section>
     --}}


    <!-- best-selling-area-end -->
@endsection

@push('scripts')
@endpush
