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
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="font-medium">{{ session('msg') }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <hr>
                            <div class="table-responsive">
                                <form action="{{ route('actionVoiture') }}" method="post">
                                    @csrf
                                    @method('post')
                                    <div class="row mb-3">
                                            <div class="col-sm-4 mr-0 pr-1">
                                                <select class="form-select" name="actionVoiture" required
                                                    aria-label="Default select example">
                                                    <option value="">Action Groupées</option>
                                                    <option value="visiteTechnique">Visite Technique</option>
                                                    <option value="visiteTechniqueAll">Toutes en Visite Technique</option>
                                                    <option value="visiteTechniqueAllTermine">Terminer toutes les visites</option>
                                                    <option value="delete">Delete</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-1 m-0 p-0"><button type="submit" class="btn btn-outline-primary">Appliquer</button></div>
                                    </div>
                                    <table class="table table-hover table-responsive datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
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
                                                    <td>
                                                        @if( $item->mouvement != 'En visite technique' )
                                                            <input name="voitures[]" value="{{ $item->id }}" type="checkbox">
                                                        @else  
                                                            <input checked type="checkbox">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a
                                                            href="{{ url('detailsvoiture/' . $item->id) }}"><strong>{{ $item->marque }}</strong></a><br>
                                                        <a style="color: red"
                                                            href="{{ url('addassurance/' . $item->id) }}">Ajouter une
                                                            assurance</a>
                                                    </td>
                                                    <td>{{ $item->immatriculation }}</td>
                                                    <td>{{ $item->structure->nomStructure ?? '---' }}</td>
                                                    <td>
                                                        @if ($item->mouvement == 'En visite technique')
                                                            <b class="text-danger">{{ $item->mouvement }}</b>   
                                                        @else
                                                            <b class="text-success">{{ $item->mouvement }}</b> 
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->mouvement == 'En visite technique')
                                                            <a href="{{ route('terminerViste',['id'=>$item->id]) }}"><button type="button" class="btn btn-outline-primary btn-sm">Visite terminée</button></a>   
                                                        @else
                                                            @if ($item->dispo == 'Disponible')
                                                                <b class="text-primary">{{ $item->dispo }}</b>
                                                            @else
                                                                <b class="text-danger">{{ $item->dispo }}</b>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr colspan="7">Pas de voiture pour le moment</tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
