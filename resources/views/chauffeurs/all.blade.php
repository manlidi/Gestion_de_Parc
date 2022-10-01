@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            <span class="font-medium">{{ session('msg') }}</span>
                        </div>
                    @endif
                    <br><br>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Liste des chauffeurs</h5>
                            <div class="table-responsive">
                                <table class="table table-responsive datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nom du chauffeur</th>
                                            <th scope="col">Email du chauffeur</th>
                                            <th scope="col">Structure du chauffeur</th>
                                            <th scope="col">Disponiblité du chauffeur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($chauffeurs as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nom_cva }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->structure->nomStructure }}</td>
                                                <td>@if ($item->disp == "Disponible")
                                                    <b style="color: blue">{{ $item->disp }}</b>
                                                @else
                                                <b style="color: red">{{ $item->disp }}</b>
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
