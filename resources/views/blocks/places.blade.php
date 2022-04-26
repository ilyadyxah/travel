    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 ">
            @forelse($places as $place)
                <div class="col card-group">
                    <div class="card shadow-sm">
                        @foreach($place->images as $image)
                        <img src="{{  $image->url }}" alt="{{ Str::ucfirst($place->title) }}"  class="card-img-top"  style="height: 200px;">
{{--                        @continue--}}
                        @endforeach
                            <div class="card-body d-flex flex-column flex-nowrap justify-content-between align-items-center">
                            <h5 class="card-title">{{ Str::ucfirst($place->title) }}</h5>
                            <p class="card-text flex-fill">{{ Str::ucfirst($place->description) }}</p>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary ">Подробнее</button>
                                </div>
                        </div>
                            <h5 class="card-title">Нравится {{ count($place->likes) }} пользователям</h5>

                            <h5 class="card-title">Комментарии: </h5>

                            @foreach($place->comments as $comment)
                                <h5 class="card-title">{{ $comment->message }}</h5>
                                <p class="card-text flex-fill">{{ $comment->user_name }}</p>
                            @endforeach
                    </div>
                </div>
            @empty
                <h3>Путешествий в выбранном городе нет</h3>
            @endforelse
        </div>
    </div>



