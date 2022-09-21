@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{ url('addvoitures') }}" class="btn btn-primary">Ajouter une voiture</a><br><br>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Liste des voitures</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">Marque</th>
                                            <th scope="col">Immatriculation</th>
                                            <th scope="col">Date début de service</th>
                                            <th scope="col">Kilomètre maximal</th>
                                            <th scope="col">Assurance</th>
                                            <th scope="col">Durée de vie</th>
                                            <th scope="col">Etat</th>
                                            <th scope="col">Position</th>
                                            <th scope="col">Disponibilité</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($voiture as $item)
                                            <tr>
                                                <td><a href="{{ url('detailsvoiture/' . $item->id) }}">{{ $item->marque }}</a></td>
                                                <td>{{ $item->immatriculation }}</td>
                                                <td>{{ $item->datdebservice }}</td>
                                                <td>{{ $item->kilmax }} km</td>
                                                <td>{{ $item->assurance->societeAssurance }}</td>
                                                <td>{{ $item->dureeVie }} ans</td>
                                                <td>{{ $item->etat }}</td>
                                                <td><b style="color: green">{{ $item->mouvement }}</b></td>
                                                <td>
                                                    @if ($item->dispo == 'Disponible')
                                                        <b style="color: blue">{{ $item->dispo }}</b>
                                                    @else
                                                        <b style="color: red">{{ $item->dispo }}</b>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr colspan="7">Pas de voiture pour le moment</tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
