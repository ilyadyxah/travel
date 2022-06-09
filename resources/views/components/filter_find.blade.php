<h3 style="text-align: center">Поиск путешествия</h3>
<div class='finder'>
    <form method="post" action="{{ route('app::journeys') }}" class='finderTwo__form'>
        @csrf
        <input type="text"
               name="search"
               class="form-control form_custom-style"
               placeholder="Найти..."
               style="width: 90%"
        >
        <select name="city" class="find_select form_custom-style" style="width: 300px">
            <option value="" selected>Выберите город</option>
            @foreach($cities as $city)
                <option value="{{ $city->id }}">{{ $city->title }}</option>
            @endforeach
        </select>
        <select name="transport" class="find_select form_custom-style" style="width: 300px">
            <option value="" selected>Выберите транспорт</option>
            @foreach($transports as $transport)
                <option value="{{ $transport->id }}">{{ $transport->title }}</option>
            @endforeach
        </select>
        <select name="complexity" class="find_select form_custom-style" style="width: 300px">
            <option value="" selected>Выберите сложность</option>
            @for($i = 0; $i <= 10; $i++)
                <option value="{{ $i*10 }}">{{ $i*10 }}</option>
            @endfor
        </select>
        <div class="finder__form_box_inner">
            <div class='finder__input_box'>
                <label for="minCost">
                    <div class="label">Расходы</div>

                    <input name="minCost" class='find_input' type='number'>
                    -
                    <input name="maxCost" class='find_input' type='number'>
                </label>
            </div>
        </div>
        <div class="finder__form_box_inner">
            <div class='finder__input_box'>
                <label for="minDistance">
                    <div class="label">Удаленность</div>

                    <input name="minDistance" class='find_input' type='number'>
                    -
                    <input name="maxDistance" class='find_input' type='number'>
                </label>
            </div>
        </div>
        <p><input class='btn finder_btn' type="submit" value="Найти путешествие"/></p>
    </form>
</div>
