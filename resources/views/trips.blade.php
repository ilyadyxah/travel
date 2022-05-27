@extends('layouts.main')
@section('title')
    @parent Путешествия
@endsection
@section('header')

@endsection
@section('content')
    <div class='intro'>
        <div class="row container">
            <div class='intro__inner col'>
                @include('components.filter')
            </div>
        </div>
    </div>
    <div class="row g-4">
        @if ($journeys->count())
            <h3> Найдено {{ $journeys->count() }} путешествий </h3>
            <div class="row g-4 container">
                @include('components/place_card')
            </div>
        @else
            <h3>{{ $message }}</h3>
        @endif
    </div>
@endsection
@once
    @push('js')
        <script src="{{ asset('js/likeHandle.js')}}"></script>
        <script src="{{ asset('js/favoriteHandle.js')}}"></script>
    @endpush
@endonce
