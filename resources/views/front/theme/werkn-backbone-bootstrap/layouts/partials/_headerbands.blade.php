@php
    $headerbands = Nowyouwerkn\WeCommerce\Models\Headerband::where('is_active', true)
        ->orderBy('priority', 'asc')
        ->get();
@endphp

@if (!empty($headerbands))
    @foreach ($headerbands as $hb)
        <style type="text/css">
            .wk-headerband-{{ Str::slug($hb->title) }} {
                background-color: {{ $hb->hex_background }} !important;
                color: {{ $hb->hex_text }} !important;
            }
        </style>

        <div class="wk-headerband wk-headerband-{{ Str::slug($hb->title) }} wrapper ">
            <div class="boxes">
                <div class="box">{{ $hb->title }}</div>
                <div class="box">-</div>
                <div class="box"></div>
                <div class="box">{!! $hb->text !!}</div>
                <div class="box">{{ $hb->title }}</div>
                <div class="box">-</div>
                <div class="box"></div>
                <div class="box">{!! $hb->text !!}</div>
                <div class="box">{{ $hb->title }}</div>
                <div class="box">-</div>
                <div class="box"></div>
                <div class="box">{!! $hb->text !!}</div>
                <div class="box">{{ $hb->title }}</div>
                <div class="box">-</div>
                <div class="box"></div>
                <div class="box">{!! $hb->text !!}</div>
                <div class="box">{{ $hb->title }}</div>
                <div class="box">-</div>
                <div class="box"></div>
                <div class="box">{!! $hb->text !!}</div>
                <div class="box">{{ $hb->title }}</div>
                <div class="box">-</div>
                <div class="box"></div>
                <div class="box">{!! $hb->text !!}</div>
            </div>

        </div>
    @endforeach
@endif
