@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="pb-4"><a href="{{ url('addchauffeur') }}" class="btn btn-primary">Ajouter un chauffeur</a></div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Liste des chauffeurs</h5>
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="font-medium">{{ session('msg') }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-responsive datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nom & Prénoms</th>
                                            <th scope="col">Téléphone</th>
                                            <th scope="col">Adresse</th>
                                            <th scope="col">Structure</th>
                                            <th scope="col">Disponiblité</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($chauffeurs as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->chauffeur->tel }}</td>
                                                <td>{{ $item->chauffeur->adresse }}</td>
                                                <td>{{ $item->structure->nomStructure }}</td>
                                                <td>@if ($item->chauffeur->disp == "Disponible")
                                                    <b style="color: blue">{{ $item->chauffeur->disp }}</b>
                                                @else
                                                <b style="color: red">{{ $item->chauffeur->disp }}</b>
                                                @endif</td>
                                            </tr>
                                        @empty
                                            <tr colspan="7">Pas de Cva trouvé</tr>
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
