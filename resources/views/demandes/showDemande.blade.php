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
                            <h5 class="card-title m-0">Détails sur la demande</h5>
                            @if (session('status'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-1"></i>
                                    {{ session('msg') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if( ! $demande->etat )
                                @if (DemandeController::isDemandeRespo($demande->id))
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Pour rendre les voitures et les chauffeurs disponibles à la fin de la mission,<br>
                                            vous devez ajouter les kilométrage de début et de fin.<br>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                            @endif
                            <div class="row card-body bg-secondary">
                                <div class="col-sm-8">
                                    <p class="text-white p-0 m-0">
                                        <strong class="text-warning">Description : </strong><br>
                                        <?= nl2br($demande->description) ?>
                                    </p>
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
                                                <li style="color: yellow">Du : <strong>{{ $demande->datedeb }}</strong></li>
                                                <li style="color: yellow">Au : <strong>{{ $demande->datefin }}</strong></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <strong>Nombre de Voiture Demandée : {{ $demande->nbreVoiture }}</strong>
                                @if( ($kmDebutAjouterMission == true) && ($kmFinAjouterMission == true) && (!$demande->etat))
                                    <div class="alert alert-warning">Quelque voiture son en reparation pour le moment. <br>Attendez la fin de la réparation pour ajouter les km.</div>
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title m-0">Voitures affectée</h5>
                                <hr>
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Marque</th>
                                            <th scope="col">
                                                Km Début
                                                @if (DemandeController::isDemandeRespo($demande->id))
                                                    @if (! $kmDebutAjouterMission)
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#kmdebmodal<?= $demande->id ?>" class="btn btn-warning btn-sm">Ajouter Km</button>
                                                    @endif
                                                @endif
                                            </th>
                                            <th scope="col">
                                                Km Fin
                                                @if (DemandeController::isDemandeRespo($demande->id))
                                                    @if (! $kmFinAjouterMission)
                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#kmfinmodal<?= $demande->id ?>" class="btn btn-success btn-sm">Ajouter Km</button>
                                                    @endif
                                                @endif
                                            </th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($voitures as $voiture)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $voiture->marque }} ( {{ $voiture->immatriculation }} )</td>
                                                <td>{{ $voiture->kmdeb }} </td>
                                                <td>{{ $voiture->kmfin }}</td>
                                                <td>
                                                    @if ($voiture->status)
                                                        <span class="badge bg-success">Rendue</span>
                                                    @else
                                                        <span class="badge bg-danger">Non Rendue</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <?= MissionController::missionModal($demande->id, route('addKm',['id'=> $demande->id, 'type'=>'deb' ]), 'kmdeb')?>
                                <?= MissionController::missionModal($demande->id, route('addKm',['id'=> $demande->id, 'type'=>'fin' ]))?>
                                @if ($demande->addchauffeur)
                                    <h5 class="card-title m-0">Chauffeurs affecté</h5>
                                    <hr>
                                    @if (count($chauffeurs) > 0)
                                        <table class="table table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nom</th>
                                                    <th scope="col">Numéro</th>
                                                    <th scope="col">Adresse</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($chauffeurs as $chauffeur)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            {{ $chauffeur->name }}
                                                        </td>
                                                        <td>{{ $chauffeur->tel }} </td>
                                                        <td>{{ $chauffeur->adresse }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                    @endif
                                @endif
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
