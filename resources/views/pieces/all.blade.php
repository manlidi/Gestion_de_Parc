@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{url('createpiece')}}" class="btn btn-primary">Ajouter une pièce</a><br><br>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Liste des pièces</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nom de la pièce</th>
                                            <th scope="col">Date de fin d'utilisation</th>
                                            <th scope="col">Véhicule auquel elle appartient</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($piece as $item)
                                            <tr>
                                                <td>{{ $item->nompiece }}</td>
                                                <td>{{ $item->datefin }}</td>
                                                <td>{{ $item->voiture->marque }}</td>
                                            </tr>
                                        @empty
                                            <tr colspan="7">Pas de piece trouver</tr>
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
