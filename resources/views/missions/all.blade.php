@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{ url('addmissions') }}" class="btn btn-primary">Ajouter une mission</a><br><br>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            <span class="font-medium">{{ session('msg') }}</span>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Liste des missions</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">Objet de la mission</th>
                                            <th scope="col">Date début de la mission</th>
                                            <th scope="col">Date fin de la mission</th>
                                            <th scope="col">Etat</th>
                                            <th scope="col">Voir les détails</th>
                                            <th scope="col"><b style="color: red">Marqué comme fait / Supprimer</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($mission as $item)
                                            <tr>
                                                <td>{{ $item->objetmission }}</td>
                                                <td>{{ $item->datedeb }}</td>
                                                <td>{{ $item->datefin }}</td>
                                                <td><b style="color: red">{{ $item->etat }}</b></td>
                                                <td><a href="{{ url('det/' . $item->id) }}">Détails</a></td>
                                                <td>
                                                    @if ($item->etat == 'Non fait')
                                                        <form action="{{ url('up/' . $item->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button class="btn btn-primary" type="submit">OK</button>
                                                        </form>
                                                    @else
                                                        <a class="btn btn-danger"
                                                            onclick="return confirm('Supprimer vraiment?')"
                                                            href="{{ url('del/' . $item->id) }}">Supprimer</a>
                                                    @endif

                                                </td>
                                            </tr>
                                        @empty
                                            <tr colspan="7">Pas de mission pour le moment</tr>
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
