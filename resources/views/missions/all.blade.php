<?php namespace App\Http\Controllers; ?>
@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <a href="{{ url('addmissions') }}" class="btn btn-primary">Ajouter une mission</a><br><br>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Liste des missions</h5>
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <span class="font-medium">{{ session('msg') }}</span>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                            <div class="table-responsive">
                                <table class="table table-responsive datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Objet de la mission</th>
                                            <th scope="col">Date début de la mission</th>
                                            <th scope="col">Date fin de la mission</th>
                                            <th scope="col">Etat</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($mission as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="{{ url('det/' . $item->id) }}">{{ $item->objetmission }}</a>
                                                </td>
                                                <td>{{ $item->datedeb }}</td>
                                                <td>{{ $item->datefin }}</td>
                                                <td><b class="<?php if( $item->etat == 'Fait' ) echo 'text-success'; else echo 'text-warning'; ?>">{{ $item->etat }}</b></td>
                                                <td class="text-center">
                                                    @if ($item->etat == 'Non fait')
                                                        <button class="btn btn-outline-primary btn-sm" type="button"
                                                            data-bs-toggle="modal" data-bs-target="#modal<?= $item->id ?>">En Cours<br>Fait ?</button>
                                                            <?= MissionController::missionModal($item->id, route('up',['id'=> $item->id ]))?>
                                                    @else
                                                        <?php 
                                                            if( MissionUserController::voitureRendu($item->id) ){
                                                                ?>
                                                                <a class="btn btn-outline-danger"
                                                                    onclick="return confirm('Supprimer vraiment?')"
                                                                    href="{{ url('del/' . $item->id) }}">Supprimer
                                                                </a>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <a class="btn btn-outline-warning"
                                                                    href="{{ url('det/' . $item->id) }}">Rendre Voiture
                                                                </a>
                                                                <?php
                                                            }
                                                        ?>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr colspan="7">Pas de mission pour le moment</tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
