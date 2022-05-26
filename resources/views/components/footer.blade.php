<div class="container">
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li >
                <a href="{{ route('app::home') }}" class='nav_link'>Домой</a>
            </li>
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
        </ul>
        <p class="text-center text-muted">© {{ date('Y') }}  {{ config('app.name', 'Laravel') }} </p>
    </footer>
</div>