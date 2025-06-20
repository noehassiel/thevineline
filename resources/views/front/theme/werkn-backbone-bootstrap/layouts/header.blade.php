@php
    $categories = Nowyouwerkn\WeCommerce\Models\Category::where('parent_id', 0)
        ->orWhere('parent_id', null)
        ->get(['name', 'slug', 'image']);

    $main_categories = Nowyouwerkn\WeCommerce\Models\Category::where('parent_id', '0')
        ->orWhere('parent_id', null)
        ->orderBy('priority', 'asc')
        ->orderBy('created_at', 'asc')
        ->get(['name', 'slug', 'image'])
        ->take(6);
@endphp


<header>
    <nav class="navdesk">
        <div class="nav-main">
            <a class="logo d-flex w-100 p-3" href="{{ route('index') }}">
                @if (!empty($store_config))
                    @if ($store_config->store_logo == null)
                        <img src="{{ asset('assets/img/tvl/logo.svg') }}" alt="Logo" class="img-fluid" width="200">
                    @else
                        <img src="{{ asset('assets/img/tvl/logo.svg') }}" alt="Logo" class="img-fluid" width="200">
                    @endif
                @else
                    <img src="{{ asset('assets/img/tvl/logo.svg') }}" alt="Logo" class="img-fluid" width="200">
                @endif
            </a>



            <a class="nav-link" href="{{ route('index') }}">Inicio</a>


            @foreach ($categories as $category)
                <a class="nav-link" href="{{ route('catalog', $category->slug) }}">{{ $category->name }}</a>
            @endforeach
        </div>

        <div class="nav-sec">
            {{--
            <div class="py-3 px-2">
                <form role="search" action="{{ route('search.query') }}" class="catalog-search ">
                    <div class="input-group input-group-search d-flex align-items-center">
                        <input type="search" class="form-control" name="query" placeholder="Encuentra tu favorito"
                            aria-describedby="button-search">
                        <div class="input-group-prepend">
                            <button type="submit" class="btn" type="button" id="button-search">
                                <ion-icon name="search-outline"></ion-icon>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <hr style="margin: 0; background-color: #f0f0f0;">
             --}}

            @guest
                <a class="nav-link justify-content-between d-flex align-items-center" href="{{ route('login') }}">
                    Cuenta
                    <ion-icon name="person-outline"></ion-icon>
                </a>
            @else
                <a class="nav-link justify-content-between d-flex align-items-center" href="{{ route('profile') }}">
                    Perfil
                    <ion-icon name="person-outline"></ion-icon>
                </a>
            @endguest

            @if (request()->is('checkout'))
            @else
                <div class="dropdown nav-link">
                    <a class="justify-content-between d-flex align-items-center" href="#" role="button"
                        id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Bolsa

                        <div class="position-relative">
                            <ion-icon name="bag-outline"></ion-icon>

                            @if (Session::has('cart'))
                                <div class="spinner-grow spinner-grow-sm position-absolute text-primary" role="status"
                                    style="top: 1px; left:-4px; width: 8px; height: 8px;">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            @endif
                        </div>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"
                        style="min-width: 20rem; padding: 10px;">
                        @if (Session::has('cart'))
                            @include('front.theme.werkn-backbone-bootstrap.layouts.utilities._cart_item')
                        @else
                            <p class="mb-0 d-flex align-items-center">
                                No hay productos en tu carrito.
                            </p>
                        @endif
                    </ul>
                </div>
            @endif
        </div>
    </nav>

    <nav class="navmov">
        <a class="logo" href="{{ route('index') }}">
            <img src="{{ asset('assets/img/tvl/tvl-logo-white.png') }}" alt="Logo" class="img-fluid"
                width="200">
        </a>

        <div class="d-flex justify-content-end align-items-center w-100 p-2" style="gap: 24px">
            @guest
                <a class=" text-white justify-content-between d-flex align-items-center" href="{{ route('login') }}">

                    <ion-icon name="person-outline" style="width: 1.4em; height: 1.4em;"></ion-icon>
                </a>
            @else
                <a class=" text-white justify-content-between d-flex align-items-center" href="{{ route('profile') }}">

                    <ion-icon name="person-outline" style="width: 1.4em; height: 1.4em;"></ion-icon>
                </a>
            @endguest

            <a class=" text-white justify-content-between d-flex align-items-center"
                href="{{ route('cart') }}"><ion-icon name="bag-outline"
                    style="width: 1.4em; height: 1.4em;"></ion-icon></a>

            <a href="javascript:void(0)" id="showMNav"
                class="justify-content-between d-flex align-items-center text-white">
                <ion-icon name="menu-outline" style="width: 1.4em; height: 1.4em;"></ion-icon>
            </a>
        </div>
    </nav>
