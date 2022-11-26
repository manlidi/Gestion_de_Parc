@extends('master')

@section('content')
    <main id="main" class="main">
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            @if (session('status'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <span class="font-medium">{{ session('msg') }}</span>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Ajouter une structure</h5>
                                    </div>
                                    <form class="row g-3 needs-validation" action="{{ url('savestructures') }}" method="post">
                                        @csrf
                                        <div class="col-12">
                                            <input type="text" class="form-control" name="nomStructure" id="nomStructure"
                                                placeholder="Nom de la structure">
                                            @if ($errors->has('nomStructure'))
                                                <span class="text-danger">{{ $errors->first('nomStructure') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <input type="text" class="form-control" name="localisation" id="localisation"
                                                placeholder="Localisation de la structure">
                                            @if ($errors->has('localisation'))
                                                <span class="text-danger">{{ $errors->first('localisation') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Ajouter</button>
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
