
@extends('layouts.main')
@section('title')
    @parent Главная
@endsection
@section('header')

@endsection
@section('content')
    <div class='intro'>
        <div class='intro__inner'>
            <h1>Исследуй и путешествуй</h1>
            @include('components.filter')
        </div>
        <div class='intro_img_box'>
            <img class='intro_img' src="{{ asset('images/thousand-01.png') }}" alt="img" />
        </div>
    </div>
    <div class="row g-4">
        @foreach($places as $place)
            <div class="col-4">
                <a class="card bg-dark text-white">
                    <img class='card-img' src="{{ $images->find($place->main_picture_id)->url }}" alt="{{ $place->title }}"/>
                    <div class="card-img-overlay">
                        <h5 class="card-title">{{Str::ucfirst($place->title)}}</h5>
                        <p class="card-text">{{ $place->description }}</p>
                        <p class="card-text"> расстояние от города {{ $place->distance }}</p>
                    </div>
                </a>
                <span like="{{$place->id}}" onclick="likeHandle(this)">
                            @if(in_array($place->id, $likes))
                        <i class="fa-star fa-solid"></i>
                    @else
                        <i class="fa-star fa-regular"></i>
                    @endif
                </span>
                <span id="like-{{$place->id}}" class="">{{ $place->likes->count() === 0 ? '' : $place->likes->count() }}</span>
            </div>
        @endforeach
    </div>
@endsection
@once
    @push('js')
        <script src="{{ asset('js/likeHandle.js')}}"></script>
    @endpush
@endonce
