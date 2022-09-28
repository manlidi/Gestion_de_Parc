@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{ url('addgarage') }}" class="btn btn-primary">Ajouter un garage</a><br><br>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Liste des garages</h5>
                            <table class="table table-responsive datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom du garage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($garage as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nomgarage }}</td>
                                        </tr>
                                    @empty
                                        <tr colspan="7">Pas de garage trouver</tr>
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
