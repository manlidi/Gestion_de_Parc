@extends('master')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Demandez une Réparation</h5>
                            <div class="row">
                                <div class="col-sm-6">
                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    Les voitures à votre charge pour une mission
                                                </th>
                                                <th scope="col">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($voiture as $item)
                                                    <td>
                                                        {{ $item->voiture->marque ?? '---' }}
                                                        ({{ $item->voiture->immatriculation ?? '---' }})
                                                    </td>
                                                    <td>
                                                        <a href=""><button type="button"
                                                                class="btn btn-outline-success btn-sm">Demander Réparation</button></a>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-6">
                                    <table class="table table-borderless datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    Les voitures que vous avez demander
                                                </th>
                                                <th scope="col">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($voituredemande as $item)
                                                    <td>
                                                        {{ $item->marque ?? '---' }} ({{ $item->immatriculation ?? '---' }}) <br>
                                                    </td>
                                                    <td>
                                                        <a href=""><button type="button"
                                                                class="btn btn-outline-success btn-sm">Demander Réparation</button></a>
                                                    </td>
                                                @endforeach
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
@endsection
