@extends('layouts.main')
@section('title')
    @parent Путешествия на карте
@endsection
@section('header')

@endsection
@section('content')
    <div class="map_bg">
        <div id="all_places_map" style="width: 80%; height: 700px"></div>
    </div>
@endsection
@once
    @push('js')
        <script src="{{ asset('js/yandex_map_show_all_places.js') }}"  type="text/javascript"></script>
    @endpush
@endonce
