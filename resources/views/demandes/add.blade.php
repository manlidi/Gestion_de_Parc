@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <h4 style="text-align: center">Formulaire de demande</h4><br><br>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Veuillez remplir tous les champs</h5>
                            <form class="row g-3 needs-validation" method="POST" action="{{ url('adddemandes') }}">
                                @csrf
                                <div class="col-12">
                                    <input type="text" name="objetdemande" id="objetdemande" class="form-control"
                                        placeholder="Objet de la demande" required>
                                </div>
                                <div class="col-12">
                                    <select class="form-select" name="voiture_id">
                                        @if ($voiture->count() > 0)
                                            @foreach ($voiture as $us)
                                                <option value="{{ $us->id }}">{{ $us->marque }}</option>
                                            @endforeach
                                        @else
                                            <option value="">Pas de voiture disponible</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-check">
                                        <label class="form-check-label">Voulez-vous un chauffeur?</label><br>
                                        <input class="form-check-input" name="check" type="checkbox"> Oui
                                      </div>
                                      <br>
                                    <select class="form-select" name="chauffeur_id" style="display: none">
                                        @if ($chauffeur->count() > 0)
                                            @foreach ($chauffeur as $us)
                                                <option value="{{ $us->id }}">{{ $us->nom_cva }}</option>
                                            @endforeach
                                        @else
                                            <option value="">Pas de chauffeur disponible</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="">Date début</label>
                                    <input type="date" class="form-control" name="datedeb" id="datedeb">
                                </div>
                                <div class="col-12">
                                    <label for="">Date fin</label>
                                    <input type="date" class="form-control" name="datefin" id="datefin">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
