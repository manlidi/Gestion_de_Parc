@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{ url('reparations') }}" class="btn btn-primary">Ajouter une réparation</a><br><br>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Liste des réparations</h5>
                            <table class="table table-responsive datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom du garage</th>
                                        <th scope="col">Le véhicule</th>
                                        <th scope="col">La panne</th>
                                        <th scope="col">La pièce changer</th>
                                        <th scope="col">La date de réparation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($repare as $rep)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $rep->nomgarage }}</td>
                                            <td>{{ $rep->marque }}</td>
                                            <td>{{ $rep->panne }}</td>
                                            <td>{{ $rep->nompiece }}</td>
                                            <td>{{ $rep->datereparation }}</td>
                                        </tr>
                                    @empty
                                        <tr colspan="7">Pas de réparation pour le moment</tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
