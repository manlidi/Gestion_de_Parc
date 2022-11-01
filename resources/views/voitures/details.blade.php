@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="text-align: center">
                                <h1 class="card-title"><u>Les détails de la voiture</u></h1>
                            </div>
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title">Les autres informations de la voiture</h5>

                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">Capacité</th>
                                                <th scope="col">Date Début service</th>
                                                <th scope="col">Durée de vie</th>
                                                <th scope="col">Numéro chassis</th>
                                                <th scope="col">Kilomètre parcouru</th>
                                                <th scope="col">Consommation en litre</th>
                                                <th scope="col">Cout d'acquisition</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($detail as $item)
                                                <tr>
                                                    <td>{{ $item->capacite }} places</td>
                                                    <td>{{ $item->datdebservice }}</td>
                                                    <td>{{ $item->dureeVie }} ans</td>
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

                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h3 class="card-title">Nombres de fois que ce véhicule a été au garage</span></h3>
                                <div class="d-flex align-items-center">
                                    <div class="ps-3">
                                        @foreach ($nbr as $n)
                                            <h6>{{ $n->nombre }}</h6>
                                        @endforeach
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
