<?php
namespace App\Http\Controllers;
use App\Models\Voiture;
use App\Models\Chauffeur;
use App\Models\User;
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
                                <h5 class="card-title">Liste Des Demandes En Attente De Validation</h5>
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
                                            <th scope="col">Avec Chauffeur</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($demande as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->objetdemande }}</td>
                                                <td>
                                                    @if($item->type == 'voiture')
                                                        @if($item->addchauffeur)
                                                            <strong class="text-success">Oui</strong>
                                                        @else
                                                            <strong class="text-danger">Non</strong>
                                                        @endif
                                                    @else
                                                        ----
                                                    @endif
                                                </td>
                                                <td>
                                                    <span
                                                        class="<?php if ($item->type == 'reparation') {
                                                            echo 'text-danger';
                                                        } elseif ($item->type == 'chauffeur') {
                                                            echo 'text-success';
                                                        } else {
                                                            echo 'text-primary';
                                                        } ?>">{{ ucfirst($item->type) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($item->type == 'voiture')
                                                        Du {{ $item->datedeb ?? '--' }} Au {{ $item->datefin ?? '--' }}
                                                    @else
                                                        Non Définie
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <a class="btn btn-outline-info btn-sm" href="{{ route('formValide',['id'=>$item->id]) }}">Approuvé</a>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <a onclick="return confirm('Voulez-vous vraiment rejeter cette demande? Si oui cliquez sur Ok')" class="btn btn-outline-danger btn-sm" href="{{ route('rejeterDemande',['id'=>$item->id, 'type'=>$item->type]) }}">Rejeter</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                    <div class="alert alert-warning">
                                        Pas de demande !
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
