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
        @forelse($journeys as $place)
            <div class="place-coords">
                <input type="hidden" name="latitude" value="{{ $place->latitude }}">
                <input type="hidden" data-id="longitude" value="{{ $place->longitude }}">
            </div>
            <div class="row g-4">
                <div class="col-3">
                    <a href="{{ route('places.show', $place) }}" class="bg-dark rounded-3">
                        <img class='card-img' src="
                        @if($place->main_picture_id)
                        {{
                            str_starts_with($images->find($place->main_picture_id)->url, 'http'))
                            ? $images->find($place->main_picture_id)->url
                            : Storage::disk('public')->url($images->find($place->main_picture_id)->url
                        }}
                        @else {{ 'https://e7.pngegg.com/pngimages/76/438/png-clipart-classical-compass-winds-cztery-wielkie-wynalazki-hybert-design-golden-compass-golden-frame-technic.png' }}
                        @endif"
                             alt="{{ $place->title }}"
                             style="height: 150px; object-fit: cover;"/>
                    </a>
                </div>
                <div class="col-2">
                    <p>{{ $place->title }}</p>
                </div>
                <div class="col">
                    <p style="text-indent: 1.5em; text-align: justify;"
                       class="card-text">{{ Str::ucfirst(mb_substr($place->description, 0, 100)) . '...'}}</p>
                </div>
                <div class="col-1">
                    <button type="button" class="btn-close" name="id_{{ $place->id }}" aria-label="Close"></button>
                </div>
            </div>
        @empty
            <p>Нет маршрутов</p>
        @endforelse
        </div>
        <div id="routes" style="width:900px; max-width: 40%; height: 700px"></div>
    </div>
@endsection
@once
    @push('js')
        <script src="{{ asset('js/yandex_map_multi_route.js')}}"></script>
    @endpush
@endonce
