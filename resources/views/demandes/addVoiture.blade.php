@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            @if (isset($demande))
                                <h5 class="card-title">Editer une demande de voiture</h5>
                                <form class="row g-3 needs-validation" method="POST"
                                    action="{{ route('updateDemande', ['id'=>$demande->id,'type' => 'voiture']) }}">
                            @else
                                <h5 class="card-title">Demandez une voiture</h5>
                                <form class="row g-3 needs-validation" method="POST" action="{{ route('saveDemande', ['type' => 'voiture']) }}">
                            @endif
                            @csrf
                            <div class="col-12">
                                <input type="text" name="objetdemande" id="objetdemande" value="{{ isset($demande->objetdemande) ? $demande->objetdemande : old('objetdemande') }}" required class="form-control" placeholder="Objet de la demande" required>
                            </div>
                            <div class="col-12">
                                <select class="form-select" name="voiture_id" required>
                                    @if ($voiture->count() > 0)
                                        @foreach ($voiture as $us)
                                            <option value="{{ $us->id }}" <?php if( isset( $demande ) ) { if( $demande->affecter_id == $us->id ) echo 'selected'; } ?> >{{ $us->marque }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Pas de voiture disponible</option>
                                    @endif
                                </select>
                            </div>
                            @if(! isset($demande))
                                <div class="col-sm-12">
                                    <div class="form-check">
                                        <label class="form-check-label text-primary">Voulez-vous un chauffeur ?</label><br>
                                        <input class="form-check-input" name="check" type="checkbox"> Oui
                                    </div>
                                    <select class="form-select pt-2" name="chauffeur_id" style="display: none">
                                        @if ($chauffeur->count() > 0)
                                            @foreach ($chauffeur as $us)
                                                <option value="{{ $us->id }}">{{ $us->name }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="">Pas de chauffeur disponible</option>
                                        @endif
                                    </select>
                                </div>
                            @endif
                            <div class="col-6">
                                <label for="">Date début</label>
                                <input type="date" value="{{ isset($demande->datedeb) ? $demande->datedeb : old('datedeb') }}" class="form-control" required name="datedeb" id="datedeb">
                            </div>
                            <div class="col-6">
                                <label for="">Date fin</label>
                                <input type="date" class="form-control" value="{{ isset($demande->datefin) ? $demande->datefin : old('datefin') }}" required name="datefin" id="datefin">
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

