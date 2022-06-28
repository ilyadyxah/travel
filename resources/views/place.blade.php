@extends('layouts.main')
@section('title')
    @parent {{$pageTitle}}
@endsection
@section('header')

@endsection
@section('content')
    <p class="container text-center display-3 py-4">{{ Str::ucfirst($place->title) }}</p>
    @include('inc.message')


    <!-- Swiper -->
        <div class="wrapper row">
            <div id="carousel" class="carousel col-8" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($place->images as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : ''}}" style="background-image: url({{ str_starts_with($image->url, 'http')) ? $image->url : Storage::disk('public')->url($image->url }});">
                                <img src='{{ str_starts_with($image->url, 'http')) ? $image->url : Storage::disk('public')->url($image->url }}' class='d-block w-100'>
                            </div>
                        @endforeach
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
            <div class="bg-light pt-1 px-1 pt-md-1 px-md-1 text-center col-4">
                <div class="place_content">
                    <div class="place_box">
                        <div class="like_container">
                            <div class="like_box">
                                <span style="cursor:pointer;" like="{{$place->id}}" onclick="likeHandle(this)">
                                    @if(in_array($place->id, $likes))
                                        <i class="fa-solid fa-thumbs-up"></i>
                                    @else
                                        <i class="fa-regular fa-thumbs-up"></i>
                                    @endif
                                </span>
                                <span id="like-{{$place->id}}"
                                        class="">{{ $place->likes->count() === 0 ? '' : $place->likes->count() }}
                                </span>
                            </div>
                            @auth
                            <div class="like_box">
                                <span style="cursor:pointer;" favorite="{{$place->id}}" id="favorite-{{ $place->id }}"
                                        onclick="favoriteHandle(this)">
                                    @if(in_array($place->id, $favorites))
                                        <i class="fa-star fa-solid"></i>
                                    @else
                                        <i class="fa-star fa-regular"></i>
                                    @endif
                                </span>
                            </div>
                            <div class="like_box">
                                <span style="cursor:pointer;" route="{{$place->id}}" onclick="routeHandle(this)">
                                    @if(in_array($place->id, $routes))
                                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pin-map-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z"/>
                                        <path fill-rule="evenodd" d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
                                        </svg>
                                    @else
                                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pin-map" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M3.1 11.2a.5.5 0 0 1 .4-.2H6a.5.5 0 0 1 0 1H3.75L1.5 15h13l-2.25-3H10a.5.5 0 0 1 0-1h2.5a.5.5 0 0 1 .4.2l3 4a.5.5 0 0 1-.4.8H.5a.5.5 0 0 1-.4-.8l3-4z"/>
                                        <path fill-rule="evenodd" d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999z"/>
                                        </svg>

                                    @endif
                                </span>
                            </div>
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
    </div>
    @component('components.comments.create', [
                    'target_table_id' => $place->targetId(),
                    'target_id' => $place->id
                    ])
    @endcomponent
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @component('components.review', ['comments' => $place->comments,])
        @endcomponent
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


