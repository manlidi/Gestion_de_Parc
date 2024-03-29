<?php
namespace App\Http\Controllers;
use App\Models\Voiture;
use App\Models\Chauffeur;
?>
@extends('master')
@section('content')
<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Liste des demandes</h5>
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="bi bi-check-circle me-1"></i>
                                        {{ session('msg') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <hr>
                                @if( $demande->count() > 0 )
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Objet De La Demande</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Demande</th>
                                            <th scope="col">Date début</th>
                                            <th scope="col">Date de fin</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($demande as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->objetdemande }}</td>
                                                <td><span class="<?php if( $item->type == 'reparation' ) echo 'text-danger';else if($item->type == 'chauffeur') echo 'text-success'; else echo 'text-primary'; ?>">{{ ucfirst($item->type) }}</span></td>
                                                <td>
                                                    @if( ($item->type == 'voiture') || $item->type == 'reparation' )
                                                        <strong>{{ Voiture::find($item->affecter_id)->marque }} ( {{ Voiture::find($item->affecter_id)->immatriculation }} )</strong>
                                                    @else
                                                        <strong>{{ Chauffeur::find($item->affecter_id)->name }}</strong>
                                                    @endif
                                                </td>
                                                <td>{{ $item->datedeb ?? '--' }}</td>
                                                <td>{{ $item->datefin ?? '--' }}</td>
                                                <td>
                                                    @if($item->type == 'chauffeur')
                                                        @if( DemandeController::chauffeurIsDispo($item->affecter_id) )
                                                            <span class="badge bg-warning p-1">{{ $item->status }}</span>
                                                        @else
                                                            <span class="badge bg-danger p-1">Chauffeur Indisponible</span>
                                                        @endif
                                                    @endif
                                                    @if($item->type == 'voiture')
                                                        @if( DemandeController::voitureIsDispo($item->affecter_id) )
                                                            <span class="badge bg-warning p-1">{{ $item->status }}</span>
                                                        @else
                                                            <span class="badge bg-danger p-1">Voiture Indisponible</span>
                                                        @endif
                                                    @endif
                                                    @if($item->type == 'reparation')
                                                        <span class="badge bg-warning p-1">{{ $item->status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->type == 'chauffeur')
                                                        @if( DemandeController::chauffeurIsDispo($item->affecter_id) )
                                                            <a href="{{ route('updateDemandeChauffeur',['id'=>$item->id]) }}"><button type="button" class="btn btn-outline-success btn-sm">Modifier</button></a>
                                                        @else
                                                            <a href="{{ route('updateDemandeChauffeur',['id'=>$item->id]) }}"><button type="button" class="btn btn-success btn-sm">Changer</button></a>
                                                        @endif
                                                    @endif
                                                    @if($item->type == 'voiture')
                                                        @if( DemandeController::voitureIsDispo($item->affecter_id) )
                                                            <a href="{{ route('updateDemandeVoiture',['id'=>$item->id]) }}"><button type="button" class="btn btn-outline-primary btn-sm">Modifier</button></a>
                                                        @else
                                                            <a href="{{ route('updateDemandeVoiture',['id'=>$item->id]) }}"><button type="button" class="btn btn-primary btn-sm">Changer</button></a>
                                                        @endif
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                    <div class="alert alert-warning">
                                        Vous n'avez fait aucune demande !
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
@endsection
