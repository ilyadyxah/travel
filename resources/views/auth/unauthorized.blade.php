@extends('layouts.main')
@section('title')
    @parent Пользователь не авторизован
@endsection
@section('header')
@endsection
@section('content')
    <div class="container vh-100 d-flex justify-content-center">
        <div class="card text-center w-50">
            <div class="card-header">
                Ошибка авторизации
            </div>
            <div class="card-body">
                <p class="card-text">
                    {{ Str::ucfirst($user->name) }}, Вы не авторизованы для этого действия.
                </p>
                <div class="d-flex justify-content-center">
                    <a href="#" class="btn btn-primary">Настройки профиля</a>
                </div>
            </div>

        </div>
    </div>
@endsection



