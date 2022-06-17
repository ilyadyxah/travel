@extends('layouts.main')
@section('title')
    @parent Публичный профиль {{ $user->name }}
@endsection
@section('header')
@endsection
@section('content')
    @if($user->is_private)
        <div class="container vh-100 d-flex justify-content-center">
            <div class="card text-center w-50">
                <div class="card-header">
                    Профиль пользователя не является публичным
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Попросите пользователя открыть свой профиль
                    </p>
                    <div class="d-flex justify-content-center">
                        <a href="#" class="btn btn-primary">Написать</a>
                    </div>
                </div>

            </div>
        </div>

    @else
        <section class="profile">
            <header class="header">
                <div class="details m-2">
                    <img src="@if($user->avatar){!!$user->avatar!!}@else{!! asset('images/default_avatar.png') !!}@endif" class="profile-pic" height="150" width="150">
                    <p class="heading">{{$user->name}}</p>
                    <div class="location">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12 ,2Z"></path>
                        </svg>
                        <p>Россия</p>
                    </div>
                    <div class="stats">
                        <a href="{{ route('profile.places.index', ['title' => 'liked', 'user_slug' => $user->slug]) }}" class="col-4 text-decoration-none text-light @if(count($likes) === 0) disabled @endif">
                            <h4>{{ count($likes) }}</h4>
                            <p class="fs-3">
                                <i class="fa-solid fa-thumbs-up"></i>
                            </p>
                        </a>
                        <a  class="col-4 text-decoration-none text-light @if(count($favorites) === 0){{'disabled'}}@endif" href="{{ route('profile.places.index', ['title' => 'favorite', 'user_slug' => $user->slug]) }}">
                            <h4>{{ count($favorites) }}</h4>
                            <p class="fs-3">
                                <i class="fa-star fa-solid"></i>
                            </p>
                        </a>
                        <a  class="col-4 text-decoration-none text-light @if(count($created) === 0){{'disabled'}}@endif" href="{{ route('profile.places.index', ['title' => 'created', 'user_slug' => $user->slug]) }}">
                            <h4>{{ count($created) }}</h4>
                            <p class="fs-3">
                                <i class="fa-solid fa-map-location-dot"></i>
                            </p>
                        </a>
                    </div>
                </div>
            </header>
        </section>
    @endif
@endsection
