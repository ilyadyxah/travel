@extends('layouts.main')
@section('title')
    {{ $title }} места @parent
@endsection
@section('header')
    <div class="container text-center ">
        <p class="h2">{{ $title }} места</p>
    </div>
@endsection
@section('content')
    <div class="row g-4 container">
        <form method="post" action="{{ route('account.place.' . $method, [$param]) }}" enctype="multipart/form-data">
            @csrf
            @if($method == 'update')
                @method('put')
            @endif
            <div class="mb-3 card p-2">
                @foreach($fieldsToCreate as $field => $cyrillicName)
                    @error($field)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                    <label for="{{ $field }}" class="form-label">{{ Str::ucfirst($cyrillicName) }}</label>
                    @if($field === 'description')
                        <textarea name="{{ $field }}" rows="3" cols="5" class="form-control" id="{{ $field }}" name="{{ $field }}">@if(isset($place)){{$place->$field}}@else{{old($field)}}@endif</textarea>

                        @continue
                    @endif
                    @if($field === 'longitude')
                        <input name="{{ $field }}" type="text" class="form-control" id="{{ $field }}" placeholder="{{ $cyrillicName }}" value="@if(isset($place)){{$place->$field}}@else{{old($field)}}@endif">
                        <a class="btn btn-sm btn-outline-secondary small p-2 align-self-center" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Отметить на карте
                        </a>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <div id="mapCoords" style="width: 100%; height: 400px"></div>
                            </div>
                        </div>

                        @continue
                    @endif
                    @if($field === 'complexity')
                        <select id="{{ $field }}" name="{{ $field }}" class="form-select m-0" aria-label="Default select example">
                            @for($i = 1; $i <= 10; $i++)
                                @if(old($field))
                                    <option value="{{ $i }}" @if(old($field) == $i) selected @endif>{{ $i}}</option>
                                @else
                                    <option value="{{ $i }}" @if(isset($place) && $place->$field == $i) selected @endif>{{ $i}}</option>
                                @endif
                            @endfor
                        </select>
                        @continue
                    @endif
                    <input name="{{ $field }}" type="text" class="form-control" id="{{ $field }}" placeholder="{{ $cyrillicName }}" value="@if(isset($place)){{$place->$field}}@else{{old($field)}}@endif">
                @endforeach
                @foreach($linkedFields as $field => $cyrillicName)
                        @error($field)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @enderror

                        <label for="{{ $field }}" class="form-label">{{ Str::ucfirst($cyrillicName) }}</label>
                        @if($field === 'images')
                            @error('images.*')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>{{ $message }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @enderror
                            <input multiple name="{{ $field }}[]" class="form-control" type="file" id="{{ $field }}">
                            <input multiple name="deletedImages" class="form-control" id="deletedImages" hidden>

                        @if(isset($place))
                                <p class="text-center">Изображения места</p>
                            <div class="d-flex align-items-center justify-content-around g-1">
                                @forelse($place->$field as $image)
                                    <div class="position-relative">
                                        <input name="{{ $image->id }}" class="form-check-input position-absolute" type="checkbox" id="{{ $image->id }}" checked onclick="imagesToDelete(this)">
                                        <label  class="form-check-label" for="{{ $image->id }}">
                                            <img width="150" src="@if(str_starts_with($image->url, 'http')){{ $image->url }}@else{{Storage::disk('public')->url($image->url)}}@endif" class="img-thumbnail" alt="{{ $place->title }}">
                                        </label>
                                    </div>
                                @empty
                                    <p class="text-center">Изображения отсутствуют</p>
                                @endforelse
                            </div>
                            @endif
                            @continue
                        @endif
                        @if($field === 'cities')
{{--                            <select multiple id="{{ $field }}" name="{{ $field }}[]" class="form-select m-0" aria-label="Default select example" list="datalistOptions" id="exampleDataList">--}}
                            <input name="{{ $field }}" class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Начните печатать..." value="@if(isset($place)){{$place->$field->first()->title}}@else{{old($field)}}@endif">
                            <datalist id="datalistOptions">
                                @foreach($$field as $item)
                                    <option value="{{ $item->title }}">
                                @endforeach
                            </datalist>
                            @continue

                        @endif
                        <select multiple id="{{ $field }}" name="{{ $field }}[]" class="form-select m-0" aria-label="Default select example">
                            @foreach($$field as $item)
                                @if(old($field))
                                    <option value="{{ $item->id }}" @if(old($field) !== null && in_array($item->id, old($field))) selected @endif>{{ Str::ucfirst($item->title) }}</option>
                                @else
                                    <option value="{{ $item->id }}" @if(isset($place) && $place->$field->contains('title', $item->title)) selected @endif>{{ Str::ucfirst($item->title) }}</option>
                                @endif
                            @endforeach
                        </select>
                    @endforeach

            </div>
                <button type="submit"  class="btn btn-outline-success">{{$button ?? 'Создать'}}</button>

            </form>
    </div>
@endsection

<script>
    const deletedImages = [];
    function imagesToDelete(el)
    {
        if (deletedImages.includes(el.id)){
            deletedImages.splice(deletedImages.indexOf(el.id), 1)
        } else {
            deletedImages.push(el.id);
        }

        document.getElementById('deletedImages').value = deletedImages

    }
</script>
@once
    @push('js')
        <script src="{{ asset('js/yandex_map_create_place.js') }}"  type="text/javascript"></script>
    @endpush
@endonce
