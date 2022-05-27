@foreach($journeys as $place)
    <div class="col-4 card card_body">
        <a href="{{ route('places.show', $place) }}" class="bg-dark">
            <img class='card-img' src="{{ $images->find($place->main_picture_id)->url }}"
                 alt="{{ $place->title }}"/>
        </a>
        <div class="card_bottom">
            <a class="card-title" href="{{ route('places.show', $place) }}">
                <h5>{{Str::ucfirst($place->title)}}</h5>
            </a> 
            <div class="card_like_container">
<span like="{{$place->id}}" onclick="likeHandle(this)">
            @if(in_array($place->id, $likes))
                <i class="fa-solid fa-thumbs-up"></i>
            @else
                <i class="fa-regular fa-thumbs-up"></i>
            @endif
        </span>

        <span id="like-{{$place->id}}"
              class="">{{ $place->likes->count() === 0 ? '' : $place->likes->count() }}
        </span>
        @auth
            <span favorite="{{$place->id}}"
                  id="favorite-{{ $place->id }}"
                  onclick="favoriteHandle(this)">
                @if(in_array($place->id, $favorites))
                    <i class="fa-star fa-solid"></i>
                @else
                    <i class="fa-star fa-regular"></i>
                @endif
            </span>
        @endauth
            </div>
             
        </div>
        <p class="card-text">{{ mb_substr($place->description, 0, 100) . '...'}}</p>
            <p class="card-text"> - расстояние от города {{ $place->distance }} км</p>
    </div>
@endforeach
