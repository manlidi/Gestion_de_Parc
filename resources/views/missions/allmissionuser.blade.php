@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="text-align: center">
                                <h1 class="card-title"><u>Les détails de la mission</u></h1>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><u>Mission:</u> <strong>{{ $mission->objetmission }}</strong></h5>
                                    <div class="table-responsive">
                                        <table class="table table-responsive table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Les voitures affectées</th>
                                                    <th scope="col">Les chauffeurs affectées</th>
                                                    <th scope="col">Kilométrage de début</th>
                                                    <th scope="col">Kilométrage de fin</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        @forelse ($voiture as $us)
                                                            <strong>- {{ $us->marque }}</strong> immatriculée <span style="color: red">{{$us->immatriculation}}</span><br>
                                                        @empty
                                                            Pas de voiture affecter à cette mission
                                                        @endforelse
                                                    </td>
                                                    <td>
                                                        @forelse ($chauffeur as $us)
                                                           <strong>- {{ $us->nom_cva }} {{ $us->prenom_cva }}</strong> affecter a la voiture <span style="color: red">{{ $us->marque }}</span><br>
                                                        @empty
                                                            Pas de chauffeur affecter à cette mission
                                                        @endforelse
                                                        <br>
                                                        @if ($mission->etat == 'Non fait')
                                                            <strong><u><a class="btn btn-secondary"
                                                                href="{{ url('addchauf/' . $mission->id) }}">Affecter un
                                                                chauffeur</a></u></strong>
                                                        @endif
                                                    </td>
                                                    <td>---</td>
                                                    <td>---</td>
                                                </tr>
                                            </tbody>
                                        </table>
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
