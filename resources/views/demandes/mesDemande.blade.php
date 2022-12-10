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
                                    @if ($demandes->count() > 0)
                                        <table class="table table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Objet De La Demande</th>
                                                    <th scope="col">Date Début</th>
                                                    <th scope="col">Date Fin</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Avec Chauffeur</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($demandes as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td><a href="{{ route('showDetail',['id' => $item->id]) }}">{{ $item->objetdemande }}</a></td>
                                                        <td>{{ $item->datedeb ?? '--' }} </td>
                                                        <td>{{ $item->datefin ?? '--' }}</td>
                                                        <td>
                                                            <span class="<?php if ($item->type == 'reparation') {
                                                                echo 'text-danger';
                                                            } elseif ($item->type == 'chauffeur') {
                                                                echo 'text-success';
                                                            } else {
                                                                echo 'text-primary';
                                                            } ?>">{{ ucfirst($item->type) }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            @if ($item->addchauffeur)
                                                                <strong class="text-success">Oui</strong>
                                                            @else
                                                                <strong class="text-danger">Non</strong>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($item->type == 'voiture')
                                                                <a class="btn btn-outline-primary btn-sm"
                                                                    href="{{ route('showDetail',['id' => $item->id]) }}">Voir</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="alert alert-warning">
                                            Pas de demande validée
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">
                                <div class="card-body">
                                    <h5 class="card-title text-danger">Liste Des Demandes Non Approuvées</h5>
                                    @if ($nonValidedemandes->count() > 0)
                                        <table class="table table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Objet De La Demande</th>
                                                    <th scope="col">Date Début</th>
                                                    <th scope="col">Date Fin</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Avec Chauffeur</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($nonValidedemandes as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->objetdemande }}</td>
                                                        <td>{{ $item->datedeb ?? '--' }} </td>
                                                        <td>{{ $item->datefin ?? '--' }}</td>
                                                        <td>
                                                            <span class="<?php if ($item->type == 'reparation') {
                                                                echo 'text-danger';
                                                            } elseif ($item->type == 'chauffeur') {
                                                                echo 'text-success';
                                                            } else {
                                                                echo 'text-primary';
                                                            } ?>">{{ ucfirst($item->type) }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            @if ($item->addchauffeur)
                                                                <strong class="text-success">Oui</strong>
                                                            @else
                                                                <strong class="text-danger">Non</strong>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($item->type == 'voiture')
                                                                <a class="btn btn-outline-primary btn-sm"
                                                                    href="">Editer</a>
                                                                <a class="btn btn-outline-danger btn-sm"
                                                                    href="">Supprimer</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <div class="alert alert-warning">
                                            Pas de demande Non validée
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
