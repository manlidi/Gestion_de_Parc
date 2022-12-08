<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


        @if (Auth::user())
            <li class="nav-item">
                <a class="nav-link " href="{{ url('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        @endif
        @if (Auth::user() && Auth::user()->role == 'Administrateur')
            <li class="nav-item">

                <ul>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('structures') }}">
                            <i class="bi bi-circle"></i>
                            <span>Structures</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('assurance') }}">
                            <i class="bi bi-circle"></i>
                            <span>Assurances</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('voitures') }}">
                            <i class="bi bi-circle"></i>
                            <span>Voitures</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('missions') }}">
                            <i class="bi bi-circle"></i>
                            <span>Missions</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('chauffeurs') }}">
                            <i class="bi bi-circle"></i>
                            <span>Chauffeurs</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-wrench"></i><span>Réparation</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('garages') }}">
                            <i class="bi bi-circle"></i><span>Ajouter un garage</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('pieces') }}">
                            <i class="bi bi-circle"></i><span>Ajouter une piece</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('listereparation') }}">
                            <i class="bi bi-circle"></i><span>Liste des reparations</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#demandes" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-wrench"></i><span>Demandes</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="demandes" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    @if (Auth::user() && Auth::user()->role == 'Administrateur')
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('admin_demandes') }}">
                            <i class="bi bi-eye"></i>
                            <span>Demandes en Attente</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('adminDemandeApprouve') }}">
                            <i class="bi bi-eye"></i>
                            <span>Demandes Approuvées</span>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('demandeApprouve') }}">
                            <i class="bi bi-shield-check"></i>
                            <span>Listes De Mes Demandes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('demanderVoiture') }}">
                            <i class="bi bi-truck"></i>
                            <span>Demander Une Voiture</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('demanderReparation') }}">
                            <i class="bi bi-wrench"></i>
                            <span>Demande De Réparation</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('register') }}">
                    <i class="bi bi-card-list"></i>
                    <span>Ajouter Un Membre</span>
                </a>
            </li>
        @if (!Auth::user())
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('login') }}">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Login</span>
                </a>
            </li>
        @endif
    </ul>
</aside>
