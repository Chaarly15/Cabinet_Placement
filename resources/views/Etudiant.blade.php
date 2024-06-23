<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
    
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <!-- Ajoutez d'autres colonnes selon les données disponibles -->
            </tr>
        </thead>
        <tbody>
            @foreach ($etudiants as $etudiant)
                <tr>
                    <td>{{ $etudiant->nom }}</td>
                    <td>{{ $etudiant->prenom }}</td>
                    <!-- Affichez d'autres informations de l'étudiant ici -->
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

