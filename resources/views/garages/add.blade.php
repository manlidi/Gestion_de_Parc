@extends('master')

@section('content')
    <main id="main" class="main">
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Ajouter un garage</h5>
                                    </div>

                                    <form class="row g-3 needs-validation" action="{{url('savegarage')}}" method="post">
                                        @csrf
                                        <div class="col-12">
                                            <input type="text" class="form-control" name="nomgarage" id="nomgarage"
                                                placeholder="Nom du garage" required>
                                            @if ($errors->has('nomgarage'))
                                                <span class="text-danger">{{ $errors->first('nomgarage') }}</span>
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
