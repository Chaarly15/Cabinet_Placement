@extends('base-dashboard')

@section('content')
<div class="container">
    <h1>{{ __('Valider les stages des étudiants') }}</h1>

    <form method="POST" action="{{ route('stage.directStore') }}">
        @csrf
        <div class="form-group">
            <label for="etudiantsDirect">{{ __('Étudiants ayant obtenu un stage sans l\'aide du cabinet') }}</label>
            <div id="etudiantsDirect">
                <div class="form-check">
                    <label for="etudiant_direct">{{ __('Sélectionnez un étudiant') }}</label>
                    <select name="etudiant_direct_id" class="form-control">
                        @foreach ($etudiants as $etudiant)
                            <option value="{{ $etudiant->id }}">{{ $etudiant->nom_etude }} {{ $etudiant->prenom_etud }}</option>
                        @endforeach
                    </select>

                    <div class="form-group">
                        <label for="entreprise">{{ __('Entreprise') }}</label>
                        <select name="entreprise_direct_id" class="form-control">
                            <option value="">{{ __('Sélectionnez une entreprise') }}</option>
                            @foreach ($entreprises as $entreprise)
                                <option value="{{ $entreprise->id }}">{{ $entreprise->nom_etp }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="new_entreprise_nom">{{ __('Nom de la nouvelle entreprise') }}</label>
                        <input type="text" name="new_entreprise_nom" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="new_entreprise_directeur">{{ __('Nom du directeur de la nouvelle entreprise') }}</label>
                        <input type="text" name="new_entreprise_directeur" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="new_entreprise_drh">{{ __('Nom du DRH de la nouvelle entreprise') }}</label>
                        <input type="text" name="new_entreprise_drh" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="new_entreprise_adresse">{{ __('Adresse de la nouvelle entreprise') }}</label>
                        <input type="text" name="new_entreprise_adresse" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="new_entreprise_localisation">{{ __('Localisation de la nouvelle entreprise') }}</label>
                        <input type="text" name="new_entreprise_localisation" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="new_entreprise_tel">{{ __('Téléphone de la nouvelle entreprise') }}</label>
                        <input type="text" name="new_entreprise_tel" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="new_entreprise_tel2">{{ __('Téléphone secondaire de la nouvelle entreprise') }}</label>
                        <input type="text" name="new_entreprise_tel2" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="new_entreprise_email">{{ __('Email de la nouvelle entreprise') }}</label>
                        <input type="email" name="new_entreprise_email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="encadreur">{{ __('Encadreur') }}</label>
                        <select name="encadreur" class="form-control">
                            @foreach ($encadreurs as $encadreur)
                                <option value="{{ $encadreur->id }}">{{ $encadreur->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date_debut_direct">{{ __('Date de début') }}</label>
                        <input type="date" name="date_debut_direct" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="date_fin_direct">{{ __('Date de fin') }}</label>
                        <input type="date" name="date_fin_direct" class="form-control" required>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success mt-3">{{ __('Valider les stages') }}</button>
    </form>
</div>
@endsection
