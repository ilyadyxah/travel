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
{{--                    @if($field === 'coordinates')--}}
{{--                        <input name="{{ $field }}" type="text" class="form-control" id="{{ $field }}" placeholder="{{ $cyrillicName }}" value="@if(isset($place)){{$place->$field}}@else{{old($field)}}@endif">--}}
{{--                        @continue--}}
{{--                    @endif--}}
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
                            <input multiple name="oldImages" class="form-control" id="oldImages" hidden>

                        @if(isset($place))
                                <p class="text-center">Изображения места</p>
                            <div class="d-flex align-items-center justify-content-around g-1">
                                @forelse($place->$field as $image)
                                    <div class="position-relative">
                                        <input name="{{ $image->id }}" class="form-check-input position-absolute" type="checkbox" id="{{ $image->id }}" checked onclick="checkboxToArray()">
                                        <label class="form-check-label" for="{{ $image->id }}">
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
                    <div id="mapCoords" style="width: 80%; height: 400px"></div>

            </div>
                <button type="submit"  class="btn btn-outline-success">{{$button ?? 'Создать'}}</button>

            </form>
    </div>
@endsection

<script>
    function checkboxToArray()
    {
        var array = []
        var checkboxes = document.querySelectorAll('input[type=checkbox]:checked')

        for (var i = 0; i < checkboxes.length; i++) {
            array.push(checkboxes[i].getAttribute('id'))
        }
        document.getElementById('oldImages').value = array
    }

</script>
