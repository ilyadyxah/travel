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
                        <h1>Исследуй и путешествуй</h1>
                        @include('components.filter')
                    </div>
                    <img class='intro_img' src="{{ asset('images/thousand-01.png') }}" alt="img" />
                </div>
        <div>

    </div>


    <div class="row row-cols-1 row-cols-md-3 g-4">
        @include('components/place_card')
    </div>
@endsection
@once
    @push('js')
        <script src="{{ asset('js/likeHandle.js')}}"></script>
        <script src="{{ asset('js/favoriteHandle.js')}}"></script>

    @endpush
@endonce
