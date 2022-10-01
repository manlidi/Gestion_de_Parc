@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            @if (isset($demande))
                                <h5 class="card-title">Editer une demande de chauffeur</h5>
                                <form class="row g-3 needs-validation" method="POST"
                                    action="{{ route('updateDemande', ['id' => $demande->id, 'type' => 'chauffeur']) }}">
                                @else
                                    <h5 class="card-title">Demandez un chauffeur</h5>
                                    <form class="row g-3 needs-validation" method="POST"
                                        action="{{ route('saveDemande', ['type' => 'chauffeur']) }}">
                            @endif
                            @csrf
                            <div class="col-12">
                                <input type="text" name="objetdemande" id="objetdemande" class="form-control" value="{{ isset($demande->objetdemande) ? $demande->objetdemande : old('objetdemande') }}"
                                    placeholder="Objet de la demande" required>
                            </div>
                            <div class="col-12">
                                <select class="form-select" name="chauffeur_id" required>
                                    @if ($chauffeur->count() > 0)
                                        @foreach ($chauffeur as $us)
                                            <option <?php if( isset( $demande ) ) { if( $demande->affecter_id == $us->id ) echo 'selected'; } ?> value="{{ $us->id }}">{{ $us->nom_cva }} {{ $us->prenom_cva }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="">Pas de chauffeur disponible</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="">Date début</label>
                                <input type="date" required value="{{ isset($demande->datedeb) ? $demande->datedeb : old('datedeb') }}" class="form-control" name="datedeb" id="datedeb">
                            </div>
                            <div class="col-6">
                                <label for="">Date fin</label>
                                <input type="date" required value="{{ isset($demande->datefin) ? $demande->datefin : old('datefin') }}" class="form-control" name="datefin" id="datefin">
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
