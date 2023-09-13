@extends('layouts.main')

@section('container')
    <div class="row justify-content-center">
        <div class="col-md-4">

            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <main class="form-signin">
                <h1 class="h3 mb-3 fw-normal text-center">Veuillez vous connecter</h1>
                <form action="/login" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="nom@example.com" autofocus required value="{{ old('email') }}">
                        <label for="email">Adresse e-mail</label>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Mot de passe" required>
                        <label for="password">Mot de passe</label>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="1" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Se souvenir de moi</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit">Connexion</button>

                    <div class="d-flex justify-content-between mt-3">
                        <small><a href="/register">S'inscrire maintenant!</a></small>
{{--                        <small><a href="/forgot-password">Mot de passe oublié?</a></small>--}}
                    </div>

                    <hr class="my-4">

                </form>
            </main>
        </div>
    </div>

@endsection
