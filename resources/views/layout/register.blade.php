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

                                    <div class="text-center">
                                        <h3><img src="{{ asset('logo/i.png') }}" style="width: 170px;" alt="Esgis_logo"></h3>
                                        <h5 class="card-title text-center pb-0 fs-4">Enregistrer un utilisateur</h5>
                                    </div>

                                    <form class="row g-3 needs-validation" action="{{ url('registerusers') }}"
                                        method="post">
                                        @csrf
                                        <div class="col-12">
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Nom et prénoms" required>
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>

                                        <div class="col-12">
                                            <select class="form-select" name="role" required>
                                                <option selected>Sélectionner le role</option>
                                                <option value="Administrateur">Administrateur</option>
                                                <option value="Utilisateur">Utilisateur</option>
                                            </select>
                                            @if ($errors->has('role'))
                                            <span class="text-danger">{{ $errors->first('role') }}</span>
                                        @endif
                                        </div>

                                        <div class="col-12">
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="Email" required>
                                                @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                        </div>

                                        <div class="col-12">
                                            <select class="form-select" name="structure_id" required>
                                                <option selected>Sélectionner la structure</option>
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
