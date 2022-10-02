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
                            <div class="row">
                                <div class="col-sm-6">
                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    Les voitures à votre charge pour une mission
                                                </th>
                                                <th scope="col">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($voiture as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->marque ?? '---' }}
                                                    ({{ $item->immatriculation ?? '---' }})
                                                </td>
                                                <td>
                                                    @if( ! DemandeController::isdemanderEnReparation( $item->id ) )
                                                        <a href="{{ route('addReparationDetail',['id'=>$item->id]) }}"><button type="button"
                                                            class="btn btn-outline-success btn-sm">Demander Réparation</button></a>
                                                    @else  
                                                        <button class="btn btn-info" disabled>Réparation</button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-6">
                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    Les voitures que vous avez demander
                                                </th>
                                                <th scope="col">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($voituredemande as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->marque ?? '---' }} ({{ $item->immatriculation ?? '---' }}) <br>
                                                </td>
                                                <td>
                                                    @if( ! DemandeController::isdemanderEnReparation( $item->id ) )
                                                        <a href="{{ route('addReparationDetail',['id'=>$item->id]) }}"><button type="button"
                                                            class="btn btn-outline-success btn-sm">Demander Réparation</button></a>
                                                    @else  
                                                        <button class="btn btn-info" disabled>Réparation</button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
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
@endsection