</header>


<div class="collapse-nav" style="overflow: hidden">
    <div class="d-flex w-100 justify-content-end p-2">
        <a href="javascript:void(0)" id="byeCollapse"
            class="justify-content-between d-flex align-items-center text-white">
            <ion-icon name="close-outline" style="width: 2em; height: 2em;"></ion-icon>
        </a>
    </div>

    <div class="d-flex linksMobile">
        <a class="nav-link" href="{{ route('index') }}">Inicio</a>
        @foreach ($categories as $category)
            <a class="nav-link" href="{{ route('catalog', $category->slug) }}">{{ $category->name }}</a>
        @endforeach
    </div>

    <div class="p-3" style="overflow: scroll">
        <div class="row">
            @foreach ($main_categories as $category)
                <div class="col-6">
                    <div class="cat-item mb-20">
                        <a href="{{ route('catalog', $category->slug) }}" class="thumb">
                            <div class="image">
                                @if ($category->image == null)
                                    <img src="{{ asset('img/categories/no_category.jpg') }}" alt=""
                                        width="100%">
                                @else
                                    <img src="{{ asset('img/categories/' . $category->image) }}" alt=""
                                        width="100%">
                                @endif
                            </div>
                            <div class="content mt-3">
                                <h3 class="mb-3 mt-0">{{ $category->name }}</h3>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{--
<nav class="pt-4 pb-4">
    <div class="container navbar-desktop">
        <div class="row justify-content-between align-items-center">
            <div class="col-5">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item btn btn-link"><a href="{{ route('index') }}">Inicio</a></li>

                    <div class="dropdown list-inline-item">
                        <button class="btn btn-link dropdown-toggle" type="button" id="dropdownCatalog"
                            data-bs-toggle="dropdown" aria-expanded="false">Catálogo</button>

                        <ul class="dropdown-menu justify-content-between list-group-flush"
                            aria-labelledby="dropdownCatalog">
                            <li class="list-group-item"><a href="{{ route('catalog.all') }}">Ver todos</a></li>
                            @foreach ($categories as $category)
                                <li class="list-group-item"><a
                                        href="{{ route('catalog', $category->slug) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>

                        <li class="list-inline-item btn btn-link"><a
                                href="{{ route('catalog.promo') }}">Promociones</a>
                        </li>
                    </div>
                </ul>
            </div>

            <div class="col-2">
                <a href="{{ route('index') }}">
                    @if (!empty($store_config))
                        @if ($store_config->store_logo == null)
                            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="img-fluid"
                                width="200">
                        @else
                            <img src="{{ asset('assets/img/' . $store_config->store_logo) }}" alt="Logo"
                                class="img-fluid" width="200">
                        @endif
                    @else
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="img-fluid"
                            width="200">
                    @endif
                </a>
            </div>

            <div class="col-5 text-end">
                <ul class="list-inline mb-0">

                    <li class="list-inline-item"><a href="{{ route('utilities.tracking.index') }}"
                            class="btn btn-link px-1"><ion-icon name="compass-outline"></ion-icon></a></li>

                    @guest
                        <li class="list-inline-item"><a href="{{ route('login') }}" class="btn btn-link px-1"><ion-icon
                                    name="person"></ion-icon></a></li>
                        <li class="list-inline-item">
                            <a href="{{ route('login') }}" class="btn btn-link px-1">
                                <ion-icon name="heart"></ion-icon>
                                <span class="badge bg-info">0</span>
                            </a>
                        </li>
                    @else
                        <li class="list-inline-item"><a href="{{ route('profile') }}"
                                class="btn btn-link px-1"><ion-icon name="person"></ion-icon></a></li>
                        <li class="list-inline-item">
                            <a href="{{ route('wishlist') }}" class="btn btn-link px-1">
                                <ion-icon name="heart"></ion-icon>
                                <span class="badge bg-info">{{ Auth::user()->wishlists->count() ?? '0' }}</span>
                            </a>
                        </li>
                    @endguest

                    @if (request()->is('checkout'))
                    @else
                        <div class="dropdown" style="display: inline-flex;">
                            <a class="btn btn-link dropdown-toggle" href="#" role="button"
                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <ion-icon name="bag"></ion-icon>
                                <span
                                    class="badge bg-danger">{{ Session::has('cart') ? Session::get('cart')->totalQty : '0' }}</span>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"
                                style="min-width: 20rem; padding: 10px;">
                                @if (Session::has('cart'))
                                    @include('front.theme.werkn-backbone-bootstrap.layouts.utilities._cart_item')
                                @else
                                    <p class="mb-0 d-flex align-items-center">
                                        No hay productos en tu carrito.
                                    </p>
                                @endif
                            </ul>
                        </div>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="container navbar-responsive">
        <div class="d-flex justify-content-between align-items-center">
            <button class="btn btn-secondary" class="nav-mobile-icon" onclick="toggleMenu()">
                <ion-icon name="menu-outline"></ion-icon>
            </button>

            <a class="logo" href="{{ route('index') }}">
                @if (!empty($store_config))
                    @if ($store_config->store_logo == null)
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="img-fluid"
                            width="200">
                    @else
                        <img src="{{ asset('assets/img/' . $store_config->store_logo) }}" alt="Logo"
                            class="img-fluid" width="200">
                    @endif
                @else
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="img-fluid" width="200">
                @endif
            </a>

            <div class="text-end">
                <ul class="list-inline mb-0">
                    @if (request()->is('checkout'))
                    @else
                        <div class="dropdown" style="display: inline-flex;">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <ion-icon name="bag"></ion-icon>
                                <span>{{ Session::has('cart') ? Session::get('cart')->totalQty : '0' }}</span>
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink"
                                style="min-width: 20rem; padding: 10px;">
                                @if (Session::has('cart'))
                                    @include('front.theme.werkn-backbone-bootstrap.layouts.utilities._cart_item')
                                @endif
                            </ul>
                        </div>

                    @endif
                </ul>
            </div>
        </div>
    </div>
    <!-- Sidebar Responsive -->
    <div class="sidebar-overlay"></div>
    <div id="sidebar-wrapper">
        <!-- store -->
        <div class="sidebar-menu">
            <ul>
                <li class="title closed-menu">
                    <a>
                        <span>Cerrar</span>
                        <ion-icon name="close-outline"></ion-icon>
                    </a>
                </li>
                @php
                    $categories = Nowyouwerkn\WeCommerce\Models\Category::where('parent_id', 0)
                        ->orWhere('parent_id', null)
                        ->get();
                @endphp
                @foreach ($categories as $category)
                    @if ($category->children->count() == 0)
                        <li>
                            <a href="{{ route('catalog', $category->slug) }}">{{ $category->name }}</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('catalog', $category->slug) }}" data-toggle="collapse"
                                data-target="#{{ $category->id }}" aria-expanded="false"
                                aria-controls="{{ $category->id }}">
                                {{ $category->name }}
                                <ion-icon name="chevron-forward-outline"></ion-icon>
                            </a>
                        </li>
                        <div class="collapse collapse-item" id="{{ $category->id }}" data-parent="#accordion">
                            <!-- items -->
                            <div class="sidebar-content">
                                <!-- title -->
                                <li class="title">
                                    <a data-toggle="collapse" data-target="#{{ $category->id }}"
                                        aria-expanded="false" aria-controls="{{ $category->id }}">
                                        <ion-icon name="chevron-back-outline"></ion-icon>
                                        {{ $category->name }}
                                    </a>
                                </li>
                                @foreach ($category->children as $sub)
                                    <li>
                                        <a href="{{ route('catalog', $sub->slug) }}">{{ $sub->name }}</a>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="{{ route('catalog', $category->slug) }}">Ver todo</a>
                                </li>
                            </div>

                            <!-- image -->
                            <div class="sidebar-image">
                                @if ($category->image == null)
                                    <img src="{{ asset('themes/arenas/img/front/categories/no-category.jpg') }}"
                                        alt="{{ $category->name }}"
                                        style="width: 100%; height:100%; object-fit:cover">
                                @else
                                    <img src="{{ asset('img/categories/' . $category->image) }}" alt=""
                                        style="width: 100%; height:100%; object-fit:cover">
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
                <hr>
                <li><a class="link link--metis" href="{{ route('utilities.tracking.index') }}">Seguimiento de
                        Orden</a></li>
            </ul>
        </div>

        <!-- user -->
        <div class="sidebar-user">
            @guest
                <a href="{{ route('login') }}" class="item closed-menu" data-toggle="modal"
                    data-target="#modal-access"><ion-icon name="person-outline"></ion-icon>Login</a>
                <a href="{{ route('catalog.all') }}" class="item"><ion-icon name="storefront-outline"></ion-icon>
                    Catálogo</a>
                <a href="{{ route('cart') }}" class="item"> <ion-icon name="bag-outline"></ion-icon> Bolsa</a>
            @else
                <a href="{{ route('profile') }}" class="item"><ion-icon name="person-outline"></ion-icon> Mi
                    Cuenta</a>
                <a href="{{ route('wishlist') }}" class="item"><ion-icon name="heart-outline"></ion-icon> Wishlist</a>
                <a href="{{ route('cart') }}" class="item"> <ion-icon name="bag-outline"></ion-icon> Bolsa</a>
                <a href="" class="item">
                    <ion-icon name="log-out-outline"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></ion-icon>
                    Salir
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            @endguest
        </div>
    </div>

