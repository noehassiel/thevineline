@extends('front.theme.werkn-backbone-bootstrap.layouts.main')

@push('seo')
    <meta property="og:title" content="{{ $product->name }}">
    <meta property="og:description" content="{{ $product->description }}">
    <meta property="og:url" content="{{ route('detail', [$product->category->slug, $product->slug]) }}">
    <meta property="og:image" content="{{ asset('img/products/' . $product->image) }}">
    <meta property="product:brand" content="{{ $product->brand ?? 'N/A' }}">
    <meta property="product:availability" content="{{ $product->availability ?? '' }}">
    <meta property="product:condition" content="{{ $product->condition ?? '' }}">
    <meta property="product:gender" content="{{ $product->gender ?? 'N/A' }}">
    <meta property="product:color" content="{{ $product->color ?? 'N/A' }}">
    <meta property="product:age_group" content="{{ $product->age_group ?? '' }}">

    <meta property="product:price:amount" content="{{ number_format($product->price, 2) }}">
    <meta property="product:price:currency" content="MXN">

    @if ($product->has_discount == true)
        <meta property="product:sale_price:amount" content="{{ number_format($product->discount_price, 2) }}">
        <meta property="product:sale_price:currency" content="MXN">
        <meta property="product:sale_price_dates:start"
            content="{{ Carbon\Carbon::parse($product->discount_start)->format('Y-m-d') . 'T08:00-07:00' }}">
        <meta property="product:sale_price_dates:end"
            content="{{ Carbon\Carbon::parse($product->discount_end)->format('Y-m-d') . 'T08:00-06:00' }}">
    @endif

    <meta property="product:retailer_item_id" content="{{ $product->sku }}">
    <meta property="product:item_group_id" content="mf_shoes_{{ $product->sku }}">
    <meta property="product:category" content="Apparel &amp; Accessories &gt; Shoes" />

    @foreach ($product->images as $image)
        <meta property="product:additional_image_link" content="{{ asset('img/products/' . $image->image) }}" />
    @endforeach

@endpush

