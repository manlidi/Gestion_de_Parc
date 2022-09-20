@extends('master')

@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <h4 style="text-align: center">Ajout d'un chauffeur</h4><br><br>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Veuillez remplir tous les champs</h5>

                            <!-- No Labels Form -->
                            <form class="row g-3" method="POST" action="{{ url('storechauffeurs') }}">
                                @csrf
                                <div class="col-md-6">
                                    <input type="text" name="nom_cva" id="nom_cva" class="form-control"
                                        placeholder="Nom du chauffeur" required>
                                    @if ($errors->has('nom_cva'))
                                        <span class="text-danger">{{ $errors->first('nom_cva') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <input type="text" name="prenom_cva" id="prenom_cva" class="form-control"
                                        placeholder="Prénoms du chauffeur" required>
                                    @if ($errors->has('prenom_cva'))
                                        <span class="text-danger">{{ $errors->first('prenom_cva') }}</span>
                                    @endif
                                </div>

                                <div class="col-12">
                                    <input type="number" min="1" name="tel" id="tel"
                                        class="form-control" placeholder="Téléphone du chauffeur" required>
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

                                <div class="col-md-6">
                                    <select class="form-select" name="structure_id">
                                        <option selected>Sélectionner sa structure</option>
                                        @if ($structures->count() > 0)
                                            @foreach ($structures as $us)
                                                <option value="{{ $us->id }}">{{ $us->nomStructure }}</option>
                                            @endforeach
                                        @else
                                            <option value="">Pas de Structure</option>
                                        @endif
                                    </select>
                                    @if ($errors->has('structure_id'))
                                        <span class="text-danger">{{ $errors->first('structure_id') }}</span>
                                    @endif

                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form><!-- End No Labels Form -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
