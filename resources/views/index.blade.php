<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;400;500;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/travel_style.css') }}" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <title>Travel</title>
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
</head>
<body>
<nav class='navbar'>
    <img src="{{ asset('image/logo.png') }}" alt="Logo" />
    <div class='navbar__inner'>
        <button class='nav_link'>Home</button>
        <button class='nav_link'>Destinations</button>
        <button class='nav_link'>About</button>
        <button class='nav_link'>Partner</button>
        <button class='nav_link btn'>Login</button>
        <button class='nav_link btn'>Register</button>
    </div>
</nav>
<main>
    <container>

        <div class='intro'>
            <div class='intro__inner'>
                <h1>Исследуй и путешествуй</h1>
                <div class='finder d-flex flex-column'>
                        <h3>Поиск путешествия</h3>
                        <div class='finder__switchers d-flex flex-column justify-content-around align-items-start'>
                            <select data-id="city" class="mb-2">
                                <option selected disabled>Выберите город</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ Str::ucfirst($city->title) }}</option>
                                @endforeach
                            </select>
                            <select disabled class="mb-2">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                            </select>
                            <select disabled class="mb-2">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                            </select>
                            <select disabled class="mb-2">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                            </select>
                        </div>
                        <input class='btn finder_btn' data-id="buttonFindPlaces" type="submit" value="Найти путешествие"/>
                </div>
            </div>
            <img src="{{ asset('image/thousand-01.png') }}" alt="img"/>
        </div>
    </container>

    <div class="listing">

    </div>
</main>

<container>
    <div class="content">
        <section class="section">
            <div>
                <h2>JourneyCard</h2>
                <div>
                    <img src="{{ asset('image/Skadar.png') }}" alt="Card" />
                    <h3>Название тура</h3>
                    <p>City of journey #1</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat maiores eos ducimus saepe non. Sapiente, ut? </p>
                </div>
            </div>
        </section >
        <section class="section">
            <div>
                <h2>JourneyCard</h2>
                <div>
                    <img src="{{ asset('image/Vevey.png') }}" alt="Card" />
                    <h3>Название тура</h3>
                    <p>City of journey #2</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat maiores eos ducimus saepe non. Sapiente, ut? </p>
                </div>
            </div>
        </section>
        <section class="section">
            <div>
                <h2>JourneyCard</h2>
                <div>
                    <img src="{{ asset('image/Raja ampat.png') }}" alt="Card" />
                    <h3>Название тура</h3>
                    <p>City of journey #3</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat maiores eos ducimus saepe non. Sapiente, ut? </p>
                </div>
            </div>
        </section>
        <section class="section">
            <div>
                <h2>JourneyCard</h2>
                <div>
                    <img src="{{ asset('image/Fanjingshan.png') }}" alt="Card" />
                    <h3>Название тура</h3>
                    <p>City of journey #4</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat maiores eos ducimus saepe non. Sapiente, ut? </p>
                </div>
            </div>
        </section>
    </div>
</container>

</body>
<script type="text/javascript" src="{!! asset('js/RenderPlaces.js') !!}"></script>
</html>