@push('stylesheets')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        .swiper {
            width: 100%;
        }

        .swiper-slide {
            background-size: cover;
            background-position: center;
        }

        .mySwiper2 {
            width: 100%;
        }

        .mySwiper .swiper-slide {
            width: 40px;
            height: 40px;
            opacity: 0.5;
        }

        .mySwiper .swiper-slide-thumb-active {
            opacity: 1;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endpush

@section('content')


    <section class="vine-product">
        <div class="division-line"></div>

        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="col-md-2 p-md-2 p-4">
                    <div class="d-flex flex-column justify-content-between h-100">
                        <div>
                            <small style="font-size:12px">New</small>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <p class="mb-0" style="font-size: 14px">{{ $product->name }}</p>


                                @if (isset(Auth::user()->id) && Auth::user()->isInWishlist($product->id))
                                    <a href="{{ route('wishlist.remove', $product->id) }}"
                                        class="d-flex align-items-center"><ion-icon name="heart-dislike-outline"
                                            class="me-2"></ion-icon></a>
                                @else
                                    @guest
                                        <a href="{{ route('login') }}" class="d-flex align-items-center"><ion-icon
                                                name="heart-outline"></ion-icon class="me-2"></a>
                                    @else
                                        <a href="{{ route('wishlist.add', $product->id) }}"
                                            class="d-flex align-items-center"><ion-icon name="heart-outline"
                                                class="me-2"></ion-icon></a>
                                    @endif
                                    @endif
                                </div>

                                <p class="my-3" style="font-size: 14px">{{ $product->description }}</p>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn px-0 w-100 text-start footer-link text-white"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal" style="font-size: 14px">
                                    Materiales
                                </button>
                            </div>
                            <div>
                                <div class="product-actions d-flex flex-column align-items-center mt-5">

                                    @if (!empty($all_relationships))
                                        <div class="product-details-info mt-4">
                                            <!-- Relaciones de Producto (Variante Secundaria) -->
                                            <h6 class="wk-variant-title">Colores</h6>

                                            <ul class="d-flex list-unstyled mb-4">
                                                <li>
                                                    <a href="{{ route('detail', [$base_product->base_product->category->slug, $base_product->base_product->slug]) }}"
                                                        style="background-color: {{ $base_product->base_product->hex_color }}; border-color:{{ $base_product->base_product->hex_color }};"
                                                        class="rs-variant" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ $base_product->base_product->color }}">{{ $base_product->base_product->color }}</a>
                                                </li>

                                                @foreach ($all_relationships as $rs_variant)
                                                    @if ($rs_variant->product->status != 'Borrador')
                                                        <li>
                                                            <a href="{{ route('detail', [$rs_variant->product->category->slug, $rs_variant->product->slug]) }}"
                                                                style="background-color: {{ $rs_variant->product->hex_color }};"
                                                                class="rs-variant" data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="{{ $rs_variant->value }}">{{ $rs_variant->value }}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if ($product->has_variants == true)
                                        <div class="product-details-info mt-4">
                                            <!-- Variantes Principales -->
                                            @if ($product->variants->count() != 0)

                                                @if ($product->stock <= 5)
                                                    <span class="text-warning mb-2">Pocas en existencia<ion-icon
                                                            name="alert-circle-outline"></ion-icon></span>
                                                @endif

                                                <ul class="wk-variant-list d-flex list-unstyled">
                                                    @foreach ($product->variants->sortBy('id') as $variant)
                                                        <li>
                                                            @if ($variant->pivot->stock <= 0)
                                                                <div class="no-stock-variant"><span
                                                                        class="line"></span>{{ $variant->value }}</div>
                                                            @else
                                                                <a id="variant{{ $variant->id }}"
                                                                    data-value="{{ $variant->value }}" class="stock-variant"
                                                                    href="javascript:void(0)">{{ $variant->value }}</a>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    @endif

                                    @if ($product->has_variants == true)
                                        @if ($product->variants->count() == 0)
                                            <div class="me-3">
                                                <p class="no-existance-btn mb-0"><i class="fas fa-heartbeat"></i> Sin
                                                    Existencias
                                                </p>
                                                <p class="no-existance-explain mb-0 mt-0"><small>Resurtiremos pronto, revisa
                                                        más
                                                        adelante.</small></p>
                                            </div>
                                        @else
                                            <a href="#" id="addToCartBtn"
                                                class="btn btn-primary d-flex align-items-center w-100 justify-content-between text-white"
                                                role="button" style="font-size: 12px !important; margin-top:1.5vh">
                                                <div id="size-alert" class="size-alert">Selecciona una talla.</div>
                                                Agregar a carrito
                                                <ion-icon name="bag-add-outline" class="me-2"></ion-icon>
                                            </a>
                                        @endif
                                    @else
                                        @if ($product->stock <= 0)
                                            <div class="me-3">
                                                <p class="no-existance-btn mb-0"><i class="fas fa-heartbeat"></i> Sin
                                                    Existencias
                                                </p>
                                                <p class="no-existance-explain mb-0 mt-0"><small>Resurtiremos pronto, revisa
                                                        más
                                                        adelante.</small></p>
                                            </div>
                                        @else
                                            <a href="{{ route('add-cart', ['id' => $product->id, 'variant' => 'unique']) }}"
                                                id="addToCartBtn"
                                                class="btn btn-primary d-flex align-items-center w-100 justify-content-between text-white"
                                                role="button" style="font-size: 12px !important; margin-top:1.5vh">
                                                Agregar a carrito
                                                <ion-icon name="bag-add-outline" class="me-2"></ion-icon>
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 pe-md-0">
                        <div class="h-100">
                            <div class="swiper mySwiper2 imgDetail">
                                <div class="swiper-wrapper">
                                    @foreach ($product->images as $image)
                                        <div class="swiper-slide">
                                            <img src="{{ asset('img/products/' . $image->image) }}" />
                                        </div>
                                    @endforeach
                                    <div class="swiper-slide">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div thumbsSlider="" class="swiper mySwiper thumbs-min">
                            <div class="swiper-wrapper">
                                @foreach ($product->images as $image)
                                    <div class="swiper-slide">
                                        <div class="thumb">
                                            <img src="{{ asset('img/products/' . $image->image) }}" />
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="vine-section dark-section" style="border-top: .5px solid #ffffff7e;">
            <div class="section-body">
                <div class="vine-container">
                    <div class="vine-container-content">
                        <ul class="nav nav-tabs p-2" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#details" type="button" role="tab" aria-controls="details"
                                    aria-selected="true">Detalle</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="materials-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                                    type="button" role="tab" aria-controls="reviews"
                                    aria-selected="false">Reseñas</button>
                            </li>
                        </ul>

                        <div class="container-fluid">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="details" role="tabpanel"
                                    aria-labelledby="details-tab">
                                    <div class="product-details">
                                        <div class="row h-100">
                                            <div class="col-md-4 py-2">
                                                <p>{{ $product->materials }}</p>
                                            </div>

                                            @php
                                                $first_image = \Nowyouwerkn\WeCommerce\Models\ProductImage::where(
                                                    'product_id',
                                                    $product->id,
                                                )->first();
                                            @endphp

                                            <div class="col-md-8 position-relative p-0" style="overflow:hidden">
                                                @if ($product->image == null)
                                                    <img class="position-absolute"
                                                        src="{{ asset('img/products/' . $first_image->image) }}"
                                                        style="width: 100%; height: 100%; object-fit: cover;">
                                                @else
                                                    <img class="position-absolute"
                                                        src="{{ asset('img/products/' . $product->image) }}"
                                                        style="width: 100%; height: 100%; object-fit: cover;">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                    <div class="row">
                                        <div class="col-md-6 py-3" style="border-right: 1px solid #ffffff7e;">
                                            @if ($product->approved_reviews->count() != 0)
                                                <div class="d-flex aling-items-center">
                                                    <small>
                                                        {{ round($product->approved_reviews->avg('rating')) }}
                                                    </small>
                                                    <div class="rating d-flex align-items-center mx-3">
                                                        @if (round($product->approved_reviews->avg('rating'), 0) == 0)
                                                            <ion-icon name="star-outline"></ion-icon>
                                                            <ion-icon name="star-outline"></ion-icon>
                                                            <ion-icon name="star-outline"></ion-icon>
                                                            <ion-icon name="star-outline"></ion-icon>
                                                            <ion-icon name="star-outline"></ion-icon>
                                                        @endif

                                                        @if (round($product->approved_reviews->avg('rating'), 0) == 1)
                                                            <ion-icon name="sta"></ion-icon>
                                                            <ion-icon name="star-outline"></ion-icon>
                                                            <ion-icon name="star-outline"></ion-icon>
                                                            <ion-icon name="star-outline"></ion-icon>
                                                            <ion-icon name="star-outline"></ion-icon>
                                                        @endif

                                                        @if (round($product->approved_reviews->avg('rating'), 0) == 2)
                                                            <ion-icon name="star"></ion-icon>
                                                            <ion-icon name="star"></ion-icon>
                                                            <ion-icon name="star-outline"></ion-icon>
                                                            <ion-icon name="star-outline"></ion-icon>
                                                            <ion-icon name="star-outline"></ion-icon>
                                                        @endif

                                                        @if (round($product->approved_reviews->avg('rating'), 0) == 3)
                                                            <ion-icon name="star"></ion-icon>
                                                            <ion-icon name="star"></ion-icon>
                                                            <ion-icon name="star"></ion-icon>
                                                            <ion-icon name="star-outline"></ion-icon>
                                                            <ion-icon name="star-outline"></ion-icon>
                                                        @endif

                                                        @if (round($product->approved_reviews->avg('rating'), 0) == 4)
                                                            <ion-icon name="star"></ion-icon>
                                                            <ion-icon name="star"></ion-icon>
                                                            <ion-icon name="star"></ion-icon>
                                                            <ion-icon name="star"></ion-icon>
                                                            <ion-icon name="star-outline"></ion-icon>
                                                        @endif

                                                        @if (round($product->approved_reviews->avg('rating'), 0) == 5)
                                                            <ion-icon name="star"></ion-icon>
                                                            <ion-icon name="star"></ion-icon>
                                                            <ion-icon name="star"></ion-icon>
                                                            <ion-icon name="star"></ion-icon>
                                                            <ion-icon name="star"></ion-icon>
                                                        @endif
                                                    </div>
                                                    <small>
                                                        Basado en {{ $product->approved_reviews->count() }} reseñas
                                                    </small>
                                                </div>

                                                <div class="total-reviews mt-4">
                                                    <div class="d-flex align-items-center" style="gap: 1.4rem">
                                                        <p class="mb-0">5 <ion-icon name="star"></ion-icon></p>
                                                        <div class="progress mb-0 mt-0" style="width: 280px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: {{ ($product->approved_reviews->where('rating', 5)->count() * 100) / $product->approved_reviews->count() }}%"
                                                                aria-valuenow="{{ ($product->approved_reviews->where('rating', 5)->count() * 100) / $product->approved_reviews->count() }}"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mb-0">
                                                            {{ ($product->approved_reviews->where('rating', 5)->count() * 100) / $product->approved_reviews->count() }}%
                                                        </p>
                                                    </div>

                                                    <div class="d-flex align-items-center" style="gap: 1.4rem">
                                                        <p class="mb-0">4 <ion-icon name="star"></ion-icon></p>
                                                        <div class="progress mb-0 mt-0" style="width: 280px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: {{ ($product->approved_reviews->where('rating', 4)->count() * 100) / $product->approved_reviews->count() }}%"
                                                                aria-valuenow="{{ ($product->approved_reviews->where('rating', 4)->count() * 100) / $product->approved_reviews->count() }}"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mb-0">
                                                            {{ ($product->approved_reviews->where('rating', 4)->count() * 100) / $product->approved_reviews->count() }}%
                                                        </p>
                                                    </div>

                                                    <div class="d-flex align-items-center" style="gap: 1.4rem">
                                                        <p class="mb-0">3 <ion-icon name="star"></ion-icon></p>
                                                        <div class="progress mb-0 mt-0" style="width: 280px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: {{ ($product->approved_reviews->where('rating', 3)->count() * 100) / $product->approved_reviews->count() }}%"
                                                                aria-valuenow="{{ ($product->approved_reviews->where('rating', 3)->count() * 100) / $product->approved_reviews->count() }}"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mb-0">
                                                            {{ ($product->approved_reviews->where('rating', 3)->count() * 100) / $product->approved_reviews->count() }}%
                                                        </p>
                                                    </div>

                                                    <div class="d-flex align-items-center" style="gap: 1.4rem">
                                                        <p class="mb-0">2 <ion-icon name="star"></ion-icon></p>
                                                        <div class="progress mb-0 mt-0" style="width: 280px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: {{ ($product->approved_reviews->where('rating', 2)->count() * 100) / $product->approved_reviews->count() }}%"
                                                                aria-valuenow="{{ ($product->approved_reviews->where('rating', 2)->count() * 100) / $product->approved_reviews->count() }}"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mb-0">
                                                            {{ ($product->approved_reviews->where('rating', 2)->count() * 100) / $product->approved_reviews->count() }}%
                                                        </p>
                                                    </div>

                                                    <div class="d-flex align-items-center" style="gap: 1.4rem">
                                                        <p class="mb-0">1 <ion-icon name="star"></ion-icon></p>
                                                        <div class="progress mb-0 mt-0" style="width: 280px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: {{ ($product->approved_reviews->where('rating', 1)->count() * 100) / $product->approved_reviews->count() }}%"
                                                                aria-valuenow="{{ ($product->approved_reviews->where('rating', 1)->count() * 100) / $product->approved_reviews->count() }}"
                                                                aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <p class="mb-0">
                                                            {{ ($product->approved_reviews->where('rating', 1)->count() * 100) / $product->approved_reviews->count() }}%
                                                        </p>
                                                    </div>
                                                </div>
                                            @else
                                                <p>No hay reseñas para este producto todavía. Se el primero en hablar de
                                                    "{{ $product->name }}"</p>
                                            @endif

                                            <form action="{{ route('reviews.store', $product->id) }}" method="POST"
                                                class="comment-form review-form mt-4">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="product_id" value="{{ $product->id }}">


                                                <p class="mb-2">Tu reseña <span class="text-danger ">*</span></p>

                                                <div class="rate">
                                                    <input type="radio" id="star5" name="rating" value="5" />
                                                    <label for="star5" title="text">5 estrellas</label>
                                                    <input type="radio" id="star4" name="rating" value="4" />
                                                    <label for="star4" title="text">4 estrellas</label>
                                                    <input type="radio" id="star3" name="rating" value="3" />
                                                    <label for="star3" title="text">3 estrellas</label>
                                                    <input type="radio" id="star2" name="rating" value="2" />
                                                    <label for="star2" title="text">2 estrellas</label>
                                                    <input type="radio" id="star1" name="rating" value="1" />
                                                    <label for="star1" title="text">1 estrella</label>
                                                </div>

                                                <textarea id="review" name="review" rows="4" class="form-control mb-4"
                                                    placeholder="Este producto es genial..."></textarea>

                                                @guest
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h5 class="mb-2">Tu nombre <span class="text-danger ">*</span>
                                                            </h5>
                                                            <input type="text" name="name" placeholder="Nombre Apellido"
                                                                required="">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h5 class="mb-2">Tu correo <span class="text-danger ">*</span>
                                                            </h5>
                                                            <input type="email" name="email" placeholder="correo@correo.com"
                                                                required="">
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h5 class="mb-2">Tu nombre <span class="text-danger ">*</span>
                                                            </h5>
                                                            <input type="text" name="name" placeholder="Nombre Apellido"
                                                                required="" value="{{ Auth::user()->name }}" readonly="">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h5 class="mb-2">Tu correo <span class="text-danger ">*</span>
                                                            </h5>
                                                            <input type="email" name="email" placeholder="correo@correo.com"
                                                                required="" value="{{ Auth::user()->email }}" readonly="">
                                                        </div>

                                                    </div>
                                                    <div class="justify-content-center">
                                                        <small class="d-block mb-4">Tienes sesión iniciada como
                                                            {{ Auth::user()->name }}
                                                        </small>
                                                    </div>

                                                @endguest
                                                <button type="submit" class="btn btn-primary mt-5">Publicar
                                                    Reseña</button>
                                            </form>
                                        </div>

                                        <div class="col-md-6 py-3">


                                            @if ($product->approved_reviews->count() != 0)
                                                @foreach ($product->approved_reviews as $review)
                                                    <div class="media">
                                                        @if ($review->user != null)
                                                            @if ($review->user->image == null)
                                                                <img class="mr-3 rounded-circle"
                                                                    src="{{ 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($review->email))) . '?d=retro&s=100' }}"
                                                                    alt="{{ $review->name }}" width="50">
                                                            @else
                                                                <img class="mr-3 rounded-circle"
                                                                    src="{{ asset('img/users/' . $review->user->image) }}"
                                                                    alt="{{ $review->name }}" width="50">
                                                            @endif
                                                        @endif

                                                        <div class="rating d-flex mt-2">
                                                            @if ($review->rating == 0)
                                                                <ion-icon name="star-outline"></ion-icon>
                                                                <ion-icon name="star-outline"></ion-icon>
                                                                <ion-icon name="star-outline"></ion-icon>
                                                                <ion-icon name="star-outline"></ion-icon>
                                                                <ion-icon name="star-outline"></ion-icon>
                                                            @endif

                                                            @if ($review->rating == 1)
                                                                <ion-icon name="star"></ion-icon>
                                                                <ion-icon name="star-outline"></ion-icon>
                                                                <ion-icon name="star-outline"></ion-icon>
                                                                <ion-icon name="star-outline"></ion-icon>
                                                                <ion-icon name="star-outline"></ion-icon>
                                                            @endif

                                                            @if ($review->rating == 2)
                                                                <ion-icon name="star"></ion-icon>
                                                                <ion-icon name="star"></ion-icon>
                                                                <ion-icon name="star-outline"></ion-icon>
                                                                <ion-icon name="star-outline"></ion-icon>
                                                                <ion-icon name="star-outline"></ion-icon>
                                                            @endif

                                                            @if ($review->rating == 3)
                                                                <ion-icon name="star"></ion-icon>
                                                                <ion-icon name="star"></ion-icon>
                                                                <ion-icon name="star"></ion-icon>
                                                                <ion-icon name="star-outline"></ion-icon>
                                                                <ion-icon name="star-outline"></ion-icon>
                                                            @endif

                                                            @if ($review->rating == 4)
                                                                <ion-icon name="star"></ion-icon>
                                                                <ion-icon name="star"></ion-icon>
                                                                <ion-icon name="star"></ion-icon>
                                                                <ion-icon name="star"></ion-icon>
                                                                <ion-icon name="star-outline"></ion-icon>
                                                            @endif

                                                            @if ($review->rating == 5)
                                                                <ion-icon name="star"></ion-icon>
                                                                <ion-icon name="star"></ion-icon>
                                                                <ion-icon name="star"></ion-icon>
                                                                <ion-icon name="star"></ion-icon>
                                                                <ion-icon name="star"></ion-icon>
                                                            @endif
                                                        </div>

                                                        <div class="media-body">
                                                            <h5 class="mt-0 mb-0">{{ $review->name }}</h5>
                                                            <p class="mb-2"><small><i>Publicado:
                                                                        {{ date('d, m, Y', strtotime($review->created_at)) }}</i></small>
                                                            </p>
                                                            <p>{{ $review->review }}</p>
                                                        </div>
                                                    </div>

                                                    <hr>
                                                @endforeach
                                            @else
                                                <p>No hay reseñas para este producto todavía. Se el primero en hablar de
                                                    "{{ $product->name }}"</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="vine-section dark-section" style="border-top: .5px solid #ffffff7e;">
            <div class="section-body">
                <div class="vine-container">
                    <div class="vine-container-content">
                        <ul class="nav nav-tabs p-2" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="more-tab" data-bs-toggle="tab" data-bs-target="#more"
                                    type="button" role="tab" aria-controls="more" aria-selected="true">Te podría
                                    gustar</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="story-tab" data-bs-toggle="tab" data-bs-target="#story"
                                    type="button" role="tab" aria-controls="story" aria-selected="false">Visto
                                    recientemente</button>
                            </li>
                        </ul>
                        <div class="container-fluid">
                            <div class="tab-content mt-4" id="myTabContent">
                                <div class="tab-pane fade show active" id="more" role="tabpanel"
                                    aria-labelledby="more-tab">
                                    @if ($products_selected->count() != 0)
                                        <div class="d-flex justify-content-between flex-products flex-md-row flex-column">
                                            @foreach ($products_selected->take(4) as $product_info)
                                                @include('front.theme.werkn-backbone-bootstrap.layouts.utilities._product_card')
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="story" role="tabpanel" aria-labelledby="story-tab">
                                    @if (Session::has('watch_history'))
                                        <div class="d-flex justify-content-between flex-products flex-md-row flex-column">
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
                                                <div class="product-card mb-4">
                                                    <a href="{{ route('detail', [$rec_products->category->slug, $rec_products->slug]) }}"
                                                        class="card-body">

                                                        @php
                                                            $first_image = \Nowyouwerkn\WeCommerce\Models\ProductImage::where(
                                                                'product_id',
                                                                $rec_products->id,
                                                            )->first();

                                                            $second_image = \Nowyouwerkn\WeCommerce\Models\ProductImage::where(
                                                                'product_id',
                                                                $rec_products->id,
                                                            )
                                                                ->skip(1)
                                                                ->first();
                                                        @endphp

                                                        <img class="card-img-top @if ($second_image != null) second-image @endif"
                                                            src="{{ asset('img/products/' . $first_image->image) }}"
                                                            data-holder-rendered="true">

                                                        @if ($second_image != null)
                                                            <img class="card-img-bottom"
                                                                src="{{ asset('img/products/' . $second_image->image) }}"
                                                                data-holder-rendered="true">
                                                        @endif

                                                        <div class="overlay"></div>

                                                        <div class="card-title">
                                                            <h1>{{ $rec_products->name }}</h1>
                                                            <p>{{ $rec_products->category->name }}</p>
                                                        </div>

                                                        <div
                                                            class="card-info d-flex justify-content-between align-items-center">
                                                            <!--PRICE-->
                                                            @if ($rec_products->has_discount == true && $rec_products->discount_end > Carbon\Carbon::today())
                                                                <div class="wk-price">
                                                                    ${{ number_format($rec_products->discount_price, 2) }}
                                                                </div>
                                                                <div class="wk-price wk-price-discounted">
                                                                    ${{ number_format($rec_products->price, 2) }}</div>
                                                            @else
                                                                <div class="wk-price">
                                                                    ${{ number_format($rec_products->price, 2) }}</div>
                                                            @endif
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach

                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="tab-content">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="materials-tab" data-bs-toggle="tab"
                                        data-bs-target="#materials" type="button" role="tab" aria-controls="materials"
                                        aria-selected="false">Materiales</button>
                                </li>
                            </ul>

                            <div class="tab-content mt-4" id="myTabContent">
                                <div class="tab-pane fade show active" id="materials" role="tabpanel"
                                    aria-labelledby="materials-tab">
                                    <p>{{ $product->materials }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @push('scripts')
        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <!-- Initialize Swiper -->
        <script>
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: "auto",
                freeMode: true,
                spaceBetween: 8,
            });
            var swiper2 = new Swiper(".mySwiper2", {
                slidesPerView: "auto",
                grabCursor: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                thumbs: {
                    swiper: swiper,
                },
            });
        </script>

        <script type="text/javascript">
            /* Selector de Tallas */
            $('.wk-variant-list li a').click(function() {
                event.preventDefault();
                console.log('Seleccionado:', $(this).attr('data-value'));

                $('.wk-variant-list li a').removeClass('active');
                $('#addToCartBtn').attr('href', '');

                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                } else {
                    $(this).addClass('active');
                }

                var product = {{ $product->id }};
                var value = $(this).attr('data-value');
                var url = "{{ route('add-cart', ['id' => ':product', 'variant' => ':value']) }}";

                var url_new = url.replace(':value', value);
                var product_new = url_new.replace(':product', product);

                $('#addToCartBtn').attr('href', product_new);
            });

            /* Agregar al carrito */
            $('#addToCartBtn').on('click', function() {
                if ($('#addToCartBtn').attr('href') === '#') {
                    event.preventDefault();
                    $('#size-alert').fadeIn();

                    setTimeout(function() {
                        $('#size-alert').fadeOut();
                    }, 1500);
                }
            });

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        </script>
    @endpush

    @push('pixel-events')
        <script type="text/javascript">
            fbq('track', 'ViewContent', {
                @if ($product->has_discount == true)
                    value: {{ $product->discount_price }},
                @else
                    value: {{ $product->price }},
                @endif
                currency: 'MXN',
                content_ids: '{{ $product->sku }}',
                content_name: '{{ $product->name }}',
                content_type: 'product',
            }, {
                eventID: '{{ $deduplication_code }}',
            });
        </script>

        @if ($store_config->has_pixel() == null)
            <script type="text/javascript">
                @if (Session::has('product_added'))
                    fbq('track', 'AddToCart', {
                        value: {{ $product->price }},
                        currency: 'MXN',
                        content_ids: '{{ $product->sku }}',
                        content_name: '{{ $product->name }}',
                        content_type: 'product',
                    });
                @endif

                @if (Session::has('product_added_whislist'))
                    fbq('track', 'AddToWishlist' {
                        value: {{ $product->price }},
                        currency: 'MXN',
                        content_ids: '{{ $product->sku }}',
                        content_name: '{{ $product->name }}',
                        content_type: 'product',
                    });
                @endif
            </script>
        @endif
    @endpush
