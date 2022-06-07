<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>@section('title') {{env('APP_NAME')}} | @show</title>
    <!-- Bootstrap core CSS -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;400;500;800&display=swap" rel="stylesheet">

    <script src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=e9930eee-b41e-4fab-89fa-e7a068bc79bf&lang=ru_RU" type="text/javascript"></script>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/ilya_style_mfucker.css') }}">
    <title>Travel</title>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

</head>
<body>
<x-header/>

{{--@component('components.header')--}}
{{--@endcomponent--}}

<main>

    @yield('header')

    @yield('content')

</main>
@component('components.footer')
@endcomponent
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/all.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/yandex_map_route_to_place.js') }}"  type="text/javascript"></script>
<script src="{{ asset('js/yandex_map_create_place.js') }}"  type="text/javascript"></script>
<script src="{{ asset('js/yandex_map_show_all_places.js') }}"  type="text/javascript"></script>
@stack('js')
</body>
</html>

