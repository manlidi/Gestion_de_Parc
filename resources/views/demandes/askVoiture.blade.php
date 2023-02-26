@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card mb-3">
                        @if (session('status'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-1"></i>
                                {{ session('msg') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body">
                            @if (isset($demande))
                                <h5 class="card-title">Editer une demande de voiture</h5>
                                <form class="row g-3 needs-validation" method="POST"
                                    action="{{ route('updateDemande', ['id' => $demande->id, 'type' => 'voiture']) }}">
                                @else
                                    <h5 class="card-title">Demandez une voiture</h5>
                                    <form class="row g-3 needs-validation" method="POST"
                                        action="{{ route('saveDemande', ['type' => 'voiture']) }}">
                            @endif
                            @csrf
                            <div class="col-12">
                                <x-input-error :messages="$errors->get('objetdemande')" class="m-1" />
                                <input type="text" name="objetdemande" id="objetdemande"
                                    value="{{ isset($demande->objetdemande) ? $demande->objetdemande : old('objetdemande') }}"
                                    required class="form-control" placeholder="Objet de la demande">
                            </div>
                            <div class="col-12">
                                <x-input-error :messages="$errors->get('description')" class="m-1" />
                                <textarea class="form-control" required name="description" id="description" placeholder="Description"
                                    style="height: 100px">{{ isset($demande->description) ? $demande->description : old('description') }}</textarea>
                            </div>
                            <div class="col-6">
                                <x-input-error :messages="$errors->get('nbreVoiture')" class="m-1" />
                                <input type="number" min="1" placeholder="Nombre de voiture" name="nbreVoiture" id="nbreVoiture"
                                value="{{ isset($demande->nbreVoiture) ? $demande->nbreVoiture : old('nbreVoiture') }}" class="form-control" required>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-check pt-2 text-primary">
                                    <input class="form-check-input" name="addchauffeur" id="addchauffeur" type="checkbox">
                                    Voulez-vous un chauffeur ?
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="">Date début</label>
                                <input type="date"
                                    value="{{ isset($demande->datedeb) ? $demande->datedeb : old('datedeb') }}"
                                    class="form-control" required name="datedeb" id="datedeb">
                                <x-input-error :messages="$errors->get('datedeb')" class="m-1" />
                            </div>
                            <div class="col-6">
                                <label for="">Date fin</label>
                                <input type="date" class="form-control"
                                    value="{{ isset($demande->datefin) ? $demande->datefin : old('datefin') }}" required
                                    name="datefin" id="datefin">
                                <x-input-error :messages="$errors->get('datefin')" class="m-1" />
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
