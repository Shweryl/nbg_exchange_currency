<nav class="navbar navbar-expand-lg bg-secondary py-2 fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-warning" href="{{ route('welcome') }}">VE_EX</a>
        <button class="navbar-toggler bg-primary" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-primary"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white my-2 me-lg-3 {{request()->fullUrl() == route('history.rate') ? 'active' : ''}}" href="{{ route('history.rate') }}">

                        History Rates
                    </a>
                </li>
                @guest
                    <li class="nav-item  me-md-2">
                        <a class="nav-link text-white" href="{{ route('login') }}">
                            <span class="btn btn-outline-primary text-white px-3 py-2">
                                Login
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white " href="{{ route('register') }}">
                            <span class="btn btn-primary text-white px-3 py-2">
                                Register
                            </span>
                        </a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item">
                        <a class="nav-link text-white my-2 me-lg-3 {{request()->fullUrl() == route('bookmark.list') ? 'active' : ''}}" href="{{ route('bookmark.list') }}">

                            Bookmarks
                            <i class="bi bi-bookmark-star-fill"></i>
                        </a>
                    </li>
                    <li class="nav-item me-md-2">
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button class="btn btn-primary text-white my-2">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
