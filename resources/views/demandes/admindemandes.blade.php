@extends('master')
@section('content')
<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">La liste des demandes</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Objet de la demande</th>
                                            <th scope="col">Voiture demandée</th>
                                            <th scope="col">Chauffeur demandé</th>
                                            <th scope="col">L'utilisateur qui a fait le demande</th>
                                            <th scope="col">Sa structure</th>
                                            <th scope="col">Date début</th>
                                            <th scope="col">Date de fin</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Approuvé</th>
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
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ $item->user->structure->nomStructure }}</td>
                                                <td>{{ $item->datedeb }}</td>
                                                <td>{{ $item->datefin }}</td>
                                                <td><span class="badge bg-danger">{{ $item->status }}</span></td>
                                                <td><a class="btn btn-outline-danger btn-sm" href="">ok</a></td>
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
