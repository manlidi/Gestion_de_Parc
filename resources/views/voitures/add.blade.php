@extends('master')

@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Veuillez remplir tous les champs</h5>

                            <!-- No Labels Form -->
                            <form class="row g-3" method="POST" action="{{url('savevoitures')}}">
                                @csrf
                                <div class="col-md-12">
                                    <input type="text" name="marque" id="marque" class="form-control"
                                        placeholder="Marque de la voiture">
                                    @if ($errors->has('marque'))
                                        <span class="text-danger">{{ $errors->first('marque') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <input type="number" min="1" name="capacite" id="capacite" class="form-control"
                                        placeholder="Capacité de la voiture">
                                    @if ($errors->has('capacite'))
                                        <span class="text-danger">{{ $errors->first('capacite') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="immatriculation" id="immatriculation" class="form-control"
                                        placeholder="Immatriculation">
                                    @if ($errors->has('immatriculation'))
                                        <span class="text-danger">{{ $errors->first('immatriculation') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="">Date début de service</label>
                                    <input type="date" name="datdebservice" id="datdebservice" class="form-control">
                                    @if ($errors->has('datdebservice'))
                                        <span class="text-danger">{{ $errors->first('datdebservice') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="">Durée de vie de la voiture</label>
                                    <input type="number" min="1" name="dureeVie" id="dureeVie"
                                        class="form-control">
                                    @if ($errors->has('dureeVie'))
                                        <span class="text-danger">{{ $errors->first('dureeVie') }}</span>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <input type="number" min="1" name="numchassis" id="numchassis"
                                        class="form-control" placeholder="Numéro de chassis">
                                    @if ($errors->has('numchassis'))
                                        <span class="text-danger">{{ $errors->first('numchassis') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" name="etat">
                                        <option value="">Sélectionner l'état de la voiture</option>
                                        <option value="Utilisable">Utilisable</option>
                                        <option value="Plus utilisable">Plus utilisable</option>
                                    </select>
                                    @if ($errors->has('etat'))
                                        <span class="text-danger">{{ $errors->first('etat') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="kilmax" id="kilmax" class="form-control"
                                        placeholder="Kilomètre maximal à atteindre">
                                        @if ($errors->has('kilmax'))
                                        <span class="text-danger">{{ $errors->first('kilmax') }}</span>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <input type="number" min="1" name="connsommation" id="connsommation"
                                        class="form-control" placeholder="Consommation en litre de la voiture">
                                    @if ($errors->has('connsommation'))
                                        <span class="text-danger">{{ $errors->first('connsommation') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="coutaquisition" id="coutaquisition" class="form-control"
                                        placeholder="Cout d'acquisition">
                                    @if ($errors->has('coutaquisition'))
                                        <span class="text-danger">{{ $errors->first('coutaquisition') }}</span>
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
