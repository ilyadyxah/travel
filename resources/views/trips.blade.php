
@extends('layouts.main')
@section('title')
    @parent Путешествия
@endsection
@section('header')

@endsection
@section('content')
    <div class="row g-4">

        @foreach($journeys as $journey)
            <div class="col-4">
                <a class="card bg-dark text-white">
                    <img class='card-img' src="{{ $journey->main_picture }}" alt="{{ $journey->title }}"/>
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
    </div>
@endsection
