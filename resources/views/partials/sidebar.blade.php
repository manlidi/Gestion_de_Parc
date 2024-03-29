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
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-plus-circle"></i><span>Ajout</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('structures') }}">
                            <i class="bi bi-circle"></i>
                            <span>Structures</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('assurance') }}">
                            <i class="bi bi-circle"></i>
                            <span>Assurances</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('voitures') }}">
                            <i class="bi bi-circle"></i>
                            <span>Voitures</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('chauffeurs') }}">
                            <i class="bi bi-circle"></i>
                            <span>Chauffeurs</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('garages') }}">
                            <i class="bi bi-circle"></i><span>Garages</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('pieces') }}">
                            <i class="bi bi-circle"></i><span>Pieces</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-na" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-wrench"></i><span>Réparation</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-na" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('listereparation') }}">
                            <i class="bi bi-circle"></i><span>Liste des reparations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('demanderReparation') }}">
                            <i class="bi bi-circle"></i>
                            <span>Demande De Réparation</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#demandes" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-people"></i><span>Demandes</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="demandes" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('demanderVoiture') }}">
                            <i class="bi bi-circle"></i>
                            <span>Demander Une Voiture</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="{{ url('mesDemandes') }}">
                            <i class="bi bi-circle"></i>
                            <span>Listes De Mes Demandes</span>
                        </a>
                    </li>
                    @if (Auth::user() && Auth::user()->role == 'Administrateur')
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('admin_demandes') }}">
                                <i class="bi bi-circle"></i>
                                <span>Demandes en Attente</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{ url('adminDemandeApprouve') }}">
                                <i class="bi bi-circle"></i>
                                <span>Demandes Approuvées</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('register') }}">
                    <i class="bi bi-person"></i>
                    <span>Ajouter Un Membre</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('notif') }}">
                    <i class="bi bi-bell"></i>
                    <span>Vos notifications</span>
                </a>
            </li>
        @endif
        @if (Auth::user() && (Auth::user()->role == 'Utilisateur' || Auth::user()->role == 'Chauffeur'))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('mesDemandes') }}">
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
        @endif
        @if (!Auth::user())
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('login') }}">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Connexion</span>
                </a>
            </li>
        @endif
    </ul>
</aside>
