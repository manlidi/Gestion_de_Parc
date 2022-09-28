@extends('master')

@section('content')
    @if (Auth::user()->role == 'Administrateur')
        <main id="main" class="main">
            <section class="section dashboard">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <a href="{{ url('structures') }}" class="col-xxl-4 col-md-3">
                                <div class="card info-card revenue-card">
                                    <div class="card-body">
                                        <h3 class="card-title">Structures</span></h3>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-house"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $structure }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a class="col-xxl-4 col-md-3" href="{{ url('voitures') }}">
                                <div class="card info-card revenue-card">
                                    <div class="card-body">
                                        <h3 class="card-title">Voitures</span></h3>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-truck"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $vo }}</h6>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </a>

                            <a href="{{ url('chauffeurs') }}" class="col-xxl-4 col-md-3">
                                <div class="card info-card revenue-card">
                                    <div class="card-body">
                                        <h3 class="card-title">Chauffeurs</span></h3>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-person"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $chauffeurs }}</h6>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </a>

                            <a href="{{ url('missions') }}" class="col-xxl-4 col-md-3">
                                <div class="card info-card revenue-card">
                                    <div class="card-body">
                                        <h3 class="card-title">Missions</span></h3>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-currency-dollar"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{ $mission }}</h6>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </a>

                            <div class="col-12">
                                <div class="card recent-sales overflow-auto">
                                    <div class="card-body">
                                        <h5 class="card-title">Toutes les voitures</h5>

                                        <table class="table table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Marque</th>
                                                    <th scope="col">Immatriculation</th>
                                                    <th scope="col">Etat</th>
                                                    <th scope="col">Position</th>
                                                    <th scope="col">Disponibilité</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($voiture as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td><a href="{{url('detailsvoiture/'.$item->id)}}">{{ $item->marque }}</a></td>
                                                        <td>{{ $item->immatriculation }}</td>
                                                        <td>{{ $item->etat }}</td>
                                                        <td><b style="color: green">{{ $item->mouvement }}</b></td>
                                                        <td>
                                                            @if ($item->dispo == "Disponible")
                                                                <b style="color: blue">{{ $item->dispo }}</b>
                                                            @else
                                                            <b style="color: red">{{ $item->dispo }}</b>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr colspan="7">Pas de voiture pour le moment</tr>
                                                @endforelse
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </section>

        </main>
    @else
        <main id="main" class="main">
            <section class="section dashboard">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card recent-sales overflow-auto">

                                    <div class="filter">
                                        <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                                class="bi bi-three-dots"></i></a>
                                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                            <li class="dropdown-header text-start">
                                                <h6>Filter</h6>
                                            </li>

                                            <li><a class="dropdown-item" href="#">Today</a></li>
                                            <li><a class="dropdown-item" href="#">This Month</a></li>
                                            <li><a class="dropdown-item" href="#">This Year</a></li>
                                        </ul>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">Recent Sales <span>| Today</span></h5>

                                        <table class="table table-borderless datatable">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Customer</th>
                                                    <th scope="col">Product</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row"><a href="#">#2457</a></th>
                                                    <td>Brandon Jacob</td>
                                                    <td><a href="#" class="text-primary">At praesentium minu</a></td>
                                                    <td>$64</td>
                                                    <td><span class="badge bg-success">Approved</span></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#">#2147</a></th>
                                                    <td>Bridie Kessler</td>
                                                    <td><a href="#" class="text-primary">Blanditiis dolor omnis
                                                            similique</a></td>
                                                    <td>$47</td>
                                                    <td><span class="badge bg-warning">Pending</span></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#">#2049</a></th>
                                                    <td>Ashleigh Langosh</td>
                                                    <td><a href="#" class="text-primary">At recusandae
                                                            consectetur</a>
                                                    </td>
                                                    <td>$147</td>
                                                    <td><span class="badge bg-success">Approved</span></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#">#2644</a></th>
                                                    <td>Angus Grady</td>
                                                    <td><a href="#" class="text-primar">Ut voluptatem id earum
                                                            et</a>
                                                    </td>
                                                    <td>$67</td>
                                                    <td><span class="badge bg-danger">Rejected</span></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"><a href="#">#2644</a></th>
                                                    <td>Raheem Lehner</td>
                                                    <td><a href="#" class="text-primary">Sunt similique
                                                            distinctio</a>
                                                    </td>
                                                    <td>$165</td>
                                                    <td><span class="badge bg-success">Approved</span></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </section>

        </main>
    @endif
@endsection
