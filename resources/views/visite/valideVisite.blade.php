@extends('master')

@section('content')
    <main id="main" class="main row" style="padding-bottom: 50px; padding-top:40px">
        <div class="col-sm-2"></div>
        <section class="section card col-sm-8">
            <div class="card-body">
                <h5 class="card-title">
                    Validation Visite Technique <br>
                    <small>Valider la visite technique en ajoutant la date de la prochaine visite.</small>
                </h5>
                <hr>
                @if ($type == 'all')
                    <form class="row g-3" method="POST" action="{{ route('terminerVisteAll') }}">
                @else
                    <form class="row g-3" method="POST" action="{{ route('terminerViste',['id'=>$voiture->id]) }}">
                @endif
                    @csrf
                    <div class="col-6"><strong>Voiture</strong></div>
                    <div class="col-6"><strong>Date De Da Prochaine Visite</strong></div>
                    @if ($type == 'all')
                        @foreach ($voitures as $voiture)
                            <div class="col-6">
                                <input type="text" value="{{ $voiture->marque }}({{ $voiture->immatriculation }})"
                                    class="form-control" disabled>
                            </div>

                            <div class="col-md-6">
                                <input type="date" name="{{ $voiture->id }}" id="{{ $voiture->id }}"
                                    class="form-control" required>
                            </div>
                            <input type="hidden" name="voitures[]" value="<?= $voiture->id ?>">
                        @endforeach
                    @else
                        <div class="col-6">
                            <input type="text" value="{{ $voiture->marque }}({{ $voiture->immatriculation }})"
                                class="form-control" disabled>
                        </div>

                        <div class="col-md-6">
                            <input type="date" name="{{ $voiture->id }}" id="{{ $voiture->id }}" class="form-control"
                                required>
                        </div>
                    @endif
                        <!-- No Labels Form -->
                        <div class="text-left">
                            <button type="submit" class="btn btn-primary">Terminer Validation</button>
                            <button type="reset" class="btn btn-outline-secondary">Annuler</button>
                        </div>
                </form>
            </div>
        </section>
    </main>
@endsection
