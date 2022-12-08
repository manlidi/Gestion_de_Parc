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
                    <i class="bi bi-file-plus"></i><span>Ajout</span><i class="bi bi-chevron-down ms-auto"></i>
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
                        <a href="{{ url('missions') }}">
                            <i class="bi bi-circle"></i>
                            <span>Missions</span>
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
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-n" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-info"></i><span>Vos demandes</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-n" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('demandeApprouve') }}">
                            <i class="bi bi-circle"></i>
                            <span>Vos demandes Approuvées</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('demanderVoiture') }}">
                            <i class="bi bi-circle"></i>
                            <span>Demande de Voiture</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('demanderChauffeur') }}">
                            <i class="bi bi-circle"></i>
                            <span>Demande de Chauffeur</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('demanderReparation') }}">
                            <i class="bi bi-circle"></i>
                            <span>Demande De Réparation</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('admin_demandes') }}">
                    <i class="bi bi-eye"></i>
                    <span>Demandes non approuvées des utilisateurs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('adminDemandeApprouve') }}">
                    <i class="bi bi-patch-check"></i>
                    <span>Demandes Approuvées des utilisateurs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('register') }}">
                    <i class="bi bi-card-list"></i>
                    <span>Enregistrement d'utilisateurs</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('notif') }}">
                    <i class="bi bi-bell"></i>
                    <span>Vos notifications</span>  
                </a>
            </li>
        @endif
        @if (Auth::user() && (Auth::user()->role == 'Utilisateur' || Auth::user()->role == 'Chauffeur'))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('demandeApprouve') }}">
                    <i class="bi bi-shield-check"></i>
                    <span>Vos demandes Approuvées</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('demanderVoiture') }}">
                    <i class="bi bi-truck"></i>
                    <span>Demande de Voiture</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('demanderChauffeur') }}">
                    <i class="bi bi-person"></i>
                    <span>Demande de Chauffeur</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('demanderReparation') }}">
                    <i class="bi bi-wrench"></i>
                    <span>Demande De Réparation</span>
                </a>
            </li>
        @endif
        @if ((!Auth::user()) && (! request()->routeIs('validation')))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('login') }}">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Connexion</span>
                </a>
            </li>
        @endif
    </ul>
</aside>
