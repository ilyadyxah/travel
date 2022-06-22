@extends('layouts.main')
@section('title')
    @parent Мои места
@endsection
@section('header')
    <div class="container text-center pt-4 ">
        <h2>Мои {{ $title }} места</h2>
    </div>
@endsection
@section('content')
    @include('inc.message')
    <div class="container">
        <div class="row g-4">
            @include('components/place_card')
        </div>
    </div>
@endsection
@once
    @push('js')
        <script src="{{ asset('js/likeHandle.js')}}"></script>
        <script src="{{ asset('js/favoriteHandle.js')}}"></script>
        <script src="{{ asset('js/routeHandle.js')}}"></script>
    @endpush
@endonce
