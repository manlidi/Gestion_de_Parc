@extends('master')

@section('content')

    <main id="main" class="main">
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="d-flex flex-column align-items-center justify-content-center">

                            <div class="card">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h3><img src="{{ asset('logo/i.png') }}" style="width: 170px;" alt="Esgis_logo"></h3>
                                        <h5 class="card-title p-0 m-0 fs-4">Entrer votre mot de passe</h5>
                                        <small class="form-text">Valider votre compte en définissant votre mot de passe</small>
                                    </div><hr>

                                    <form class="row g-3 needs-validation" action="{{ route('updatePass', ['id' => $user->id]) }}" method="get">
                                        @csrf
                                        <div class="col-sm-6">
                                            <label for="inputPassword4" class="form-label">Nom & Prénoms</label>
                                            <input type="text" class="form-control"
                                                value="{{ $user->name }}" disabled>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="inputPassword4" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                             value="{{ $user->email }}" disabled >
                                        </div>
                                        <div class="col-12">
                                            <label for="inputPassword4" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Votre mot de passe" required autocomplete="new-password">
                                                @if ($errors->has('password'))
                                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                                @endif
                                        </div>
                                        <div class="col-12">
                                            <label for="inputPassword4" class="form-label">Confirmer Password</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                id="password_confirmation" placeholder="Votre mot de passe" required
                                                autocomplete="new-password">
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                                @endif
                                        </div>                                    
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Enregistrer</button>
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
