@extends('layouts.main')
@section('title')
    @parent Мои места
@endsection
@section('header')
    <div class="container text-center ">
        <h2>Мои {{ $title }} места</h2>
    </div>
@endsection
@section('content')
    <div class="row g-4 container">
    @forelse($places as $place)
            <div class="col-4">
                <a href="{{ route('places.show', $place) }}" class="card bg-dark text-white">
                    <img class='card-img' src="{{ $images->find($place->main_picture_id)->url }}" alt="{{ $place->title }}"/>
                    <div class="card-img-overlay overflow-hidden">
                        <h5 class="card-title">{{Str::ucfirst($place->title)}}</h5>
                        <p class="card-text">{{ $place->description }}</p>
                        <p class="card-text"> расстояние от города {{ $place->distance }}</p>
                    </div>
                </a>
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
        @empty
            <div class=" text-center">
                <h4>Ничего не найдено</h4>
            </div>
        @endforelse
    </div>
@endsection
@once
    @push('js')
        <script src="{{ asset('js/likeHandle.js')}}"></script>
        <script src="{{ asset('js/favoriteHandle.js')}}"></script>
    @endpush
@endonce
