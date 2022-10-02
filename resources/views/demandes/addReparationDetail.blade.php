@extends('master')
@section('content')
    <main id="main" class="main" style="padding-top:100px">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="card-body">
                                <h5 class="card-title">Ajouter les détails de la réparation</h5><hr>
                                <form class="row g-3 needs-validation" method="POST"
                                    action="{{ route('saveDemandeReparation',['id'=>$voiture->id]) }}">
                            @csrf
                            <h5 class="card-title pl-4">Voiture : {{ $voiture->marque }} ({{ $voiture->immatriculation }})</h5>
                            <div class="col-12">
                                <label for="">Panne</label>
                                <input type="text" class="form-control" placeholder="Saisir la panne" required name="panne" id="panne">
                            </div>
                            <div class="col-12">
                                <label>Selectionner les pièces</label>
                                <select class="form-control selectpicker" multiple data-live-search="true" name="pieces[]" id="pieces">
                                    @if ($pieces->count() > 0)
                                        @foreach ($pieces as $piece)
                                            <option value="{{ $piece->id }}">{{ $piece->nompiece }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Pas de pièce pour cette voiture</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-12">
                                <label>Selectionner le garage</label>
                                <select class="form-select pt-2" name="garage">
                                    @if ($garages->count() > 0)
                                        @foreach ($garages as $garage)
                                            <option value="{{ $garage->id }}">{{ $garage->nomgarage }}</option>
                                        @endforeach
                                    @else
                                        <option value="">Pas de garage disponible</option>
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
