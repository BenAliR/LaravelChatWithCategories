@extends('dashboard.layouts.main')

@section('container')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/3177/3177440.png" alt="Photo de profil" class="img-thumbnail rounded-circle mb-3" width="150">
                        <h5>{{ auth()->user()->name }}</h5>
                        <p class="text-muted">{{ auth()->user()->username }}</p>
                        <a href="/profile/edit" class="btn btn-primary btn-sm">Modifier le profil</a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Détails du profil</h4>
                        <p>
                            <strong>Nom : </strong>{{ auth()->user()->name }} <br>
                            <strong>Nom d'utilisateur : </strong>{{ auth()->user()->username }} <br>
                            <strong>Email : </strong>{{ auth()->user()->email }} <br>
                            <strong>Rejoint : </strong>{{ auth()->user()->created_at->format('d M Y') }}
                        </p>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h4 class="card-title">Actions</h4>
                        <a href="/password/change" class="btn btn-warning btn-sm">Changer le mot de passe</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
