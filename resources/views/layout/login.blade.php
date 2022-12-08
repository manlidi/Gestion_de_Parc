@extends('master')

@section('content')
    <main id="main" class="main">
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3">

                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <span class="font-medium">{{ session('msg') }}</span>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="p-0 m-0"><img src="{{ asset('logo/i.png') }}" style="width: 170px;" alt="Esgis_logo"></h3>
                                        <h5 class="card-title p-0 m-0  fs-4">Connexion</h5>
                                    </div><hr>
                                    @if (\Session::has('message'))
                                        <div class="alert alert-info">{{ \Session::get('message') }}</div>
                                    @endif
                                    <form class="row g-3 needs-validation" action="{{ url('loginusers') }}" method="post">
                                        @csrf
                                        <div class="col-12">
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Email" required>
                                        </div>

                                        <div class="col-12">
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Mot de passe" required>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Se connecter</button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->
@endsection
