@extends('layouts.main')
@section('title')
    @parent Главная
@endsection
@section('header')

@endsection
@section('content')
    <div class="container">
        <div class='intro '>
            <div class="row ">
                <div class='intro__inner col'>
                    <div class="intro_header">
                        <h1 class="text-uppercase">Исследуй и путешествуй</h1>
                    </div>
                    @include('components.filter')
                </div>
            </div>
        </div>
    </div>

    @include('components/place_card')
    <div class="row justify-content-center">
        {{$journeys->links()}}
    </div>

@endsection
@once
    @push('js')
        <script src="{{ asset('js/likeHandle.js')}}"></script>
        <script src="{{ asset('js/favoriteHandle.js')}}"></script>
        <script src="{{ asset('js/routeHandle.js') }}" type="text/javascript"></script>
    @endpush
@endonce
