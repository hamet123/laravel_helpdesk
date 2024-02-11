<nav class="navbar navbar-expand-lg d-flex align-items-center navbar-dark" style="background: rgba(0, 0, 0, 0.7);">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><img height="30px" width="30px" src="{{ asset('images/logos.png') }}"
                alt=""> iDesk</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    @if (Session::has('uid') && Session::get('role') == 'user')
                        <a class="nav-link active" aria-current="page" href="/my-profile">Hi,
                            {{ Session::get('name') }}</a>
                    @endif
                    @if (Session::has('uid') && Session::get('role') == 'admin')
                        <a class="nav-link active" aria-current="page" href="/admin-profile">Hi,
                            {{ Session::get('name') }}</a>
                    @endif
                    @if (Session::has('uid') && Session::get('role') == 'agent')
                        <a class="nav-link active" aria-current="page" href="/agent-profile">Hi,
                            {{ Session::get('name') }}</a>
                    @endif
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Activites
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if (Session::has('uid') && Session::get('role') == 'user')
                            <li><a class="dropdown-item" href="{{ route('userDashboard') }}">Dashboard</a></li>
                        @endif
                        @if (Session::has('uid') && Session::get('role') == 'admin')
                            <li><a class="dropdown-item" href="{{ route('adminDashboard') }}">Dashboard</a></li>
                        @endif
                        @if (Session::has('uid') && Session::get('role') == 'agent')
                            <li><a class="dropdown-item" href="{{ route('agentDashboard') }}">Dashboard</a></li>
                        @endif
                        <li><a class="dropdown-item" href="#">Chat Forums</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Knowledge Base</a></li>
                    </ul>
                </li>
                @if (!Session::has('uid'))
                    <li class="nav-item">
                        <a class="nav-link active" href="/login" tabindex="-1"><i
                                class="fa-solid fa-right-to-bracket"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/register" tabindex="-1"><i class="fa-solid fa-user-pen"></i>
                            Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link active" href="/logout" tabindex="-1"><i
                                class="fa-solid fa-right-to-bracket"></i> Logout</a>
                    </li>
                @endif
            </ul>
            <form class="d-flex my-2" action="/search-results" method="get">
                <input class="form-control me-2" type="text"  aria-label="Search" name="query" placeholder="Looking for Something?">
                <button class="btn btn-outline-light " type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
