<nav class="navbar container">
    <img src={{asset('images/logo.png')}} alt="Logo" class='logo_nav' />
    <ul class='navbar__inner'>
        <li >
            <a href="{{ route('home') }}" class='nav_link'>Домой</a>
        </li>
        <li >
            <a href="#" class='nav_link'>Путешествия</a>
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
            <li>
                <a href="{{route('logout')}}" class='nav_link btn'>Выйти</a>
            </li>
        @endauth
    </ul>
</nav>
