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
        <p><input class='btn finder_btn' type="submit" value="Найти путешествие"/></p>
    </form>
</div>
