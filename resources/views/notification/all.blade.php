@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <!-- Accordion without outline borders -->
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="card-body">
                                <h5 class="card-title accordion-header">
                                    <button type="button" id="flush-headingOne"
                                        class="btn btn-outline-primary collapsed mb-2" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne" aria-expanded="false"
                                        aria-controls="flush-collapseOne">
                                        Notifications Assurances Voiture <span
                                            class="badge bg-secondary text-light">{{ count($assurences) }}</span>
                                    </button>
                                    <button type="button" id="flush-headingTwo" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                        aria-controls="flush-collapseTwo" class="btn btn-outline-primary collapsed mb-2">
                                        Notifications Visite Technique <span
                                            class="badge bg-secondary text-light">{{ count($visites) }}</span>
                                    </button>
                                    <button type="button" id="flush-headingThree" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseThree" aria-expanded="false"
                                        aria-controls="flush-collapseThree" class="btn btn-outline-primary collapsed mb-2">
                                        Notifications Piece Véhicule <span
                                            class="badge bg-secondary text-light">{{ count($pieces) }}</span>
                                    </button>
                                </h5>
                                <hr>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
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
                                                            @if( $assurence['jourRestant'] < 0 )
                                                                est expirée depuis {{ ($assurence['jourRestant'] * (-1)) }}
                                                            @else
                                                                expire dans moins d'une semaine
                                                            @endif
                                                         précisement le <strong
                                                            class="text-primary">{{ $assurence['datefinA'] }}</strong>
                                                    </div>
                                                    <div class="col-sm-4 text-right">
                                                        <a href="{{ url('addassurance/' . $key) }}">
                                                            @if( $assurence['jourRestant'] < 0 )
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
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
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
                                                            @if( $visite['jourRestant'] < 0 )
                                                                est passée il y a {{ ($visite['jourRestant'] * (-1)) }}
                                                            @else
                                                             est dans moins d'une semaine
                                                            @endif
                                                             précisement le <strong
                                                            class="text-primary">{{ $visite['date_next_visite'] }}</strong>
                                                    </div>
                                                    <div class="col-sm-4 text-right">
                                                        <a href="{{ url('voitures') }}">
                                                            @if( $visite['jourRestant'] < 0 )
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
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>
                                <div id="flush-collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    @if (count($pieces) > 0)
                                        @foreach ($pieces as $key => $piece)
                                            @if ($piece['datefin'] > now())
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                                            La piece <strong
                                                                class="text-primary">{{ $piece['nompiece'] }}</strong>
                                                            de la
                                                            voiture <strong
                                                                class="text-primary">{{ $piece['marque'] }}</strong>
                                                            immatriculé <strong
                                                                class="text-primary">{{ $piece['immatriculation'] }}</strong>
                                                            expire dans moins d'une semaine précisement le <strong
                                                                class="text-primary">{{ $piece['datefin'] }}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <i class="bi bi-exclamation-triangle me-1"></i>
                                                            La piece <strong
                                                                class="text-primary">{{ $piece['nompiece'] }}</strong>
                                                            de la
                                                            voiture <strong
                                                                class="text-primary">{{ $piece['marque'] }}</strong>
                                                            immatriculé <strong
                                                                class="text-primary">{{ $piece['immatriculation'] }}</strong>
                                                            a déjà expiré depuis le <strong
                                                                class="text-primary">{{ $piece['datefin'] }}</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <div class="alert border-warning alert-dismissible fade show" role="alert">
                                            Pas de notification
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
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
