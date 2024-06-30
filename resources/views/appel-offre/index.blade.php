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
    @vite('resources/css/index-appel-offre.css')
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
            <div class="container">
                <div class="add-appel-offre">
                    <p><a href="{{ route('appel-offre.create') }}">{{ __('Ajouter un nouvel appel d\'offre') }}</a></p>
                </div>
                <h1>{{ __('Appel d\'offre') }}</h1>

                <h2>{{ __('Nouvel Appel d\'offre') }}</h2>
                @if($appelOffreEnTraitements->isEmpty())
                    <p>Aucun appel d'offre en traitement disponible.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Nom entreprise') }}</th>
                                <th>{{ __('Titre du contrat') }}</th>
                                <th>{{ __('Type d\'offre') }}</th>
                                <th>{{ __('Intitulé du poste') }}</th>
                                <th>{{ __('Date Limite') }}</th>
                                <th>{{ __('État') }}</th>
                                <th colspan="2">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appelOffreEnTraitements as $appelOffreEnTraitement)
                                <tr>
                                    <td>{{ $appelOffreEnTraitement->entreprise->nom_etp }}</td>
                                    <td>{{ $appelOffreEnTraitement->nom_contrat }}</td>
                                    <td>{{ $appelOffreEnTraitement->type_offre }}</td>
                                    <td>{{ $appelOffreEnTraitement->intitule_poste }}</td>
                                    <td>{{ $appelOffreEnTraitement->date_limite_candidature }}</td>
                                    <td>{{ $appelOffreEnTraitement->etat_appel_offre }}</td>
                                    <td><a href="#">{{ __('Supprimer') }}</a></td>
                                    <td><a href="{{ route('selection.create', $appelOffreEnTraitement->id) }}">{{ __('Sélection') }}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <h2>{{ __('Appels d\'offres en cours') }}</h2>
                @if($appelOffreEnCours->isEmpty())
                    <p>Aucun appel d'offre disponible.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Nom entreprise') }}</th>
                                <th>{{ __('Titre du contrat') }}</th>
                                <th>{{ __('Type d\'offre') }}</th>
                                <th>{{ __('Intitulé du poste') }}</th>
                                <th>{{ __('Date Limite') }}</th>
                                <th>{{ __('État') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appelOffreEnCours as $appelOffreEnCour)
                                <tr>
                                    <td>{{ $appelOffreEnCour->entreprise->nom_etp }}</td>
                                    <td>{{ $appelOffreEnCour->nom_contrat }}</td>
                                    <td>{{ $appelOffreEnCour->type_offre }}</td>
                                    <td>{{ $appelOffreEnCour->intitule_poste }}</td>
                                    <td>{{ $appelOffreEnCour->date_limite_candidature }}</td>
                                    <td>{{ $appelOffreEnCour->etat_appel_offre }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <h2>{{ __('Appels d\'offres arrivés à la date limite') }}</h2>
                @if($appelOffreExpirers->isEmpty())
                    <p>Aucun appel d'offre disponible.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Nom entreprise') }}</th>
                                <th>{{ __('Titre du contrat') }}</th>
                                <th>{{ __('Type d\'offre') }}</th>
                                <th>{{ __('Intitulé du poste') }}</th>
                                <th>{{ __('Date Limite') }}</th>
                                <th>{{ __('État') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appelOffreExpirers as $appelOffreExpire)
                                <tr>
                                    <td>{{ $appelOffreExpire->entreprise->nom_etp }}</td>
                                    <td>{{ $appelOffreExpire->nom_contrat }}</td>
                                    <td>{{ $appelOffreExpire->type_offre }}</td>
                                    <td>{{ $appelOffreExpire->intitule_poste }}</td>
                                    <td>{{ $appelOffreExpire->date_limite_candidature }}</td>
                                    <td>{{ $appelOffreExpire->etat_appel_offre }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <h2>{{ __('Appels d\'offres en attente de validation de stage') }}</h2>
                @if($appelOffreAttenteVs->isEmpty())
                    <p>Aucun appel d'offre disponible.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Nom entreprise') }}</th>
                                <th>{{ __('Titre du contrat') }}</th>
                                <th>{{ __('Type d\'offre') }}</th>
                                <th>{{ __('Intitulé du poste') }}</th>
                                <th>{{ __('Date Limite') }}</th>
                                <th>{{ __('État') }}</th>
                                <th colspan="2">{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appelOffreAttenteVs as $appelOffreAttenteV)
                                <tr>
                                    <td>{{ $appelOffreAttenteV->entreprise->nom_etp }}</td>
                                    <td>{{ $appelOffreAttenteV->nom_contrat }}</td>
                                    <td>{{ $appelOffreAttenteV->type_offre }}</td>
                                    <td>{{ $appelOffreAttenteV->intitule_poste }}</td>
                                    <td>{{ $appelOffreAttenteV->date_limite_candidature }}</td>
                                    <td>{{ __('En attente de validation') }}</td>
                                    <td><a href="{{ route('selection.create', $appelOffreEnTraitement->id) }}">{{ __('Sélectionner d\'autre etudiants') }}</a></td>
                                    <td><a href="{{ route('stage.create', $appelOffreEnTraitement->id) }}">{{ __('Valider le(s) stage(s)') }}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <x-appel-offre>
                    <!-- Contenu du slot -->
                    <p>Voici un exemple de contenu pour le composant.</p>
                </x-appel-offre>
            </div>
        </main>
    </div>
</body>
</html>
