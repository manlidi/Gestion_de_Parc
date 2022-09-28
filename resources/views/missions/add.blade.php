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
                                        <h5 class="card-title text-center pb-0 fs-4">Ajouter une mission</h5>
                                    </div>

                                    <form class="row g-3 needs-validation" action="{{ url('savemission') }}" method="post">
                                        @csrf
                                        <div class="col-12">
                                            <label for="">Objet de la mission</label>
                                            <input type="text" class="form-control" name="objetmission" id="objetmission">
                                            @if ($errors->has('objetmission'))
                                                <span class="text-danger">{{ $errors->first('objetmission') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <label for="">Date début de la mission</label>
                                            <input type="date" class="form-control" name="datedeb" id="datedeb">
                                            @if ($errors->has('datedeb'))
                                                <span class="text-danger">{{ $errors->first('datedeb') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <label for="">Date fin de la mission</label>
                                            <input type="date" class="form-control" name="datefin" id="datefin">
                                            @if ($errors->has('datefin'))
                                                <span class="text-danger">{{ $errors->first('datefin') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <select class="form-control selectpicker" multiple data-live-search="true" name="voitures[]" id="voitures">
                                                @if ($voiture->count() > 0)
                                                    @foreach ($voiture as $us)
                                                        <option value="{{ $us->id }}">{{ $us->marque }} ( {{ $us->immatriculation }} )</option>
                                                    @endforeach
                                                @else
                                                    <option value="">Pas de voiture</option>
                                                @endif
                                            </select>
                                            @if ($errors->has('voitures'))
                                                <span class="text-danger">{{ $errors->first('voitures') }}</span>
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
