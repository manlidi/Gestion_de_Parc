@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{ url('addstructures') }}" class="btn btn-primary">Ajouter une structure</a><br><br>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Liste des structures</h5>
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="font-medium">{{ session('msg') }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <hr>
                            <table class="table table-responsive datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom de la structure</th>
                                        <th scope="col">Emplacement de la structure</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($structure as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nomStructure }}</td>
                                            <td>{{ $item->localisation }}</td>
                                            <td>
                                                <a href="{{ url('editstructures/' . $item->id) }}"
                                                    class="btn btn-warning">Modifier</a>
                                                <a href="{{ url('delstructures/' . $item->id) }}"
                                                    class="btn btn-danger">Supprimer</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr colspan="7">Pas de Structure trouver</tr>
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
