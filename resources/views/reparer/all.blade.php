<?php
namespace App\Http\Controllers;
use App\Models\Piece;
?>
@extends('master')
@section('content')
    <main id="main" class="main" style="padding-top: 40px; padding-bottom: 150px;">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Liste des réparations</h5>
                            @if( $repare->count() > 0 )
                            <table class="table table-responsive datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Le véhicule</th>
                                        <th scope="col">Panne</th>
                                        <th scope="col">Garage</th>
                                        <th scope="col">Pièces changées</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($repare as $rep)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $rep->marque }} ({{ $rep->immatriculation }})</td>
                                            <td>{{ $rep->panne }}</td>
                                            <td>{{ $rep->nomgarage }}</td>
                                            <td>
                                                @if( $rep->pieces != null  )
                                                    @foreach (unserialize($rep->pieces) as $piece)
                                                        {{ Piece::find($piece)->nompiece }},
                                                @endforeach
                                                @else
                                                    <span>Pièce non changée</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('rendreDemande',['id'=>$rep->id, 'type'=>$rep->type]) }}">
                                                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
                                                        Terminée ?
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else 
                                <div class="alert alert-info">Pas de réparation pour le moment</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
