@extends('base-dashboard')

@section('content')
<div class="container">
    <h1>{{ __('Créer un Professeur Encadreur') }}</h1>

    <form method="POST" action="{{ route('professeurs.store') }}">
        @csrf

        <div class="form-group">
            <label for="nom">{{ __('Nom') }}</label>
            <input type="text" name="nom" class="form-control" id="nom" required>
        </div>

        <div class="form-group">
            <label for="prenom">{{ __('Prénom') }}</label>
            <input type="text" name="prenom" class="form-control" id="prenom" required>
        </div>

        <div class="form-group">
            <label for="tel_prof">{{ __('Téléphone') }}</label>
            <input type="text" name="tel_prof" class="form-control" id="tel_prof" required>
        </div>

        <div class="form-group">
            <label for="adress_prof">{{ __('Adresse') }}</label>
            <input type="text" name="adress_prof" class="form-control" id="adress_prof" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Créer') }}</button>
    </form>
</div>
@endsection
