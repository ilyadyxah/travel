@forelse($places as $place)
    <div style="width: 400px;">
        <h3>{{ $place->title }}</h3>
        <p>{{ $place->description }}</p>
        <a href=""><img src="{{ $place->url }}" height="300px" alt=""></a>
    </div>
@empty
    <h3>Путешествий в выбранном городе нет</h3>
@endforelse

