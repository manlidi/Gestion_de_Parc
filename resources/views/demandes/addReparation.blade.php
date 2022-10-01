@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Demandez une Réparation</h5>
                            <form class="row g-3 needs-validation" method="POST" action="{{ route('saveDemande',['type'=>'reparation']) }}">
                                @csrf
                                <div class="col-12">
                                    <input type="text" name="objetdemande" id="objetdemande" class="form-control"
                                        placeholder="Objet de la demande" value="Réparer Une Voiture" required>
                                </div>
                                <div class="col-12">
                                    <select class="form-select" name="voiture_id" required>
                                        @if ($voiture->count() > 0)
                                            @foreach ($voiture as $us)
                                                <option value="{{ $us->id }}">{{ $us->marque }}</option>
                                            @endforeach
                                        @else
                                            <option value="">Pas de voiture disponible</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="text-left">
                                    <button type="submit" class="btn btn-primary">Envoyer la demande</button>
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
