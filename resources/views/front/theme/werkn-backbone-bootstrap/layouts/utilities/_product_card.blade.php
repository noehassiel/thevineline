<div class="product-card mb-4">
    <a href="{{ route('detail', [$product_info->category->slug, $product_info->slug]) }}" class="card-body">

        @php
            $second_image = \Nowyouwerkn\WeCommerce\Models\ProductImage::where('product_id', $product_info->id)
                ->skip(1)
                ->first();
        @endphp

        <img class="card-img-top @if ($second_image != null) second-image @endif"
            src="{{ asset('img/products/' . $product_info->image) }}" data-holder-rendered="true">

        @if ($second_image != null)
            <img class="card-img-bottom" src="{{ asset('img/products/' . $second_image->image) }}"
                data-holder-rendered="true">
        @endif

        <div class="overlay"></div>

        <div class="card-title">
            <h1>{{ $product_info->name }}</h1>
            <p>{{ $product_info->category->name }}</p>
        </div>

        <div class="card-info d-flex justify-content-between align-items-center">
            <!--PRICE-->
            @if ($product_info->has_discount == true && $product_info->discount_end > Carbon\Carbon::today())
                <div class="wk-price">${{ number_format($product_info->discount_price, 2) }}</div>
                <div class="wk-price wk-price-discounted">${{ number_format($product_info->price, 2) }}</div>
            @else
                <div class="wk-price">${{ number_format($product_info->price, 2) }}</div>
            @endif
        </div>
    </a>
</div>


@push('stylesheets')
@endpush



{{--
    <!--PRICE-->
            @if ($product_info->has_discount == true && $product_info->discount_end > Carbon\Carbon::today())
                <div class="wk-price">${{ number_format($product_info->discount_price, 2) }}</div>
                <div class="wk-price wk-price-discounted">${{ number_format($product_info->price, 2) }}</div>
            @else
                <div class="wk-price">${{ number_format($product_info->price, 2) }}</div>
            @endif


            <!--Favorite-->
            @if (isset(Auth::user()->id) && Auth::user()->isInWishlist($product_info->id))
                <a href="{{ route('wishlist.remove', $product_info->id) }}"
                    class="btn btn-sm btn-outline-danger d-flex align-items-center"><ion-icon
                        name="heart-dislike-outline"></ion-icon></a>
            @else
                @guest
                    <a href="{{ route('login') }}"
                        class="btn btn-sm btn-outline-secondary d-flex align-items-center"><ion-icon
                            name="heart-outline"></ion-icon></a>
                @else
                    <a href="{{ route('wishlist.add', $product_info->id) }}"
                        class="btn btn-sm btn-outline-secondary d-flex align-items-center"><ion-icon
                            name="heart-outline"></ion-icon></a>
                @endif
                @endif

                @php
                    /* Double Variant System */
                    $product_relationships = \Nowyouwerkn\WeCommerce\Models\ProductRelationship::where(
                        'base_product_id',
                        $product_info->id,
                    )
                        ->orWhere('product_id', $product_info->id)
                        ->get();

                    if ($product_relationships->count() == null) {
                        $base_product = null;
                        $all_relationships = null;
                    } else {
                        $base_product = $product_relationships->take(1)->first();
                        $all_relationships = \Nowyouwerkn\WeCommerce\Models\ProductRelationship::where(
                            'base_product_id',
                            $base_product->base_product_id,
                        )->get();
                    }
                @endphp

                @if (!empty($all_relationships))
                    <ul class="list-unstyled d-flex align-items-center wk-product-card-colors mb-2 mt-4">
                        <li>
                            <a href="{{ route('detail', [$base_product->base_product->category->slug, $base_product->base_product->slug]) }}"
                                style="background-color: {{ $base_product->base_product->hex_color }}; border-color:{{ $base_product->base_product->hex_color }};"
                                class="wk-product-card-color-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="{{ $base_product->base_product->color }}">{{ $base_product->base_product->color }}</a>
                        </li>

                        @foreach ($all_relationships as $rs_variant)
                            @if ($rs_variant->product->status != 'Borrador')
                                <li>
                                    <a href="{{ route('detail', [$rs_variant->product->category->slug, $rs_variant->product->slug]) }}"
                                        style="background-color: {{ $rs_variant->product->hex_color }};"
                                        class="wk-product-card-color-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{ $rs_variant->value }}">{{ $rs_variant->value }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif

--}}
