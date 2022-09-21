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
                                        <h5 class="card-title text-center pb-0 fs-4">Ajout d'une réparation</h5>
                                    </div>

                                    <form class="row g-3 needs-validation" action="{{ url('createreparation') }}"
                                        method="post">
                                        @csrf
                                        <div class="col-12">
                                            <label for="">Garage de la répartion</label>
                                            <select class="form-select" name="garage_id" required>
                                                @if ($garage->count() > 0)
                                                    @foreach ($garage as $us)
                                                        <option value="{{ $us->id }}">{{ $us->nomgarage }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">Pas de garage trouvée</option>
                                                @endif
                                            </select>
                                            @if ($errors->has('garage_id'))
                                                <span class="text-danger">{{ $errors->first('garage_id') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-12">
                                            <label for="">Voiture réparée</label>
                                            <select class="form-select" name="voiture_id" id="voiture_id" onchange="getPiece(this.value,'piece')" required>
                                                @if ($voiture->count() > 0)
                                                    <option value="">Choisir la voiture</option>
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
                                            <label for="">Pièce changée</label>
                                            <select class="form-select" name="piece_id" id="piece" required>
                                                @if ($piece->count() > 0)
                                                    @foreach ($piece as $us)
                                                        <option value="{{ $us->id }}">{{ $us->nompiece }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">Pas de piece de cette voiture</option>
                                                @endif
                                            </select>
                                            @if ($errors->has('piece_id'))
                                                <span class="text-danger">{{ $errors->first('piece_id') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-12">
                                            <label for="">Description de la panne</label>
                                            <input type="text" name="panne" id="panne"
                                                class="form-control" required>
                                            @if ($errors->has('panne'))
                                                <span class="text-danger">{{ $errors->first('panne') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-12">
                                            <label for="">Date de réparation</label>
                                            <input type="date" name="datereparation" id="datereparation"
                                                class="form-control" required>
                                            @if ($errors->has('datereparation'))
                                                <span class="text-danger">{{ $errors->first('datereparation') }}</span>
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


