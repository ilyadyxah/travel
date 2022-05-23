@extends('layouts.main')
@section('title')
    @parent Путешествия
@endsection
@section('header')

@endsection
@section('content')
    <div class="row g-4">
        @if (isset($journeys))
            @foreach($journeys as $journey)
                <div class="col-4">
                    <a class="card bg-dark text-white">
                        <img class='card-img' src="{{ $images->find($journey->main_picture_id)->url }}" alt="{{ $journey->title }}"/>
                        <div class="card-img-overlay">
                            <h5 class="card-title">{{Str::ucfirst($journey->title)}}</h5>
                            <p class="card-text">{{ $journey->description }}</p>
                            <p class="card-text"> расстояние от города {{ $journey->distance }}</p>
                        </div>
                        <p class='card__like'>
                            {{--            <LikeBtn travel={travel} />--}}
                        </p>
                    </a>
                </div>
            @endforeach
        @else
            <p>Путешествия не найдены</p>
        @endif
    </div>
@endsection
