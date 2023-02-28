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
                                action="{{ route('addkmdeb', ['id' => $demande->id]) }}">
                                @csrf
                                @foreach ($voitureValides as $voiture)
                                <div class="row g-3">
                                    <div class="col-sm-6"><input class="form-control" type="text" disabled name="{{ $voiture->affecter_id }}" value="{{ $voiture->voiture->marque }} ({{ $voiture->voiture->immatriculation }})" /></div>
                                    <div class="col-sm-6"><input class="form-control" type="number" min="1" name="{{ $voiture->affecter_id }}" placeholder="Kilométrage de début" /></div>
                                </div>
                                    @endforeach
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
