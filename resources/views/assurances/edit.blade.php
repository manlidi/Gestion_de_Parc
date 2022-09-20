@extends('master')

@section('content')
    <main id="main" class="main">
        <div class="container">

            <section class="section min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Ajouter une assurance</h5>
                                    </div>

                                    <form class="row g-3 needs-validation" action="{{ url('updateass/'.$assurances->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-12">
                                            <input type="text" class="form-control" name="societeAssurance" id="societeAssurance"
                                                value="{{$assurances->societeAssurance}}" placeholder="Nom de la société">
                                            @if ($errors->has('societeAssurance'))
                                                <span class="text-danger">{{ $errors->first('societeAssurance') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <input type="date" class="form-control" name="datedebA" id="datedebA"
                                               value="{{$assurances->datedebA}}" placeholder="Date début de l'assurance">
                                            @if ($errors->has('datedebA'))
                                                <span class="text-danger">{{ $errors->first('datedebA') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <input type="date" class="form-control" name="datefinA" id="datefinA"
                                               value="{{$assurances->datefinA}}" placeholder="Date fin de l'assurance">
                                            @if ($errors->has('datefinA'))
                                                <span class="text-danger">{{ $errors->first('datefinA') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Modifier</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>
@endsection
