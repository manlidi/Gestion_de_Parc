@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Modifier votre demande de voiture</h5>
                            <form class="row g-3 needs-validation" method="POST" action="">
                                @csrf
                                <div class="col-12">
                                    <input type="text" name="objetdemande" id="objetdemande" class="form-control"
                                       value="{{ $demandes->objetdemande }}" placeholder="Objet de la demande" required>
                                </div>
                                <div class="col-12">
                                    <select class="form-select" name="voiture_id">
                                        <option value="{{ $demandes->affecter_id }}">{{ $demandes->affecter_id }}</option>
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
                                        <label class="form-check-label text-primary">Voulez-vous un chauffeur ?</label><br>
                                        <input class="form-check-input" name="check" type="checkbox"> Oui
                                    </div>
                                    <select class="form-select pt-2" name="chauffeur_id" style="display: none">
                                        <option value="{{ $demandes->user_id }}">{{ $demandes->user->name }}</option>
                                        @if ($chauffeur->count() > 0)
                                            @foreach ($chauffeur as $us)
                                                <option value="{{ $us->id }}">{{ $us->nom_cva }}</option>
                                            @endforeach
                                        @else
                                            <option value="">Pas de chauffeur disponible</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="">Date début</label>
                                    <input type="date" class="form-control" value="{{ $demandes->datedeb }}" name="datedeb" id="datedeb">
                                </div>
                                <div class="col-6">
                                    <label for="">Date fin</label>
                                    <input type="date" class="form-control" value="{{ $demandes->datefin }}" name="datefin" id="datefin">
                                </div>
                                <div class="text-left">
                                    <button type="submit" class="btn btn-primary">Modifier la demande</button>
                                    <button type="reset" class="btn btn-outline-secondary">Annuler</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
