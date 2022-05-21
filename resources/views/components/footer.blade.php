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
        <li>
            <button class='nav_link btn'>Login</button>
        </li>
        <li>
            <button class='nav_link btn'>Register</button>
        </li>
    </ul>
</nav>
