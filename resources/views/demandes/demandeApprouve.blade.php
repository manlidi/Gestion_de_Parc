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
                                    <h5 class="card-title">Liste Des Demandes Approuvées</h5>
                                    @if (session('status'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="bi bi-check-circle me-1"></i>
                                            {{ session('msg') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <hr>
                                    @if ($demande->count() > 0)
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
                                                        <td><span
                                                                class="<?php if ($item->type == 'reparation') {
                                                                    echo 'text-danger';
                                                                } elseif ($item->type == 'chauffeur') {
                                                                    echo 'text-success';
                                                                } else {
                                                                    echo 'text-primary';
                                                                } ?>">{{ ucfirst($item->type) }}</span>
                                                        </td>
                                                        <td>
                                                            @if ($item->type == 'voiture' || $item->type == 'reparation')
                                                                <strong>{{ Voiture::find($item->affecter_id)->marque }} (
                                                                    {{ Voiture::find($item->affecter_id)->immatriculation }}
                                                                    )</strong>
                                                            @else
                                                                <strong>{{ Chauffeur::find($item->affecter_id)->nom_cva }}
                                                                    {{ Chauffeur::find($item->affecter_id)->prenom_cva }}
                                                                </strong>
                                                            @endif
                                                        </td>
                                                        <td>{{ $item->datedeb ?? '--' }}</td>
                                                        <td>{{ $item->datefin ?? '--' }}</td>
                                                        <td><span class="badge bg-danger">{{ $item->status }}</span></td>
                                                        <td>
                                                            @if ($item->type == 'voiture')
                                                                <a
                                                                    href="{{ route('updateDemandeVoiture', ['id' => $item->id]) }}"><button
                                                                        type="button"
                                                                        class="btn btn-outline-primary btn-sm">Edit</button></a>
                                                            @endif
                                                            @if ($item->type == 'chauffeur')
                                                                <a
                                                                    href="{{ route('updateDemandeChauffeur', ['id' => $item->id]) }}"><button
                                                                        type="button"
                                                                        class="btn btn-outline-success btn-sm">Edit</button></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="alert alert-warning">
                                            Vous n'avez aucune demande approuvée !
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
