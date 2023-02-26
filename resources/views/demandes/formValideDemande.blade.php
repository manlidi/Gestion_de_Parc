<?php
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\MissionController;
?>
@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title m-0">Approuvé Demande de Voiture</h5>
                            @if (session('status'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-1"></i>
                                    {{ session('msg') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="row card-body bg-secondary">
                                <div class="col-sm-8">
                                    <p class="text-white p-0 m-0">
                                        <strong class="text-warning">Description : </strong><br>
                                        <?= nl2br($demande->description) ?>
                                    </p>
                                    @if ($demande->type == 'reparation')
                                        <p class="text-white p-0 m-0">
                                        <h5>Réparation de : </h5>
                                        </p>
                                    @endif
                                </div>
                                <div class="col-sm-4">
                                    <div class="row text-white">
                                        <div class="col-sm-12">
                                            Avec Chauffeur :
                                            @if ($demande->addchauffeur)
                                                <strong style="color: rgb(222, 248, 125)">Oui</strong>
                                            @else
                                                <strong class="text-danger">Non</strong>
                                            @endif
                                        </div>
                                        <div class="col-sm-12 pt-2">
                                            Date <br>
                                            <ul class="text-sm space-y-1">
                                                <li style="color: yellow">Du :
                                                    <strong>{{ $demande->datedeb ?? '----' }}</strong>
                                                </li>
                                                <li style="color: yellow">Au :
                                                    <strong>{{ $demande->datefin ?? '----' }}</strong>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <strong>Nombre de Voiture Demandée : {{ $demande->nbreVoiture }}</strong>
                            </div>
                            <form class=" card-body row g-3 " method="POST"
                                action="{{ route('validerDemande', ['id' => $demande->id, 'type' => $demande->type]) }}">
                                @csrf
                                @if ($demande->type != 'reparation')
                                    <div class="col-12">
                                        <label for="voiture">Affecter Les Voitures</label>
                                        <select class="form-control selectpicker" multiple data-live-search="true"
                                            name="voitures[]" id="voitures">
                                            @if ($voitures->count() > 0)
                                                @foreach ($voitures as $us)
                                                    <option value="{{ $us->id }}">{{ $us->marque }} (
                                                        {{ $us->immatriculation }} )</option>
                                                @endforeach
                                            @else
                                                <option value="">Pas de voiture</option>
                                            @endif
                                        </select>
                                        @if ($errors->has('voitures'))
                                            <span class="text-danger">{{ $errors->first('voitures') }}</span>
                                        @endif
                                    </div>
                                    @if ($demande->addchauffeur)
                                        <div class="col-12">
                                            <label for="voiture">Affecter Les Chauffeurs</label>
                                            <select class="form-control selectpicker" multiple data-live-search="true"
                                                name="chauffeurs[]" id="chauffeurs">
                                                @if ($chauffeurs->count() > 0)
                                                    @foreach ($chauffeurs as $chauffeur)
                                                        @if ($chauffeur->user->structure_id == Auth::user()->structure_id)
                                                            <option value="{{ $chauffeur->user->id }}">
                                                                {{ $chauffeur->user->name }}</option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <option value="">Pas de Chauffeur Disponible</option>
                                                @endif
                                            </select>
                                            @if ($errors->has('voitures'))
                                                <span class="text-danger">{{ $errors->first('chauffeurs') }}</span>
                                            @endif
                                        </div>
                                    @endif
                                @endif
                                <div class="text-left">
                                    <button type="submit" class="btn btn-primary">Valider Demande</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
