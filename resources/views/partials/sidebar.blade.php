<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ url('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @if (Auth::user() && Auth::user()->role == 'Administrateur')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('structures') }}">
                    <i class="bi bi-house"></i>
                    <span>Structures</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('assurance') }}">
                    <i class="bi bi-book"></i>
                    <span>Assurances</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('voitures') }}">
                    <i class="bi bi-truck"></i>
                    <span>Voitures</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('missions') }}">
                    <i class="bi bi-filter-left"></i>
                    <span>Missions</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('chauffeurs') }}">
                    <i class="bi bi-person"></i>
                    <span>Chauffeurs</span>
                </a>
            </li>
        @endif
        @if (!Auth::user())
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('register') }}">
                    <i class="bi bi-card-list"></i>
                    <span>Register</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('login') }}">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Login</span>
                </a>
            </li>
        @endif
    </ul>
</aside>
