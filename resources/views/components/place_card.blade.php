<div class="row row-cols-1 row-cols-md-3 g-4">

@forelse($journeys as $place)
    <div class="col-4 card card_body flip">
        <div class="front">
             <a href="{{ route('places.show', $place) }}" class="bg-dark rounded-3">
                <img class='card-img' src="@if($place->main_picture_id) {{ str_starts_with($images->find($place->main_picture_id)->url, 'http')) ? $images->find($place->main_picture_id)->url : Storage::disk('public')->url($images->find($place->main_picture_id)->url }}@else {{ 'https://e7.pngegg.com/pngimages/76/438/png-clipart-classical-compass-winds-cztery-wielkie-wynalazki-hybert-design-golden-compass-golden-frame-technic.png' }} @endif"
                    alt="{{ $place->title }}"
                style="height: 200px; object-fit: cover;"/>
            </a>
        </div>
       <div class="back">

        <div class="card_bottom flex-column  text-center ">
            <a class="card-title text-decoration-none p-1 bg-transparent" href="{{ route('places.show', $place) }}">
                <h5 style="height: 1.5em; word-break: break-all;" class="bg-none">{{Str::ucfirst($place->title)}}</h5>
            </a>
            <div class="card_like_container d-flex w-100 justify-content-evenly">
                <div>
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
                </div>

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
                            <div class="d-flex justify-content-evenly gap-3">
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
        <hr class="dropdown-divider">
        <p style="text-indent: 1.5em; text-align: justify;" class="card-text">{{ Str::ucfirst(mb_substr($place->description, 0, 100)) . '...'}}</p>

       </div>
    </div>
    @empty
  <h3 class="text-warning text-center vh-100 col align-self-center">Не найдено</h3>
    @endforelse
</div>



