@extends('master')

@section('content')
    <main id="main" class="main">
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Ajouter une assurance</h5>
                                    </div>

                                    <form class="row g-3 needs-validation" action="{{ url('savepiece') }}" method="post">
                                        @csrf
                                        <div class="col-12">
                                            <input type="text" class="form-control" name="nompiece" id="nompiece"
                                                placeholder="Nom de la pièce">
                                            @if ($errors->has('nompiece'))
                                                <span class="text-danger">{{ $errors->first('nompiece') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <label for="">Date fin de la pièce</label>
                                            <input type="date" class="form-control" name="datefin" id="datefin"
                                                >
                                            @if ($errors->has('datefin'))
                                                <span class="text-danger">{{ $errors->first('datefin') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <select class="form-select" name="voiture_id">
                                                @if ($voiture->count() > 0)
                                                    @foreach ($voiture as $us)
                                                        <option value="{{ $us->id }}">{{ $us->marque }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">Pas de voiture trouvée</option>
                                                @endif
                                            </select>
                                            @if ($errors->has('voiture_id'))
                                                <span class="text-danger">{{ $errors->first('voiture_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Ajouter</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>
@endsection
