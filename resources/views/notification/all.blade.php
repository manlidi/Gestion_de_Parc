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
                                        aria-controls="flush-collapseTwo"
                                        class="btn btn-outline-primary collapsed mb-2">
                                        Notifications Visite Technique <span
                                            class="badge bg-secondary text-light">{{ count($visites) }}</span>
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
                                                        expire dans moins d'une semaine précisement le <strong
                                                            class="text-primary">{{ $assurence['datefinA'] }}</strong>
                                                    </div>
                                                    <div class="col-sm-4 text-right">
                                                        <a href="{{ url('addassurance/' . $key) }}"><button type="button"
                                                                class="btn btn-outline-primary">{{ $assurence['jourRestant'] }}
                                                                jour restant <strong>Assurer</strong></button></a>
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
                                                        est dans moins d'une semaine précisement le <strong
                                                            class="text-primary">{{ $visite['date_next_visite'] }}</strong>
                                                    </div>
                                                    <div class="col-sm-4 text-right">
                                                        <a href="{{ url('voitures') }}"><button type="button"
                                                                class="btn btn-outline-primary">{{ $visite['jourRestant'] }}
                                                                jour restant <strong>Aller en Visite</strong></button></a>
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

                            </div>
                        </div><!-- End Accordion without outline borders -->
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
