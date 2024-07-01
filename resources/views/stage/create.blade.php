@extends('base-dashboard')

@section('content')
<div class="container">
    <h1>{{ __('Valider les stages pour l\'appel d\'offre: ') }} {{ $appelOffre->nom_contrat }}</h1>

    <form method="POST" action="{{ route('stage.store') }}">
        @csrf
        <input type="hidden" name="appel_offre_id" value="{{ $appelOffre->id }}">

        <div class="form-group">
            <label for="etudiantsList">{{ __('Étudiants sélectionnés') }}</label>
            <div id="etudiantsList">
                @foreach($selections as $index => $selection)
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="etudiant_ids[]" value="{{ $selection->etudiant->id }}">
                        <label class="form-check-label">{{ $selection->etudiant->nom_etude }} {{ $selection->etudiant->prenom_etud }} - {{ $selection->etudiant->filiere_etud }}</label>

                        <div class="form-group">
                            <label for="encadreur">{{ __('Encadreur') }}</label>
                            <select name="encadreur_ids[]" class="form-control">
                                @foreach ($encadreurs as $encadreur)
                                    <option value="{{ $encadreur->id }}">{{ $encadreur->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="date_debut">{{ __('Date de début') }}</label>
                            <input type="date" name="date_debut[]" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="date_fin">{{ __('Date de fin') }}</label>
                            <input type="date" name="date_fin[]" class="form-control" required>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-success mt-3">{{ __('Valider les stages') }}</button>
    </form>
</div>
@endsection
