
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
            <div class='finder'>
                <form method="post" action="{{ route('app::journeys') }}" class='finder__form'>
                    @csrf
                    <h3>Поиск путешествия</h3>
                    <div class='finder__form_box'>
                        <div class="finder__form_box_inner_switch">
                            <select name="city" class="find_select">
                                <option value="" selected>Выберите город</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}"> {{ $city->title }}</option>
                                @endforeach
                            </select>
                            <select name="transport" class="find_select">
                                <option value="" selected>Выберите транспорт</option>
                                @foreach($transports as $transport)
                                    <option value="{{ $transport->id }}">{{ $transport->title }}</option>
                                @endforeach
                            </select>
                            <select name="complexity" class="find_select">
                                <option value="" selected>Выберите сложность</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="finder__form_box_inner">
                            <div class='finder__input_box'>
                                <label for="minCost">
                                    <span>Цена</span><br> От
                                    <input name="minCost" class='find_input' type='number'>
                                </label>
                                <label for="maxCost">
                                    До
                                    <input name="maxCost" class='find_input' type='number'>
                                </label>
                            </div>
                        </div>
                        <div class="finder__form_box_inner">
                            <div class='finder__input_box'>
                                <label for="minDistance">
                                    <span>Удаленность</span><br> От
                                    <input name="minDistance" class='find_input' type='number'>
                                </label>
                                <label for="">
                                    До
                                    <input name="maxDistance" class='find_input' type='number'>
                                </label>
                            </div>
                        </div>
                    </div>

                    <p><input class='btn finder_btn' type="submit" value="Найти путешествие" /></p>
                </form>
            </div>
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
