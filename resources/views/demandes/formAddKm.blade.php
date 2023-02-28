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
                            <h5 class="card-title m-0">Terminé la validation</h5>
                            @if (session('status'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Ajouter les kilomtrage de début pour pouvoir terminé la validation.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form class=" card-body row g-3 " method="POST"
                                action="{{ route('validerDemande', ['id' => $demande->id]) }}">
                                @csrf
                                <div class="row">
                                    @foreach ($voitureValides as $voiture)
                                        <div class="col-sm-6"><input class="form-control" type="text" disabled name="{{ $voiture->affecter_id }}" value="{{ $voiture->affecter_id }}" /></div>
                                        <div class="col-sm-6"><input class="form-control" type="number" min="1" disabled name="{{ $voiture->affecter_id }}" placeholder="Kilométrage de début" /></div>
                                    @endforeach
                                </div>
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
