@extends('master')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Détails</h1>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">

                                <!-- Sales Card -->
                                <div class="col-xxl-4 col-md-6">
                                    <div class="card info-card sales-card">
                                        <div class="card-body">
                                            <h5 class="card-title">Age du Véhicule</h5>

                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-car-front" viewBox="0 0 16 16">
                                                        <path d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2H6ZM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17 1.247 0 2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276Z"/>
                                                        <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.807.807 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155 1.806 0 4.037-.084 5.592-.155A1.479 1.479 0 0 0 15 9.611v-.413c0-.099-.01-.197-.03-.294l-.335-1.68a.807.807 0 0 0-.43-.563 1.807 1.807 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3H4.82Z"/>
                                                      </svg>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>{{ $age }} ans</h6>
                                                    <span class="text-success small pt-1 fw-bold">{{ $mois }} mois</span> <span
                                                        class="text-muted small pt-2 ps-1">{{ $jour }} j</span>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- End Sales Card -->

                                <!-- Revenue Card -->
                                <div class="col-xxl-4 col-md-6">
                                    <div class="card info-card revenue-card">
                                        <div class="card-body">
                                            <h5 class="card-title">A été au Garage</h5>

                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-wrench-adjustable" viewBox="0 0 16 16">
                                                        <path d="M16 4.5a4.492 4.492 0 0 1-1.703 3.526L13 5l2.959-1.11c.027.2.041.403.041.61Z"/>
                                                        <path d="M11.5 9c.653 0 1.273-.139 1.833-.39L12 5.5 11 3l3.826-1.53A4.5 4.5 0 0 0 7.29 6.092l-6.116 5.096a2.583 2.583 0 1 0 3.638 3.638L9.908 8.71A4.49 4.49 0 0 0 11.5 9Zm-1.292-4.361-.596.893.809-.27a.25.25 0 0 1 .287.377l-.596.893.809-.27.158.475-1.5.5a.25.25 0 0 1-.287-.376l.596-.893-.809.27a.25.25 0 0 1-.287-.377l.596-.893-.809.27-.158-.475 1.5-.5a.25.25 0 0 1 .287.376ZM3 14a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                                                      </svg>
                                                </div>
                                                <div class="ps-3">
                                                    <h6>{{ $nbr }} fois</h6>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- End Revenue Card -->
                                <div class="col-12">
                                    <div class="card recent-sales overflow-auto">
                                        <div class="card-body">
                                            <table class="table table-borderless datatable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Capacité</th>
                                                        <th scope="col" title="Date Début service">Date</th>
                                                        <th scope="col">Numéro chassis</th>
                                                        <th scope="col" title="Kilomètre parcouru">Kilomètre</th>
                                                        <th scope="col" title="Consommation en litre">Consommation</th>
                                                        <th scope="col" title="Coût d'acquisition">Coût</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($detail as $item)
                                                        <tr>
                                                            <td>{{ $item->capacite }} places</td>
                                                            <td>{{ $item->datdebservice }}</td>
                                                            <td>{{ $item->numchassis }}</td>
                                                            <td>{{ $item->kilmax }}</td>
                                                            <td>{{ $item->connsommation }}</td>
                                                            <td>{{ $item->coutaquisition }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr colspan="7">Pas de détails</tr>
                                                    @endforelse
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right side columns -->
                        <div class="col-lg-4">

                            <!-- Recent Activity -->
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Pièces <span>| Réparée/Changée</span></h5>

                                    <div class="activity">
                                        @forelse ($pieces_reparees as $piece_reparer)
                                            <div class="activity-item d-flex">
                                                <div class="activite-label">{{ $piece_reparer['number'] }} fois</div>
                                                <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                                <div class="activity-content">
                                                    {{ $piece_reparer['nom'] }}
                                                </div>
                                            </div>
                                        @empty
                                            <small>Aucune pièce n'a encore été changée ou réparée !</small>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
