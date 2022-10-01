@extends('master')
@section('content')
<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <a class="btn btn-primary" href="{{ url('adddemande') }}">Ajouter une demande</a><br><br>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                <span class="font-medium">{{ session('msg') }}</span>
                            </div>
                        @endif
                        <br><br>
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">La liste de vos demande</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Objet de la demande</th>
                                            <th scope="col">Voiture demandée</th>
                                            <th scope="col">Chauffeur demandé</th>
                                            <th scope="col">Date début</th>
                                            <th scope="col">Date de fin</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($demande as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->objetdemande }}</td>
                                                <td>{{ $item->voiture->marque }} ({{ $item->voiture->immatriculation }})</td>
                                                <td>
                                                    {{ $item->chauffeur->nom_cva ?? '---' }}
                                                </td>
                                                <td>{{ $item->datedeb }}</td>
                                                <td>{{ $item->datefin }}</td>
                                                <td><span class="badge bg-danger">{{ $item->status }}</span></td>
                                            </tr>
                                        @empty
                                            <tr>Vous n'avez fait aucune demande !</tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

</main>

@endsection
