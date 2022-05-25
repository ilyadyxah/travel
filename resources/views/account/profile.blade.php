@extends('layouts.main')
@section('title')
    @parent Профиль
@endsection
@section('header')
@endsection
@section('content')
    <section class="profile">
        <header class="header">
            <div class="details m-2">
                <img src="@if(Auth::user()->avatar){!!Auth::user()->avatar!!}@else{!!Storage::disk('public')->url('images/users/default.png')!!}@endif" class="profile-pic">
                <p class="heading">{{Auth::user()->name}}</p>
                <div class="location">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12 ,2Z"></path>
                    </svg>
                    <p>Россия</p>
                </div>
                <div class="stats">
                    <a href="{{ route('account.places', 'liked') }}" class="col-4 text-decoration-none text-light">
                        <h4>{{ count($likes) }}</h4>
                        <p class="fs-3">
                            <i class="fa-solid fa-thumbs-up"></i>
                        </p>
                    </a>
                    <a href="{{ route('account.places', 'favorite') }}" class="col-4 text-decoration-none text-light">
                        <h4>{{ count($favorites) }}</h4>
                        <p class="fs-3">
                            <i class="fa-star fa-solid"></i>
                        </p>
                    </a>
                    <a href="#" class="col-4 dropdown-item-text text-decoration-none text-light disabled" >
                        <h4>100</h4>
                        <p class="fs-3">
                            <i class="fa-solid fa-map-location-dot"></i>
                        </p>
                    </a>
                </div>
            </div>
        </header>
    </section>
@endsection
