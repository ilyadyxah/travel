@extends('layouts.main')
@section('title')
    @parent Профиль
@endsection
@section('header')
@endsection
@section('content')
    <section class="profile ">
        @include('inc.message')
            <div class="details m-2">
                <img src="@if(Auth::user()->avatar){!!Auth::user()->avatar!!}@else{!! asset('images/default_avatar.png') !!}@endif" class="profile-pic" height="150" width="150">
                <p class="heading">{{Auth::user()->name}}</p>
                <div class="location">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12 ,2Z"></path>
                    </svg>
                    <p>Россия</p>
                </div>
                <div class="stats">
                    <a href="{{ route('account.places', 'liked') }}" class="col-4 text-decoration-none  @if(count($likes) === 0) disabled @endif">
                        <h4>{{ count($likes) }}</h4>
                        <p class="fs-3">
                            <i class="fa-solid fa-thumbs-up"></i>
                        </p>
                    </a>
                    <a  class="col-4 text-decoration-none @if(count($favorites) === 0){{'disabled'}}@endif" href="{{ route('account.places', 'favorite') }}">
                        <h4>{{ count($favorites) }}</h4>
                        <p class="fs-3">
                            <i class="fa-star fa-solid"></i>
                        </p>
                    </a>
                    <a  class="col-4 text-decoration-none @if(count($created) === 0){{'disabled'}}@endif" href="{{ route('account.places', 'created') }}">
                        <h4>{{ count($created) }}</h4>
                        <p class="fs-3">
                            <i class="fa-solid fa-map-location-dot"></i>
                        </p>
                    </a>
                </div>
                <form class="d-flex align-items-center flex-column" method="get" action="{{ route('app::parse', ['count' => 10]) }}">
                    @csrf
                    <div class="d-inline-flex gap-1 align-items-center justify-content-evenly">
                        <select name="source-id" class="form-select flex-fill h-auto">
                            @foreach($sources as $source)
                                    <option value="{{ $source->id }}">{{ $source->title . ': уже получено - ' .  $source->total_parsed_items}}</option>
                            @endforeach
                        </select>
                        <input name="count" type="text" class="form-control h-auto"  placeholder="введите количество" value="{{ old('count') }}">

                    </div>
                    <button type="submit" class="btn btn-sm btn-outline-success h-100">Спарсить</button>

                </form>
            </div>
    </section>

@endsection

