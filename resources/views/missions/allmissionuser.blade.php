@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    @if ($mission->etat == 'Non fait')
                        <div class="container">
                            <div class="row g-3">
                                <div class="col-md-4"><a href="{{ url('createmembre/' . $mission->id) }}"
                                        class="btn btn-primary">Affecter un membre à la mission</a></div>
                                <div class="col-md-4"><a href="{{ url('addvoit/' . $mission->id) }}"
                                        class="btn btn-primary">Affecter une voiture à la mission</a></div>
                                <div class="col-md-4"><a href="{{ url('addchauf/' . $mission->id) }}"
                                        class="btn btn-primary">Affecter un chauffeur à la mission</a><br><br><br></div>
                            </div>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Les détails de la mission</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">La mission</th>
                                            <th scope="col">Les participants</th>
                                            <th scope="col">Les voitures affectées</th>
                                            <th scope="col">Les chauffeurs affectées</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $mission->objetmission }}</td>
                                            <td>
                                                @forelse ($user as $us)
                                                    {{ $us->name }} <b style="color: red">|</b>
                                                @empty
                                                    Pas de membre affecter à cette mission
                                                @endforelse
                                            </td>
                                            <td>
                                                @forelse ($voiture as $us)
                                                    {{ $us->marque }} <b style="color: red">|</b>
                                                @empty
                                                    Pas de voiture affecter à cette mission
                                                @endforelse
                                            </td>
                                            <td>
                                                @forelse ($chauffeur as $us)
                                                    {{ $us->nom_cva }} {{ $us->prenom_cva }} <b style="color: red">|</b>
                                                @empty
                                                    Pas de chauffeur affecter à cette mission
                                                @endforelse
                                            </td>
                                        </tr>
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
