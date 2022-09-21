@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h3 class="card-title">Nombres de fois que ce véhicule a été au garage</span></h3>
                                <div class="d-flex align-items-center">
                                    <div class="ps-3">
                                        @foreach ($nbr as $n)
                                            <h6>{{ $n->nombre }}</h6>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
