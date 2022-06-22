@extends('layouts.main')
@section('title')
    @parent {{ Str::ucfirst($title) }} места {{ $user->name }}
@endsection
@section('header')
    <div class="container text-center pt-4">
        <h2>{{ Str::ucfirst($title) }} места {{ $user->name }}</h2>
    </div>
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
    <div class="container">
        <div class="row g-4">
            @include('components/place_card')
        </div>
    </div>
    @endif
@endsection
@once
    @push('js')
        <script src="{{ asset('js/likeHandle.js')}}"></script>
        <script src="{{ asset('js/favoriteHandle.js')}}"></script>
        <script src="{{ asset('js/routeHandle.js')}}"></script>
    @endpush
@endonce
