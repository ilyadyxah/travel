<div class="container base_bg p-4">
    <div class="row">
        <div id="map" class=" col-8"  style="width: 60%; height: 400px"></div>
        <div class="col-4 text-center form_bg p-2">
            <h3 class="" >Поделитесь впечатлениями</h3>
            <form action="{{ route('account.comment.store') }}" method="post" class="row justify-content-md-center" enctype="multipart/form-data">
                @csrf
                @method('post')
                <input hidden name="target_table_id" value="{{ $target_table_id }}">
                <input hidden name="target_id" value="{{ $target_id }}">
                @error('message')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
                <input name="message" type="text" class="col-md-12" @guest() disabled @endguest style="height: 200px" value="{{ old('message') }}">
                    <p class="d-flex justify-content-center">
                        <input type="submit" class='btn' value="Оставить отзыв" @guest() disabled @endguest>
                    </p>
                @guest()
                    <p>
                        <a href="{{ route('login') }}" class="btn-success btn-sm text-decoration-none">
                            Авторизуйтесь
                        </a>
                        , чтобы оставить отзыв
                    </p>
                @endguest
            </form>
        </div>
    </div>
</div>