</nav>
 --}}

@push('scripts')
    <script type="text/javascript">
        $("#menu-mobile").on("click", function() {
            toggleMenu();
        });

        $('#showMNav').on("click", function() {
            $('.collapse-nav').addClass('active');
            $('header').addClass('bye');

            $('.filters').toggle('off');

            document.body.classList.add('lock-scroll');

        });

        $('#byeCollapse').on("click", function() {
            $('.collapse-nav').removeClass('active');
            $('header').removeClass('bye');
            $('.filters').toggle('off');

            document.body.classList.remove('lock-scroll');
        });


        $(".sidebar-overlay").on("click", function() {
            $("body").removeClass("toggled");
            $(".clonado").remove();
        });

        $(".closed-menu").on("click", function() {
            $("body").removeClass("toggled");
            $(".clonado").remove();
        });

        $(".close-btn").on("click", function() {
            $("body").removeClass("toggled");
            $(".clonado").remove();
        });

        $(".close-sidebar").on("click", function() {
            $("body").removeClass("toggled");
            $(".clonado").remove();
        });

        function toggleMenu() {
            $("body").addClass("toggled");
        }
    </script>
    <script>
        $(function() {
            $('.openSearch').on('click', function(event) {
                event.preventDefault();
                $('#search').addClass('open');
                $('#search > form > input[type="search"]').focus();
            });

            $('#search, #search button.close').on('click keyup', function(event) {
                if (event.target == this || event.target.className == 'close' || event.keyCode == 27) {
                    $(this).removeClass('open');
                }
            });

            $(window).ready(function() {
                $("#search > form").on("keypress", function(event) {
                    var keyPressed = event.keyCode || event.which;

                    if (keyPressed === 13) {
                        return false;
                    }
                });
            });
        });
    </script>
@endpush
