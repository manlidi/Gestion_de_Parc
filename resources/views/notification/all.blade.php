@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Bordered Tabs</h5>

                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="assurance-tab" data-bs-toggle="tab"
                                        data-bs-target="#bordered-assurance" type="button" role="tab"
                                        aria-controls="assurance" aria-selected="true">Assurances Voiture
                                        {{ count($assurences) }}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="visite-tab" data-bs-toggle="tab"
                                        data-bs-target="#bordered-visite" type="button" role="tab"
                                        aria-controls="visite" aria-selected="false">Visite Technique
                                        {{ count($visites) }}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="piece-tab" data-bs-toggle="tab"
                                        data-bs-target="#bordered-piece" type="button" role="tab" aria-controls="piece"
                                        aria-selected="false">Piece Véhicule {{ count($pieces) }}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="vidange-tab" data-bs-toggle="tab"
                                        data-bs-target="#bordered-vidange" type="button" role="tab"
                                        aria-controls="vidange" aria-selected="false">Vidange Véhicule
                                        {{ count($vidanges) }}</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2" id="borderedTabContent">
                                <div class="tab-pane fade show active" id="bordered-assurance" role="tabpanel"
                                    aria-labelledby="assurance-tab">
                                    @if (count($assurences) > 0)
                                        @foreach ($assurences as $key => $assurence)
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                                        L'assurance de la voiture <strong
                                                            class="text-primary">{{ $assurence['marque'] }}</strong>
                                                        immatriculé <strong
                                                            class="text-primary">{{ $assurence['immatriculation'] }}</strong>
                                                        @if ($assurence['jourRestant'] < 0)
                                                            est expirée depuis
                                                            {{ $assurence['jourRestant'] * -1 }} jour
                                                        @else
                                                            expire dans moins d'une semaine
                                                        @endif
                                                        précisement le <strong
                                                            class="text-primary">{{ $assurence['datefinA'] }}</strong>
                                                    </div>
                                                    <div class="col-sm-4 text-right">
                                                        <a href="{{ url('addassurance/' . $key) }}">
                                                            @if ($assurence['jourRestant'] < 0)
                                                                <button type="button"
                                                                    class="btn btn-outline-danger">{{ $assurence['jourRestant'] }}
                                                                    jour déjà <strong>Assurer Now</strong></button>
                                                        </a>
                                                    @else
                                                        <button type="button"
                                                            class="btn btn-outline-primary">{{ $assurence['jourRestant'] }}
                                                            jour restant <strong>Assurer</strong></button>
                                                        </a>
                                        @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="alert border-warning alert-dismissible fade show" role="alert">
                            Pas de notification
                        </div>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="bordered-visite" role="tabpanel" aria-labelledby="visite-tab">
                        @if (count($visites) > 0)
                            @foreach ($visites as $key => $visite)
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                            La prochaine vitsite technique de la voiture <strong
                                                class="text-primary">{{ $visite['marque'] }}</strong>
                                            immatriculé <strong
                                                class="text-primary">{{ $visite['immatriculation'] }}</strong>
                                            @if ($visite['jourRestant'] < 0)
                                                est passée il y a {{ $visite['jourRestant'] * -1 }}
                                            @else
                                                est dans moins d'une semaine
                                            @endif
                                            précisement le <strong
                                                class="text-primary">{{ $visite['date_next_visite'] }}</strong>
                                        </div>
                                        <div class="col-sm-4 text-right">
                                            <a href="{{ url('voitures') }}">
                                                @if ($visite['jourRestant'] < 0)
                                                    <button type="button"
                                                        class="btn btn-outline-danger">{{ $visite['jourRestant'] }}
                                                        jour déjà <strong>Aller en Visite Now</strong></button>
                                                @else
                                                    <button type="button"
                                                        class="btn btn-outline-primary">{{ $visite['jourRestant'] }}
                                                        jour restant <strong>Aller en Visite</strong></button>
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert border-warning alert-dismissible fade show" role="alert">
                                Pas de notification
                            </div>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="bordered-piece" role="tabpanel" aria-labelledby="piece-tab">
                        @if (count($pieces) > 0)
                            @foreach ($pieces as $key => $piece)
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                            La piece <strong class="text-primary">{{ $piece['nompiece'] }}</strong>
                                            @if ($piece['jourRestant'] < 0)
                                                est expirée depuis {{ $piece['jourRestant'] * -1 }} jour
                                            @else
                                                expire dans moins d'une semaine
                                            @endif
                                            précisement le <strong class="text-primary">{{ $piece['datefin'] }}</strong>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert border-warning alert-dismissible fade show" role="alert">
                                Pas de notification
                            </div>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="bordered-vidange" role="tabpanel" aria-labelledby="vidange-tab">
                        @if (count($vidanges) > 0)
                            @foreach ($vidanges as $key => $vidange)
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                            La voiture <strong class="text-primary">{{ $vidange['marque'] }}</strong>
                                            immatriculé <strong
                                                class="text-primary">{{ $vidange['immatriculation'] }}</strong>
                                            doit aller en vidange car son kilomettrage a atteint
                                            <strong class="text-primary">{{ $vidange['kmvidange'] }}</strong>
                                            depuis le dernier vidange.
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert border-warning alert-dismissible fade show" role="alert">
                                Pas de notification
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            </div>
            </div>
        </section>
    </main>
@endsection
