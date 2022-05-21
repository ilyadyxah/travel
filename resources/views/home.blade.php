
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
{{--            <Finder onfindReqwest={handlefindReqwest} />--}}
            <div class='finder'>
                <form onSubmit={onfindReqwest} class='finder__form'>
                    <h3>Поиск путешествия</h3>
                    <div class='finder__form_box'>
                        <div class="finder__form_box_inner_switch">
                            <select class="find_select">
                                <option value="1" >город</option>
                            </select>
                            <select class="find_select">
                                <option value="1" >транспорт</option>
                            </select>
                        </div>
                        <div class="finder__form_box_inner">
                            <div class='finder__input_box'>
                                <label for="name">
                                    <span>Цена</span><br> От
                                    <input name="name" class='find_input' type='number' step={step} value={valueMin} min='0' onChange={handleChangeMin} />
                                </label>
                                <label for="">
                                    До
                                    <input class='find_input' type='number' step={step} value={valueMax} min={valueMin} onChange={handleChangeMax} />
                                </label>
                            </div>
                        </div>
                        <div class="finder__form_box_inner">
                            <div class='finder__input_box'>
                                <label for="name">
                                    <span>Сложность</span><br> От
                                    <input name="name" class='find_input' type='number' step={step} value={valueMin} min='0' onChange={handleChangeMin} />
                                </label>
                                <label for="">
                                    До
                                    <input class='find_input' type='number' step={step} value={valueMax} min={valueMin} onChange={handleChangeMax} />
                                </label>
                            </div>
                        </div>
                        <div class="finder__form_box_inner">
                            <div class='finder__input_box'>
                                <label for="name">
                                    <span>Удаленность</span><br> От
                                    <input name="name" class='find_input' type='number' step={step} value={valueMin} min='0' onChange={handleChangeMin} />
                                </label>
                                <label for="">
                                    До
                                    <input class='find_input' type='number' step={step} value={valueMax} min={valueMin} onChange={handleChangeMax} />
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
                    <p class='card__like'>
                        {{--            <LikeBtn travel={travel} />--}}
                    </p>
                </a>
            </div>
        @endforeach
    </div>
@endsection
