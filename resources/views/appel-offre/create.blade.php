<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @vite('resources/css/index-appel-offre.css')

                <div class="container">
                    <h1>{{ __('Créer un Appel d\'Offre') }}</h1>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('appel-offre.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="entreprise_id">{{ __('Sélectionnez une entreprise') }}</label>
                            <select class="form-control" id="entreprise_id" name="entreprise_id">
                                <option value="">{{ __('-- Nouvelle entreprise --') }}</option>
                                @foreach($entreprises as $entreprise)
                                    <option value="{{ $entreprise->id }}">{{ $entreprise->nom_etp }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="showEntrepriseForm()">{{ __('Ajouter une nouvelle entreprise') }}</button>

                        <!-- Formulaire de création d'entreprise caché par défaut -->
                        <div id="entrepriseForm" style="display:none;">
                            <h2>{{ __('Créer une nouvelle entreprise') }}</h2>
                            <div class="form-group">
                                <label for="nom_etp">{{ __('Nom de l\'entreprise') }}</label>
                                <input type="text" class="form-control" id="nom_etp" name="nom_etp" value="{{ old('nom_etp') }}">
                            </div>
                            <div class="form-group">
                                <label for="nom_directeur_etp">{{ __('Nom du directeur') }}</label>
                                <input type="text" class="form-control" id="nom_directeur_etp" name="nom_directeur_etp" value="{{ old('nom_directeur_etp') }}">
                            </div>
                            <div class="form-group">
                                <label for="nom_drh_etp">{{ __('Nom du DRH') }}</label>
                                <input type="text" class="form-control" id="nom_drh_etp" name="nom_drh_etp" value="{{ old('nom_drh_etp') }}">
                            </div>
                            <div class="form-group">
                                <label for="adress_post_etp">{{ __('Adresse postale') }}</label>
                                <input type="text" class="form-control" id="adress_post_etp" name="adress_post_etp" value="{{ old('adress_post_etp') }}">
                            </div>
                            <div class="form-group">
                                <label for="localisation_etp">{{ __('Localisation') }}</label>
                                <input type="text" class="form-control" id="localisation_etp" name="localisation_etp" value="{{ old('localisation_etp') }}">
                            </div>
                            <div class="form-group">
                                <label for="tel_etp">{{ __('Téléphone') }}</label>
                                <input type="text" class="form-control" id="tel_etp" name="tel_etp" value="{{ old('tel_etp') }}">
                            </div>
                            <div class="form-group">
                                <label for="tel_etp2">{{ __('Téléphone secondaire') }}</label>
                                <input type="text" class="form-control" id="tel_etp2" name="tel_etp2" value="{{ old('tel_etp2') }}">
                            </div>
                            <div class="form-group">
                                <label for="email_etp">{{ __('Email') }}</label>
                                <input type="email" class="form-control" id="email_etp" name="email_etp" value="{{ old('email_etp') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="entreprise_id">{{ __('Nom entreprise') }}</label>
                            <input type="text" class="form-control" id="entreprise_id" name="entreprise_id" value="{{ old('entreprise_id') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="nom_contrat">{{ __('Titre du contrat') }}</label>
                            <input type="text" class="form-control" id="nom_contrat" name="nom_contrat" value="{{ old('nom_contrat') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="type_offre">{{ __('Type d\'offre') }}</label>
                            <select class="form-control" id="type_offre" name="type_offre" value="{{ old('type_offre') }}" required>
                                <option value="stage">{{ __('STAGE') }}</option>
                                <option value="cdd" disabled>{{ __('CDD') }}</option>
                                <option value="cdi" disabled>{{ __('CDI') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="intitule_poste">{{ __('Intitulé du poste') }}</label>
                            <input type="text" class="form-control" id="intitule_poste" name="intitule_poste" value="{{ old('intitule_poste') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="nb_poste">{{ __('Nombre de postes') }}</label>
                            <input type="number" class="form-control" id="nb_poste" name="nb_poste" value="{{ old('nb_poste') }}"><label for="etudiant">{{ __('etudiant(s)') }}</label>
                        </div>
                        <div class="form-group">
                            <label for="detail_mission">{{ __('Détail de la mission') }}</label>
                            <textarea class="form-control" id="detail_mission" name="detail_mission">{{ old('detail_mission') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="age_min">{{ __('Âge minimum') }}</label>
                            <input type="number" class="form-control" id="age_min" name="age_min" value="{{ old('age_min') }}">
                        </div>
                        <div class="form-group">
                            <label for="age_max">{{ __('Âge maximum') }}</label>
                            <input type="number" class="form-control" id="age_max" name="age_max" value="{{ old('age_max') }}">
                        </div>
                        <div class="form-group">
                            <label for="nationalite">{{ __('Nationalité') }}</label>
                            <input type="text" class="form-control" id="nationalite" name="nationalite" value="{{ old('nationalite') }}">
                        </div>
                        <div class="form-group">
                            <label for="2emelangue">{{ __('2ème langue') }}</label>
                            <input type="text" class="form-control" id="2emelangue" name="2emelangue" value="{{ old('2emelangue') }}">
                        </div>
                        <div class="form-group">
                            <label for="debut_mission">{{ __('Début de la mission') }}</label>
                            <input type="date" class="form-control" id="debut_mission" name="debut_mission" value="{{ old('debut_mission') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="fin_mission">{{ __('Fin de la mission') }}</label>
                            <input type="date" class="form-control" id="fin_mission" name="fin_mission" value="{{ old('fin_mission') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="specialite">{{ __('Spécialité') }}</label>
                            <select class="form-control" id="specialite" name="specialite" value="{{ old('specialite') }}" required>
                                <option value="1">{{ __('Administration') }}</option>
                                <option value="2">{{ __('Marketing') }}</option>
                                <option value="3">{{ __('Finance') }}</option>
                                <option value="4">{{ __('Informatique') }}</option>
                                <option value="5">{{ __('Tourisme et Hôtellerie') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="niveau_formation">{{ __('Niveau de formation') }}</label>
                            <input type="number" class="form-control" id="niveau_formation" name="niveau_formation" value="{{ old('niveau_formation') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="nbr_experience_pro">{{ __('Nombre d\'années d\'expérience professionnelle') }}</label>
                            <input type="number" class="form-control" id="nbr_experience_pro" name="nbr_experience_pro" value="{{ old('nbr_experience_pro') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="detail_experience_pro">{{ __('Détail d\'expérience professionnelle') }}</label>
                            <textarea class="form-control" id="detail_experience_pro" name="detail_experience_pro">{{ old('detail_experience_pro') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="detail_competence">{{ __('Détail des compétences') }}</label>
                            <textarea class="form-control" id="detail_competence" name="detail_competence">{{ old('detail_competence') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="renumeration">{{ __('Rémunération') }}</label>
                            <input type="number" class="form-control" id="renumeration" name="renumeration" value="{{ old('renumeration') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="nbr_poste_dispo">{{ __('Nombre de postes disponibles') }}</label>
                            <input type="number" class="form-control" id="nbr_poste_dispo" name="nbr_poste_dispo" value="{{ old('nbr_poste_dispo') }}">
                        </div>
                        <div class="form-group">
                            <label for="lieu_poste">{{ __('Lieu du poste') }}</label>
                            <input type="text" class="form-control" id="lieu_poste" name="lieu_poste" value="{{ old('lieu_poste') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="date_limite_candidature">{{ __('Date limite de candidature') }}</label>
                            <input type="date" class="form-control" id="date_limite_candidature" name="date_limite_candidature" value="{{ old('date_limite_candidature') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Créer') }}</button>
                    </form>
                    <div>
                        <x-appel-offre>
                            <!-- Contenu du slot -->
                            <p>Voici un exemple de contenu pour le composant.</p>
                        </x-appel-offre>
                    </div>
                </div>
            </main>
        </div>
        <script>
            function showEntrepriseForm() {
                var form = document.getElementById('entrepriseForm');
                form.style.display = form.style.display === 'none' ? 'block' : 'none';
            }

            document.getElementById('appelOffreForm').addEventListener('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                fetch('{{ route("appel-offre.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    var messages = document.getElementById('messages');
                    messages.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                    this.reset();
                })
                .catch(error => {
                    console.error('Error:', error);
                    var messages = document.getElementById('messages');
                    messages.innerHTML = `<div class="alert alert-danger">Erreur lors de la création de l'appel d'offre.</div>`;
                });
            });
        </script>
    </body>
</html>
