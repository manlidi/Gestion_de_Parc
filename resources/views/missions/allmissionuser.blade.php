<?php namespace App\Http\Controllers; ?>
@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <h5><u>Détails de la Mission</u> : <strong>{{ $mission->objetmission }}</strong></h5>
                        <h5 class="card-title">
                            <u>Status:</u>
                            <strong class="text-secondary">{{ $mission->etat }}
                                @if ($mission->etat == 'Non fait')
                                    (<span class="text-primary">En cours</span>)
                                @else
                                    (<span class="text-success">Terminé</span>)
                                @endif
                            </strong>
                            @if ($mission->etat == 'Non fait')
                                <button class="btn btn-outline-danger btn-sm" type="button"
                                    data-bs-toggle="modal" data-bs-target="#modal<?= $mission->id ?>">Cliquez Pour Terminer</button>
                                    <?= MissionController::missionModal($mission->id, route('up',['id'=> $mission->id ]))?>
                            @endif
                        </h5>
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <span class="font-medium">{{ session('msg') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <hr>
                        <div class="">
                            @if( $mission->mission_users->count() > 0 )
                                <table class="table table-responsive datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">
                                                Voitures
                                                @if ($mission->etat == 'Fait')
                                                    @if(! $voitureRendu)
                                                        <a href="{{ url('rendreAllVoiture/' . $mission->id) }}"><button type="button" class="btn btn-outline-success btn-sm">Rendre Toutes</button></a>
                                                    @else
                                                        <button type="button" disabled class="btn btn-success btn-sm">Rendu</button>
                                                    @endif
                                                @endif
                                            </th>
                                            <th scope="col">
                                                Chauffeurs
                                                @if(! $chauffeurAjouterMission )
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#chauffeuremodal<?= $mission->id ?>" class="btn btn-outline-primary btn-sm">Ajouter</button>
                                                @endif
                                            </th>
                                            <th scope="col">
                                                Kilométrage de début
                                                @if(! $kmDebutAjouterMission )
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#kmdebmodal<?= $mission->id ?>" class="btn btn-outline-warning btn-sm">Ajouter Km</button>
                                                @endif
                                            </th>
                                            <th scope="col">Kilométrage de fin</th>
                                            @if ($mission->etat == 'Fait')
                                                <th>
                                                    Action
                                                </th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($mission->mission_users as $affecter)
                                            <tr>
                                                <th scope="row">
                                                    <?= $i ?>
                                                </th>
                                                <td>{{ $affecter->voiture->marque }} ( {{ $affecter->voiture->immatriculation }} )</td>
                                                <td>
                                                    @if( ! empty($affecter->chauffeur) )
                                                        {{ $affecter->chauffeur->nom_cva  }}
                                                    @else
                                                        Pas de Chauffeur
                                                    @endif
                                                </td>
                                                <td>
                                                    @if( $affecter->kmdeb != 0 )
                                                        {{ $affecter->kmdeb }} km
                                                    @else
                                                        {{ $affecter->kmdeb }} km (<span class="text-danger">Non défini</span>)
                                                    @endif
                                                </td>
                                                <td>
                                                    @if( $affecter->kmfin != 0 )
                                                        {{ $affecter->kmfin }} km
                                                    @else
                                                        {{ $affecter->kmfin }} km (Non défini)
                                                    @endif
                                                </td>
                                                @if ($mission->etat == "Fait")
                                                <td>
                                                    @if( $affecter->voiture->dispo == 'Non Disponible')
                                                        <a href="{{ url('rendreVoiture/' . $mission->id . '/' . $affecter->voiture->id . '/' .$affecter->id) }}"><button type="button" class="btn btn-outline-success btn-sm">Rendre</button></a>
                                                    @else
                                                        <button type="button" disabled class="btn btn-success btn-sm">Rendu</button>
                                                    @endif
                                                </td>
                                                @endif
                                            </tr>
                                        <?php $i++; ?>
                                        @endforeach
                                    </tbody>
                                </table>
                                <?= MissionController::missionModal($mission->id, route('addChauffeure',['id'=> $mission->id ]), 'chauffeure', $userStructureId)?>
                                <?= MissionController::missionModal($mission->id, route('addKmDebut',['id'=> $mission->id ]), 'kmdeb')?>
                            @else
                                <div class="alert alert-primary" role="alert">
                                    Pas de voiture affectée à cette mission
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
