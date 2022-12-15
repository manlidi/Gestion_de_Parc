<?php
namespace App\Http\Controllers;
use App\Models\Voiture;
use App\Models\Chauffeur;
use Illuminate\Support\Facades\Auth;
?>
@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Demandez une Réparation</h5>
                            @if(count($voitures) > 0)
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Marque</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($voitures as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $item->marque }} ({{ $item->immatriculation }})
                                            </td>
                                            <td>
                                                <span class="badge rounded-pill bg-info text-dark">{{ $item->mouvement }}</span>
                                            </td>
                                            <td>
                                                @if( ! DemandeController::isdemanderEnReparation( $item->id ) )
                                                    <a href="{{ route('addReparationDetail',['id'=>$item->affecter_id,]) }}"><button type="button"
                                                        class="btn btn-outline-success btn-sm">Demander Réparation</button></a>
                                                @else
                                                    <button class="btn btn-info" disabled>Réparation</button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-warning bg-warning border-0 alert-dismissible fade show" role="alert">
                                    Vous n'avez de voiture à votre active
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
