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
                                <table class="table table-responsive datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">N°</th>
                                            <th scope="col">Marque</th>
                                            <th scope="col">Immatriculation</th>
                                            <th scope="col">Structure</th>
                                            <th scope="col">Position</th>
                                            <th scope="col">Disponibilité</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($voiture as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a href="{{ url('detailsvoiture/' . $item->id) }}"><strong>{{ $item->marque }}</strong></a><br>
                                                    <a style="color: red" href="{{ url('addassurance/' . $item->id) }}">Ajouter une assurance</a>
                                                </td>
                                                <td>{{ $item->immatriculation }}</td>
                                                <td>{{ $item->structure->nomStructure ?? '---' }}</td>
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
