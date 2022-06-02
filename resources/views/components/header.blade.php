<div class="container">
<nav class="navbar  d-flex align-items-center">
    <a class="text-decoration-none fs-1" href="{{ route('app::home') }}">
        <i class="fa-solid fa-suitcase"></i>
        <span>{{ config('app.name', 'Laravel') }}</span>
{{--        <img src={{asset('images/logo.png')}} alt="Logo" class='logo_nav' />--}}
    </a>
    <ul class='navbar__inner mb-0'>
{{--        <li >--}}
{{--            <a href="{{ route('app::home') }}" class='nav_link'>Домой</a>--}}
{{--        </li>--}}
        <li >
            <a href="{{ route('app::journeys') }}" class='nav_link'>Путешествия</a>
        </li>
        <li >
            <a href="#" class='nav_link'>Map</a>
        </li>
        <li>
            <a href="#" class='nav_link'>Media</a>
        </li>
        <li>
            <a href="#" class='nav_link'>Нужна помощь?</a>
        </li>
        @guest
            <li>
                <a href="{{route('login')}}" class='nav_link btn'>Вход</a>
            </li>
            <li>
                <a href="{{route('register')}}" class='nav_link btn'>Регистрация</a>
            </li>
        @endguest
        @auth
            <div class="dropdown">
                <a href="{{ route('account.profile') }}" class="d-block link-dark text-warning text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="true">
                    <img src="@if(Auth::user()->avatar){!!Auth::user()->avatar!!}@else{!! asset('images/default_avatar.png') !!}@endif" width="38" height="38" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small shadow text-small dropdown-menu" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin-top: 10px; transform: translate3d(0px, 34px, 0px); z-index: 1021;">
                    <li><a class="dropdown-item" href="{{ route('account.profile') }}">Профиль</a></li>
                    <li>
                        <a class="dropdown-item d-flex justify-content-between align-items-center @if(count($favorites) === 0) disabled @endif" href="{{ route('account.places', 'favorite') }}">
                            Мои избранные места
                            <span id="favorites-btn" class="badge bg-secondary ms-1">{{ count($favorites) ?  : '' }}</span>
                        </a>
                    </li>
                    <li >
                        <a class="dropdown-item d-flex justify-content-between align-items-center @if(count($likes) === 0) disabled @endif" href="{{ route('account.places', 'liked') }}">
                            Мои любимые места
                            <span id="likes-btn" class="badge bg-secondary ms-1">{{ count($likes) ?  : '' }}</span>

                        </a>
                    </li>
                    <li >
                        <a class="dropdown-item d-flex justify-content-between align-items-center @if(count($created) === 0) disabled @endif" href="{{ route('account.places', 'created') }}">
                            Мои созданные места
                            <span id="likes-btn" class="badge bg-secondary ms-1">{{ count($created) ?  : '' }}</span>

                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('account.place.create') }}">Создать новое место</a>
                    </li>

                    <li><a class="dropdown-item disabled" href="#">Настройки</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('logout') }}">
                            <span>Выйти</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        @endauth
    </ul>
</nav>
@push('js')
    <script src="{{asset('js/user-info-update.js')}}"></script>
@endpush
