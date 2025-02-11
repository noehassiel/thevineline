@extends('front.theme.werkn-backbone-bootstrap.layouts.main')

@push('seo')
@endpush

@push('stylesheets')
@endpush

@section('content')
    @if ($products->count() != 0)
        @include('front.theme.werkn-backbone-bootstrap.layouts.utilities._filter_sidebar')
    @endif

    <section class="vine-section catalog-page">
        <div class="section-body">
            <div class="vine-container">
                <div class="vine-container-bg">
                </div>
                <div class="vine-container-content">
                    @if ($products->count() == 0)
                        <div class="container">

                            <div class="text-center" style="padding:80px 0px 100px 0px;">
                                <img src="{{ asset('themes/werkn-backbone/img/not_found.svg') }}" class="ml-auto mr-auto mb-5"
                                    width="300">
                                <h4>Todavía no hay nada por aqui</h4>
                                <p class="mb-4">Regresa pronto para conocer nuestros productos. ¿Eres el dueño? Inicia
                                    sesión <a href="{{ route('login') }}">aquí.</a></p>
                            </div>
                        </div>
                    @else
                        <div class="products-grid">
                            @foreach ($products as $product_info)
                                <div class="product">
                                    @include('front.theme.werkn-backbone-bootstrap.layouts.utilities._product_card')
                                </div>
                            @endforeach
                        </div>
                        <div class="pagination-wrap">
                            {{ $products->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
