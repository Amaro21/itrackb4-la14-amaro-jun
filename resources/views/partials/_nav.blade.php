<nav class="navbar navbar-expand-lg bg-primary shadow sticky-top mb-4" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="{{ route('home') }}">Movie Flex</a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav nav-pills me-auto gap-2 mt-3 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->routeIs('home') ? 'active bg-light text-primary fw-semibold' : '' }}"
                       href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 {{ request()->routeIs('movies.*') ? 'active bg-light text-primary fw-semibold' : '' }}"
                       href="{{ route('movies.index') }}">Movies</a>
                </li>
            </ul>

            <ul class="navbar-nav nav-pills align-items-lg-center gap-2 mt-2 mt-lg-0">
                @guest
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('login') ? 'active bg-light text-primary fw-semibold' : '' }}"
                           href="{{ route('login') }}">Log in</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light btn-sm text-primary fw-semibold px-3"
                           href="{{ route('register') }}">Register</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item">
                        <span class="navbar-text text-white">{{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button class="btn btn-outline-light btn-sm px-3">Log out</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
