@forelse($journeys as $place)
    <div class="col-4 card card_body">
        <a href="{{ route('places.show', $place) }}" class="bg-dark">
            <img class='card-img' src="@if(str_starts_with($images->find($place->main_picture_id)->url, 'http')){{$images->find($place->main_picture_id)->url}}@else{{Storage::disk('public')->url($images->find($place->main_picture_id)->url)}}@endif"
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
                    @if($place->created_by_user_id === Auth::user()->id)
                        @if(request()->routeIs('account.place*'))
                            <div class="d-flex justify-content-evenly">
                                <a class="text-secondary text-decoration-none" href="{{ route('account.place.edit', [$place]) }}">
                                    <i class="fa-solid fa-gear"></i>
                                </a>
                                <form method="post" action="{{ route('account.place.destroy', $place) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="text-danger text-decoration-none border-0 bg-transparent" type="submit">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>

                        @else
                            <a class="text-secondary text-decoration-none" href="{{ route('account.places', 'created') }}">
                                <i class="fa-solid fa-list-check"></i>
                            </a>
                        @endif
                    @endif


                @endauth
            </div>

        </div>
        <p class="card-text">{{ mb_substr($place->description, 0, 100) . '...'}}</p>
        <p class="card-text"> - расстояние от города {{ $place->distance }} км</p>
    </div>
@empty
  <h3 class="text-warning text-center vh-100">Не найдено</h3>
@endforelse
