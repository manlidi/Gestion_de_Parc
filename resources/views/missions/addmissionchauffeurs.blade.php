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
                                        <h5 class="card-title text-center pb-0 fs-4">Affecter un chauffeur à une voiture
                                        </h5>
                                    </div>

                                    <form class="row g-3 needs-validation" action="{{ url('savechauffeurs/' . $mission->mission_id) }}"
                                        method="post">
                                        @csrf
                                        <div class="col-12">
                                            <select class="form-select" name="voiture_id">
                                                @if ($voiture->count() > 0)
                                                    @foreach ($voiture as $us)
                                                        <option value="{{ $us->id }}">{{ $us->marque }} immatriculée
                                                            {{ $us->immatriculation }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">Pas de voiture pour cette mission</option>
                                                @endif
                                            </select>
                                            @if ($errors->has('voiture_id'))
                                                <span class="text-danger">{{ $errors->first('voiture_id') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-12">
                                            <select class="form-select" name="chauffeur_id">
                                                @if ($chauffeur->count() > 0)
                                                    @foreach ($chauffeur as $us)
                                                        <option value="{{ $us->id }}">{{ $us->nom_cva }}
                                                            {{ $us->prenom_cva }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">Pas de chauffeur</option>
                                                @endif
                                            </select>
                                            @if ($errors->has('chauffeur_id'))
                                                <span class="text-danger">{{ $errors->first('chauffeur_id') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Affecter</button>
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
