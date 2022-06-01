@extends('layouts.main')
@section('title')
    @parent Новое место
@endsection
@section('header')
    <div class="container text-center ">
        <h2>Новое место</h2>
    </div>
@endsection
@section('content')
    <div class="row g-4 container">
        @if(isset($method))
            <form method="post" action="{{ route('account.place.update', [$place]) }}" enctype="multipart/form-data">
                @method('put')
        @else
            <form method="post" action="{{ route('account.place.store') }}" enctype="multipart/form-data">
        @endif
        @csrf
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
                        <textarea name="{{ $field }}" rows="3" cols="5" class="form-control" id="{{ $field }}" name="{{ $field }}">{{old($field)}}</textarea>

                        @continue
                    @endif
                    @if($field === 'coordinates')
                        <input name="{{ $field }}" type="text" class="form-control" id="{{ $field }}" placeholder="{{ $cyrillicName }}" value="{{old($field)}}">
                        @continue
                    @endif
                    @if($field === 'complexity')
                        <select id="{{ $field }}" name="{{ $field }}" class="form-select m-0" aria-label="Default select example">
                            @for($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" @if(old($field) == $i) selected @endif>{{ $i}}</option>
                            @endfor
                        </select>
                        @continue
                    @endif
                    <input name="{{ $field }}" type="text" class="form-control" id="{{ $field }}" placeholder="{{ $cyrillicName }}" value="{{old($field)}}">
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
                            <input multiple name="{{ $field }}[]" class="form-control" type="file" id="{{ $field }}">
                            @continue
                        @endif
                        @if($field === 'cities')
{{--                            <select multiple id="{{ $field }}" name="{{ $field }}[]" class="form-select m-0" aria-label="Default select example" list="datalistOptions" id="exampleDataList">--}}

                            <input name="{{ $field }}" class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Начните печатать..." value="{{old($field)}}">
                            <datalist id="datalistOptions">
                                @foreach($$field as $item)
                                    <option value="{{ $item->title }}">
                                @endforeach
                            </datalist>
                            @continue

                        @endif

                        <select multiple id="{{ $field }}" name="{{ $field }}[]" class="form-select m-0" aria-label="Default select example">
                            @foreach($$field as $item)
                                <option value="{{ $item->id }}" @if(old($field) !== null && in_array($item->id, old($field))) selected @endif>{{ Str::ucfirst($item->title) }}</option>
                            @endforeach
                        </select>
                    @endforeach

            </div>
                <button type="submit"  class="btn btn-outline-success">{{$button ?? 'Создать'}}</button>

            </form>
    </div>
@endsection
