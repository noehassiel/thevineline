@extends('front.theme.werkn-backbone-bootstrap.layouts.main')

@push('seo')
@endpush

@push('stylesheets')
    <style>
        .sticky-element {
            position: sticky;
            top: 0;
        }
    </style>
@endpush

@section('content')



    <section class="vine-section">
        <div class="section-body">
            <div class="hero vine-container">
                <div class="vine-container-bg">
                    <img src="{{ asset('themes/thevineline/img/hero.jpg') }}" alt="">
                </div>
                <div class="vine-container-content">
                    <h1>hi</h1>
                </div>
            </div>
        </div>
    </section>

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
                                            <div class="slide-bg">
                                                <div class="overlay"></div>
                                                <video src="{{ asset('themes/thevineline/img/boy-1.webm') }}" autoplay muted
                                                    loop playsinline></video>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-slide">
                                        <div class="slide-content">
                                            <div class="slide-bg">
                                                <div class="overlay"></div>
                                                <video src="{{ asset('themes/thevineline/img/girl-1.webm') }}" autoplay
                                                    muted loop playsinline></video>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 px-0 cards-wrapper">
                                <div class="card-half card-right">
                                    <div class="card-slide">
                                        <div class="slide-content">
                                            <div class="slide-bg">
                                                <div class="overlay"></div>
                                                <video src="{{ asset('themes/thevineline/img/boy-2.webm') }}" autoplay muted
                                                    loop playsinline></video>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-slide">
                                        <div class="slide-content">
                                            <div class="slide-bg">
                                                <div class="overlay"></div>
                                                <video src="{{ asset('themes/thevineline/img/girl-2.webm') }}" autoplay
                                                    muted loop playsinline></video>
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

    <!-- best-selling-area -->
    <section class="vine-section fav-products">
        <div class="section-body">
            <div class="vine-container">
                <div class="vine-container-content">

                    <div class="d-flex justify-content-between align-items-center fav-heading">
                        <h2>Shop</h2>
                        <a href="{{ route('catalog.all') }}" class="btn btn-primary">Comprar ahora</a>
                        <h2>Now</h2>
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
                    <img src="{{ asset('themes/thevineline/img/mission.jpg') }}" alt="">
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
                                <img src="{{ asset('themes/thevineline/img/mission-center.jpg') }}" alt="">
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
                        <h1 class="mb-0">Catalog</h1>

                        <div class="btn btn-primary">
                            Go shop
                        </div>
                    </div>

                    <div class="products-grid">
                        @foreach ($products->take(6) as $index => $product_info)
                            @if ($index === 3)
                                <div class="product-wow">

                                    <img src="{{ asset('themes/thevineline/img/warm.webp') }}" class="img-fluid"
                                        alt="">

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

    <section class="vine-section promo-banner">
        <div class="section-body">
            <div class="vine-container">
                <div class="vine-container-bg">
                    @if ($banner_promo->image == null)
                        <img src="{{ asset('img/banners/' . $banner_promo->image_desktop) }}" alt="">
                    @else
                        <img src="{{ asset('themes/thevineline/img/hero.jpg') }}" alt="">
                    @endif
                </div>
                <div class="vine-container-content"></div>
                @if (!empty($banner_promo))
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
                                        <p style="color: {{ $banner_promo->hex_text_subtitle }}">{{ $banner_promo->text }}
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
                @endif
            </div>
        </div>
    </section>




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
                                src="{{ asset('img/banners/' . $banner->image) }}" alt="" class="main-img">
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </section>


    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row">
                @foreach ($main_categories as $category)
                    <div class="col-md-4">
                        <div class="cat-item mb-20">
                            <div class="thumb">
                                <a href="{{ route('catalog', $category->slug) }}">
                                    @if ($category->image == null)
                                        <img src="{{ asset('img/categories/no_category.jpg') }}" alt=""
                                            width="100%">
                                    @else
                                        <img src="{{ asset('img/categories/' . $category->image) }}" alt=""
                                            width="100%">
                                    @endif
                                </a>
                            </div>
                            <div class="content mt-3">
                                <span>Colección</span>
                                <h3 class="mb-3 mt-0"><a
                                        href="{{ route('catalog', $category->slug) }}">{{ $category->name }}</a></h3>
                                <a href="{{ route('catalog', $category->slug) }}"
                                    class="btn btn-outline-secondary">Comprar
                                    Ahora</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- best-selling-area-end -->
@endsection

@push('scripts')
@endpush
