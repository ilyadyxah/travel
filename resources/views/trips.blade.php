@extends('layouts.main')
@section('title')
    @parent Путешествия
@endsection
@section('header')

@endsection
@section('content')
    <div class="container trips_bg">
        @include('components.filter_find')
        <div class="row p-4">
            @if ($journeys->count())
                <h4> Найдено {{ $journeys->count() }} путешествий </h4>
                @include('components/place_card')
            @else
                <h3>{{ $message }}</h3>
            @endif
            <div class="row justify-content-center">
                {{$journeys->links()}}
            </div>
        </div>
    </div>
    
@endsection
@once
    @push('js')
        <script src="{{ asset('js/likeHandle.js')}}"></script>
        <script src="{{ asset('js/favoriteHandle.js')}}"></script>
        <script src="{{ asset('js/routeHandle.js') }}" type="text/javascript"></script>
    @endpush
@endonce


