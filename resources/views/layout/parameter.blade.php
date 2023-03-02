@extends('master')

@section('content')
    @if (Auth::user()->role == 'Administrateur')
        <main id="main" class="main">
            <div class="row">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-settings">Paramètre</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Mot
                                    de passe</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane show active fade pt-3" id="profile-settings">
                                <form class="g-3" method="POST" action="{{ route('parameter_form') }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email
                                            Notifications</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="row mt-3">
                                                @foreach ($notifs as $notif)
                                                    <div class="col-sm-8">
                                                        <div class="form-check form-switch mx-4">
                                                            @if ($notif->status)
                                                                <input class="form-check-input" name="{{ $notif->name }}" checked type="checkbox" role="switch">
                                                            @else
                                                                <input class="form-check-input" type="checkbox" name="{{ $notif->name }}" role="switch">
                                                            @endif
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">
                                                                Recevoir les
                                                                alertes concernant 
                                                                @if ($notif->name == 'vidange')
                                                                    les vidanges
                                                                @elseif ($notif->name == 'assurance')
                                                                    les assurances des voitures 
                                                                @elseif ($notif->name == 'visite')
                                                                    les visites techniques
                                                                @elseif ($notif->name == 'demande')
                                                                    les demandes de voiture
                                                                @else 
                                                                    les pièces
                                                                @endif
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <input name="{{ $notif->name }}_hour" value="{{ $notif->time }}" type="time"
                                                            class="form-control">
                                                    </div>
                                                @endforeach
                                                <div class="text-start mt-4">
                                                    <button type="submit" class="btn btn-primary">Enregister</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <form>
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control"
                                                id="currentPassword">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword" type="password" class="form-control" id="newPassword">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter
                                            New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="renewpassword" type="password" class="form-control"
                                                id="renewPassword">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @else
    @endif
