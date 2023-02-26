<?php
namespace App\Http\Controllers;
use App\Models\Voiture;
use App\Models\Chauffeur;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
?>
@extends('master')

@section('content')
    @if (Auth::user()->role == 'Administrateur')
        <main id="main" class="main">
            <section class="section dashboard">
                <div class="row">
                    <div class="col-lg-12">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                <span class="font-medium">{{ session('msg') }}</span>
                            </div>
                        @endif
                        <br><br>
                        <div class="row">
                            <a href="{{ url('structures') }}" class="col-xxl-4 col-md-3">
                                <div class="card info-card revenue-card">
                                    <div class="card-body">
                                        <h3 class="card-title">Structures</span></h3>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-house"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $structure }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a class="col-xxl-4 col-md-3" href="{{ url('voitures') }}">
                                <div class="card info-card revenue-card">
                                    <div class="card-body">
                                        <h3 class="card-title">Voitures</span></h3>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-truck"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $vo }}</h6>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </a>

                            <a href="{{ url('chauffeurs') }}" class="col-xxl-4 col-md-3">
                                <div class="card info-card revenue-card">
                                    <div class="card-body">
                                        <h3 class="card-title">Chauffeurs</span></h3>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-person"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $chauffeurs }}</h6>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </a>

                            <a href="{{ url('missions') }}" class="col-xxl-4 col-md-3">
                                <div class="card info-card revenue-card">
                                    <div class="card-body">
                                        <h3 class="card-title">Missions</span></h3>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $mission }}</h6>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </a>

                            <div class="col-12">
                                <div class="card recent-sales overflow-auto">
                                    <div class="card-body">
                                        <h5 class="card-title">Toutes les voitures</h5>

                                        <table class="table table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Marque</th>
                                                    <th scope="col">Immatriculation</th>
                                                    <th scope="col">Position</th>
                                                    <th scope="col">Disponibilité</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($voiture as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td><a
                                                                href="{{ url('detailsvoiture/' . $item->id) }}">{{ $item->marque }}</a>
                                                        </td>
                                                        <td>{{ $item->immatriculation }}</td>
                                                        <td><b style="color: green">{{ $item->mouvement }}</b></td>
                                                        <td>
                                                            @if ($item->dispo == 'Disponible')
                                                                <b style="color: blue">{{ $item->dispo }}</b>
                                                            @else
                                                                <b style="color: red">{{ $item->dispo }}</b>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr colspan="7">Pas de voiture pour le moment</tr>
                                                @endforelse
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </section>

        </main>
    @else
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
                                                <th scope="col">Date Début</th>
                                                <th scope="col">Date Fin</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Avec Chauffeur</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($demande as $item)
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
    @endif
