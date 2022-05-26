@extends('layouts.main')
<!-- Demo styles -->
<style>
    .swiper {
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }


    .swiper {
        width: 100%;
        height: 300px;
        margin-left: auto;
        margin-right: auto;
    }

    .swiper-slide {
        background-size: cover;
        background-position: center;
    }

    .mySwiper2 {
        height: 80%;
        width: 100%;
    }

    .mySwiper {
        height: 20%;
        box-sizing: border-box;
        padding: 10px 0;
    }

    .mySwiper .swiper-slide {
        width: 25%;
        height: 100%;
        opacity: 0.4;
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
@section('title')
    @parent {{$pageTitle}}
@endsection
@section('header')

@endsection
@section('content')
    <p class="container text-center display-3">{{ Str::ucfirst($place->title) }}</p>

    <!-- Swiper -->

    <div class="mx-0  row">
        <div class="col-8">
            <div
                style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                class="swiper mySwiper2"
            >
                <div class="swiper-wrapper">
                    @foreach($place->images as $image)
                        <div class="swiper-slide">
                            <img src="{{ $image->url }}" />
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <div thumbsSlider="" class="swiper mySwiper mt-2">
                <div class="swiper-wrapper">
                    @foreach($place->images as $image)
                        <div class="swiper-slide">
                            <img src="{{ $image->url }}"/>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-4 h-100">
            <div class="bg-light me-md-3 pt-1 px-1 pt-md-1 px-md-1 text-center">
                <div class=" p-3">
                    <h2 class="display-5">@foreach($place->cities as $city){{ Str::ucfirst($city->title) }}@endforeach</h2>
                    <p class="lead">{{ $place->description }}</p>
                    <p class="lead"><span class="">Расстояние от города: </span>{{ $place->distance }} км</p>
                    <p class="lead"><span>Сложность: </span>{{ $place->complexity }} из 100</p>
                    <p class="lead"><span>Как добраться: </span>@foreach($place->transports as $transport){{ Str::ucfirst($transport->title) }} @endforeach</p>
                    <p class="lead"><span>Сколько стоит: </span>{{ $place->cost ? $place->cost . 'руб' : 'бесплатно'}} </p>
                    <span like="{{$place->id}}" onclick="likeHandle(this)">
                    @if(in_array($place->id, $likes))
                            <i class="fa-solid fa-thumbs-up"></i>
                        @else
                            <i class="fa-regular fa-thumbs-up"></i>
                        @endif
                </span>

                    <span id="like-{{$place->id}}" class="">{{ $place->likes->count() === 0 ? '' : $place->likes->count() }}</span>
                    @auth
                        <span favorite="{{$place->id}}" id="favorite-{{ $place->id }}" onclick="favoriteHandle(this)">
                        @if(in_array($place->id, $favorites))
                                <i class="fa-star fa-solid"></i>
                            @else
                                <i class="fa-star fa-regular"></i>
                            @endif
                    </span>
                    @endauth
                </div>
            </div>
        </div>
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

    @endpush
@endonce

