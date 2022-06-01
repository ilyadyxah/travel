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
