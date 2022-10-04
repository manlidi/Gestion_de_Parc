@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Notifications Assurances Voiture</h5>
                            @if( count($assurences) > 0 )
                                @foreach ($assurences as $key => $assurence)
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <i class="bi bi-exclamation-triangle me-1"></i>
                                                L'assurance de la voiture <strong class="text-primary">{{ $assurence['marque'] }}</strong> immatriculé <strong class="text-primary">{{ $assurence['immatriculation'] }}</strong> expire dans moins d'une semaine précisement le <strong class="text-primary">{{ $assurence['datefinA'] }}</strong>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                <a href="{{ url('addassurance/' . $key) }}"><button type="button" class="btn btn-outline-primary">{{ $assurence['jourRestant'] }} jour restant <strong>Assurer</strong></button></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else 
                                <div class="alert border-warning alert-dismissible fade show" role="alert">
                                    Pas de notification
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                                
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

