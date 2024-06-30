@extends('base-dashboard')

@section('content')
<div class="container">
    <h1>{{ __('Sélection pour l\'appel d\'offre: ') }} {{ $appelOffre->nom_contrat }}</h1>

    <form method="POST" action="{{ route('selection.store') }}">
        @csrf
        <input type="hidden" name="appel_offre_id" value="{{ $appelOffre->id }}">

        <div class="form-group">
            <label for="filiere">{{ __('Filière') }}</label>
            <select id="filiere" name="filiere" class="form-control">
                <option value="">{{ __('Toutes les filières') }}</option>
                @foreach($categoriefiliaires as $categoriefiliaire) <!-- correction ici -->
                    <option value="{{ $categoriefiliaire->id }}">{{ $categoriefiliaire->nom_categori_fil }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="ville">{{ __('Ville') }}</label>
            <select id="ville" name="ville" class="form-control">
                <option value="">{{ __('Toutes les villes') }}</option>
                @foreach($etudiants->pluck('ville_etud')->unique() as $ville)
                    <option value="{{ $ville }}">{{ $ville }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="commune">{{ __('Commune') }}</label>
            <select id="commune" name="commune" class="form-control">
                <option value="">{{ __('Toutes les communes') }}</option>
                @foreach($etudiants->pluck('commune_etud')->unique() as $commune)
                    <option value="{{ $commune }}">{{ $commune }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="age">{{ __('Âge') }}</label>
            <input type="number" id="age" name="age" class="form-control" placeholder="{{ __('Tous les âges') }}">
        </div>

        <div class="form-group">
            <label for="niveau_formation">{{ __('Niveau de formation') }}</label>
            <select id="niveau_formation" name="niveau_formation" class="form-control">
                <option value="">{{ __('Tous les niveaux de formation') }}</option>
                @foreach($etudiants->pluck('niveau_formation_etud')->unique() as $niveau)
                    <option value="{{ $niveau }}">{{ $niveau }}</option>
                @endforeach
            </select>
        </div>

        <button type="button" class="btn btn-primary" id="filterButton">{{ __('Afficher') }}</button>
        <button type="button" class="btn btn-secondary" id="bestMatchButton">{{ __('Afficher les meilleures options') }}</button>

        <div id="etudiantsList" class="mt-4">
            @foreach($etudiants as $etudiant)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="etudiant_ids[]" value="{{ $etudiant->id }}">
                    <label class="form-check-label">{{ $etudiant->nom_etude }} {{ $etudiant->prenom_etud }} - {{ $etudiant->filiere_etud }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success mt-3">{{ __('Valider') }}</button>
    </form>
</div>

<script>
document.getElementById('filterButton').addEventListener('click', function() {
    var filiere = document.getElementById('filiere').value;
    var ville = document.getElementById('ville').value;
    var commune = document.getElementById('commune').value;
    var age = document.getElementById('age').value;
    var niveau_formation = document.getElementById('niveau_formation').value;

    fetch(`{{ route('selection.filter') }}?filiere=${filiere}&ville=${ville}&commune=${commune}&age=${age}&niveau_formation=${niveau_formation}`)
        .then(response => response.json())
        .then(data => {
            var etudiantsList = document.getElementById('etudiantsList');
            etudiantsList.innerHTML = '';

            data.forEach(etudiant => {
                var checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.className = 'form-check-input';
                checkbox.name = 'etudiant_ids[]';
                checkbox.value = etudiant.id;

                var label = document.createElement('label');
                label.className = 'form-check-label';
                label.innerText = `${etudiant.nom_etude} ${etudiant.prenom_etud} - ${etudiant.filiere_etud}`;

                var div = document.createElement('div');
                div.className = 'form-check';
                div.appendChild(checkbox);
                div.appendChild(label);

                etudiantsList.appendChild(div);
            });
        });
});

document.getElementById('bestMatchButton').addEventListener('click', function() {
    fetch(`{{ route('selection.best_match', $appelOffre->id) }}`)
        .then(response => response.json())
        .then(data => {
            var etudiantsList = document.getElementById('etudiantsList');
            etudiantsList.innerHTML = '';

            data.forEach(etudiant => {
                var checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.className = 'form-check-input';
                checkbox.name = 'etudiant_ids[]';
                checkbox.value = etudiant.id;

                var label = document.createElement('label');
                label.className = 'form-check-label';
                label.innerText = `${etudiant.nom_etude} ${etudiant.prenom_etud} - ${etudiant.filiere_etud}`;

                var div = document.createElement('div');
                div.className = 'form-check';
                div.appendChild(checkbox);
                div.appendChild(label);

                etudiantsList.appendChild(div);
            });
        });
});
</script>
@endsection
