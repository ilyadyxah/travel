@extends('layouts.main')
@section('title')
    @parent {{$pageTitle}}
@endsection
@section('header')

@endsection
@section('content')
    <p class="container text-center display-3">{{ Str::ucfirst($place->title) }}</p>

    <!-- Swiper -->
    <div class="wrapper">
        <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php $i=0; foreach ($place->images as $image): ?>
                    <?php if ($i==0) {$set_ = 'active'; } else {$set_ = ''; } ?> 
                        <div class='carousel-item <?php echo $set_; ?>' style="background-image: url('<?php echo $image->url; ?>');">
                            <img src='<?php echo $image->url; ?>' class='d-block w-100'>
                        </div>
                    <?php $i++; endforeach ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
        </div>
    </div>
    
    <div class="wrapper">
        <div class="">
            <div class="bg-light pt-1 px-1 pt-md-1 px-md-1 text-center">
                <div class="place_content">
                    <div class="place_box">
                        
                        <div class="like_box">
                                <span like="{{$place->id}}" onclick="likeHandle(this)">
                                    @if(in_array($place->id, $likes))
                                        <i class="fa-solid fa-thumbs-up"></i>
                                    @else
                                        <i class="fa-regular fa-thumbs-up"></i>
                                    @endif
                                </span>
                            <span id="like-{{$place->id}}"
                                    class="">{{ $place->likes->count() === 0 ? '' : $place->likes->count() }}</span>
                            @auth
                                <span favorite="{{$place->id}}" id="favorite-{{ $place->id }}"
                                        onclick="favoriteHandle(this)">
                                    @if(in_array($place->id, $favorites))
                                        <i class="fa-star fa-solid"></i>
                                    @else
                                        <i class="fa-star fa-regular"></i>
                                    @endif
                                </span>
                            @endauth
                            @auth
                                <span route="{{$place->id}}" onclick="routeHandle(this)">
                                    @if(in_array($place->id, $routes))
                                        <p>удалить маршрут</p>
                                    @else
                                        <p>добавить маршрут</p>
                                    @endif
                                </span>
                            @endauth
                        </div>
                        <h2 class="display-5"
                            data-id="city_name">@foreach($place->cities as $city){{ Str::ucfirst($city->title) }}@endforeach</h2>
                    </div>
                    <div class="place_description">
                        <p class="text_description">{{ $place->description }}</p>
                        <p class="text_description"><span>Сложность: </span>{{ $place->complexity }} из 100</p>
                        <p class="text_description">
                            <span>На чём можно добраться из города: </span>@foreach($place->transports as $transport){{ Str::ucfirst($transport->title) . ', ' }} @endforeach
                        </p>
                        <p class="text_description">
                            <span>Сколько стоит: </span>{{ $place->cost ? $place->cost . 'руб' : 'бесплатно'}} </p>
                        <p id="route_description"></p>

                    </div>
                </div>
            </div>
            <div class="route">
                <div class="route_coordinates">
                    <p>Координаты окончания маршрута:
                        <!-- Широта -->
                        <span id="end_latitude">{{ $place->latitude }}</span>,
                        <!-- Долгота -->
                        <span id="end_longitude">{{ $place->longitude }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container base_bg p-4">
        <div class="row">
            <div id="map" class=" col-8"  style="width: 60%; height: 400px"></div>

            <div class="col-4 text-center form_bg p-2">
                <h3 class="" >Поделитесь впечатлениями</h3>
                <form action="" class="row justify-content-md-center ">
                        <input type="text" class="col-md-12" style="height: 200px" >
                        <p class="d-flex justify-content-center"><input type="button" class='btn' value="Оставить отзыв"></p>
                </form>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @include('components/review')
        @include('components/review')
        @include('components/review')
        @include('components/review')
        @include('components/review')
    </div>

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            spaceBetween: 10,
            slidesPerView: 3,
            freeMode: true,
            watchSlidesProgress: true,
        });
        var swiper2 = new Swiper(".mySwiper2", {
            loop: true,
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
    </script>
@endsection
@once
    @push('js')
        <script src="{{ asset('js/likeHandle.js')}}"></script>
        <script src="{{ asset('js/favoriteHandle.js')}}"></script>
        <script src="{{ asset('js/yandex_map_route_to_place.js') }}"  type="text/javascript"></script>
        <script src="{{ asset('js/routeHandle.js') }}"  type="text/javascript"></script>
    @endpush
@endonce


