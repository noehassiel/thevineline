<style type="text/css">
    .overlay-cookie {
        position: fixed;
        width: 29rem;
        background: #EBEBEB;
        color: #010101;
        padding: 20px;
        bottom: 20px;
        left: 20px;
        z-index: 99;
        display: none;
        border-radius: 6px;
    }

    .show-cookie {
        display: block;
    }

    .overlay-cookie h5 {
        font-size: 1.1em;
    }

    .overlay-cookie p {
        font-size: .9em;
    }

    .close-div {
        text-align: right;
    }

    .close-icon {
        color: #010101;
        border: none;
        background-color: transparent;
    }

    @media (max-width: 760px) {
        .overlay-cookie {
            position: fixed;
            width: 70%;
            background: black;
            color: white;
            border: solid 1px grey;
            padding: 20px;
            bottom: 0;
            left: 0;
            z-index: 99;
        }
    }
</style>

<div id="cookie-notice" class="overlay-cookie show-cookie">
    <div class="fragment">
        <div>
            <h5>Cookies</h5>
            <p>Al hacer clic en “Aceptar”, aceptas el almacenamiento de cookies en tu dispositivo para mejorar la
                navegación del sitio, analizar el uso del sitio y colaborar con nuestros esfuerzos de marketing.
                Consulta nuestra Política de Privacidad para más información.</p>

            <div class="d-flex" style="gap: 8px;">
                <a href="javascript:void(0)" class="btn btn-primary btn-sm close-cookie">Aceptar</a>
                <a href="javascript:void(0)" class="btn btn-outline-primary btn-sm close-cookie">Cancelar</a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        if (document.cookie.indexOf('cookie=notice_accepted') >= 0) {
            $('.overlay-cookie').removeClass('show-cookie');
        } else {
            $('.close-cookie').on("click", function() {
                document.cookie = ('cookie=notice_accepted');

                $('.overlay-cookie').removeClass('show-cookie');
            });
        }
    </script>
@endpush
