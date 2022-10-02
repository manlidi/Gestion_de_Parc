@extends('master')

@section('content')
    <main id="main" class="main row" style="padding-bottom: 100px; padding-top:100px">
        <div class="col-sm-2"></div>
        <section class="section card col-sm-8">
            <div class="card-body">
                <h5 class="card-title">Ajout d'un chauffeur</h5>

                <!-- No Labels Form -->
                <form class="row g-3" method="POST" action="{{ url('storechauffeurs') }}">
                    @csrf
                    <div class="col-md-12">
                        <select class="form-select" name="user_id" required>
                            @if ($users->count() > 0)
                                @foreach ($users as $us)
                                    <option title="{{ $us->email }}" value="{{ $us->id }}">
                                        {{ $us->name }}</option>
                                @endforeach
                            @else
                                <option value="">Pas de d'utilisateur</option>
                            @endif
                        </select>
                        @if ($errors->has('user_id'))
                            <span class="text-danger">{{ $errors->first('user_id') }}</span>
                        @endif
                    </div>

                    <div class="col-6">
                        <input type="number" min="1" name="tel" id="tel" class="form-control"
                            placeholder="Téléphone du chauffeur" required>
                        @if ($errors->has('tel'))
                            <span class="text-danger">{{ $errors->first('tel') }}</span>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="adresse" id="adresse" class="form-control"
                            placeholder="Adresse du chauffeur" required>
                        @if ($errors->has('adresse'))
                            <span class="text-danger">{{ $errors->first('adresse') }}</span>
                        @endif
                    </div>

                    <div class="text-left">
                        <button type="submit" class="btn btn-primary" <?php if($users->count() <= 0) echo 'disabled'; ?>>Enregistrer Chauffeur</button>
                        <button type="reset" class="btn btn-outline-secondary">Annuler</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
