@extends('layouts.main')
@section('title')
    @parent Мои маршруты
@endsection
@section('header')
    <div class="container text-center ">
        <h2>Мои маршруты</h2>
    </div>
@endsection
@section('content')
    @include('inc.message')
    <div class="container" style="display: flex">
        <div class="places-table" style="width: 50%;">
        @forelse($routes as $route)
            <div class="place-table-item" id="{{ $route->place->id }}">
                <div class="place-coords">
                    <input type="hidden" name="latitude" value="{{ $route->place->latitude }}">
                    <input type="hidden" data-id="longitude" value="{{ $route->place->longitude }}">
                </div>
                <div class="row route_place">
                    <div class="col-5">
                        <a href="{{ route('places.show', $route->place) }}" class="bg-dark rounded-3">
                            <img class='card-img' src="
                        @if($route->place->main_picture_id)
                            {{
                                str_starts_with($route->place->images->find($route->place->main_picture_id)->url, 'http'))
                                ? $route->place->images->find($route->place->main_picture_id)->url
                                : Storage::disk('public')->url($route->place->images->find($route->place->main_picture_id)->url
                            }}
                            @else {{ 'https://e7.pngegg.com/pngimages/76/438/png-clipart-classical-compass-winds-cztery-wielkie-wynalazki-hybert-design-golden-compass-golden-frame-technic.png' }}
                            @endif"
                                 alt="{{ $route->place->title }}"
                                 style="height: 150px; object-fit: cover;"/>
                        </a>
                    </div>

                    <div class="col-6 text-center">
                        <div class="row justify-content-md-center">
                            <h3 class="col-10">{{ $route->place->title }}</h3>
                            <button class="btn_info btn-primary col-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePlaceInfo{{ $route->place->id }}" aria-expanded="false" aria-controls="collapsePlaceInfo{{ $route->place->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                </svg>
                            </button>    
                        </div>
                        <div class="row">
                            <div class="col-10 text-center">
                                <h4 class="point-name" style="font-weight: bold"> метка - A </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <button type="button" class="btn-close btn-close-route" name="{{ $route->place->id }}" aria-label="Close">
                        </button>
                    </div>
                </div>
                <div class="collapse" id="collapsePlaceInfo{{ $route->place->id }}">
                    <div class="extra_box">
                        <p style="text-indent: 1.5em; text-align: justify;"
                        class="card-text">{{ Str::ucfirst(mb_substr($route->place->description, 0, 100)) . '...'}}</p>
                    </div>
                </div>
            </div>
        @empty
            <p>Нет маршрутов</p>
        @endforelse
        </div>
        <div id="routes" style="width:900px; max-width: 45%; height: 700px"></div>
    </div>
@endsection
@once
    @push('js')
        <script src="{{ asset('js/yandex_map_multi_route.js')}}"></script>
        <script src="{{ asset('js/userRoutesHandle.js')}}"></script>
    @endpush
@endonce
