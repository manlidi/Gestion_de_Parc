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
                                    <h5 class="card-title text-center pb-0 fs-4">Affecter un membre à la mission</h5>
                                </div>

                                <form class="row g-3 needs-validation" action="{{ url('saveusermission') }}" method="post">
                                    @csrf
                                    <div class="col-12">
                                        <select class="form-select" name="mission_id">
                                            <option value="{{ $mission->id }}">{{ $mission->objetmission }}</option>
                                        </select>
                                        @if ($errors->has('mission_id'))
                                            <span class="text-danger">{{ $errors->first('mission_id') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12">
                                        <select class="form-select" name="user_id">
                                            @if ($user->count() > 0)
                                                @foreach ($user as $us)
                                                    <option value="{{ $us->id }}">{{ $us->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="">Pas de membre</option>
                                            @endif
                                        </select>
                                        @if ($errors->has('user_id'))
                                            <span class="text-danger">{{ $errors->first('user_id') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Affecter</button>
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
