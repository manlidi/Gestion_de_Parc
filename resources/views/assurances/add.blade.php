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

                                    <form class="row g-3 needs-validation" action="{{ url('postA') }}" method="post">
                                        @csrf
                                        <div class="col-12">
                                            <input type="text" class="form-control" name="societeAssurance" id="societeAssurance"
                                                placeholder="Nom de la société">
                                            @if ($errors->has('societeAssurance'))
                                                <span class="text-danger">{{ $errors->first('societeAssurance') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <label for="">Date début de l'assurance</label>
                                            <input type="date" class="form-control" name="datedebA" id="datedebA">
                                            @if ($errors->has('datedebA'))
                                                <span class="text-danger">{{ $errors->first('datedebA') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <label for="">Date fin de l'assurance</label>
                                            <input type="date" class="form-control" name="datefinA" id="datefinA"
                                                >
                                            @if ($errors->has('datefinA'))
                                                <span class="text-danger">{{ $errors->first('datefinA') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <select class="form-select" name="voiture_id">
                                                @if ($voiture->count() > 0)
                                                    @foreach ($voiture as $us)
                                                        <option value="{{ $us->id }}">{{ $us->marque }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">Pas de voiture</option>
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
