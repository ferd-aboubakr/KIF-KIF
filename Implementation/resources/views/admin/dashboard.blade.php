<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Kif-Kif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-red-600 text-white p-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Kif-Kif - Administration</h1>
            <div class="flex items-center gap-4">
                <span>Admin</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm underline">Déconnexion</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto p-4">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-gray-600 text-sm">Entreprises Total</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $stats['entreprises_total'] }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-gray-600 text-sm">En Attente</h3>
                <p class="text-3xl font-bold text-yellow-600">{{ $stats['entreprises_en_attente'] }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-gray-600 text-sm">Validées</h3>
                <p class="text-3xl font-bold text-green-600">{{ $stats['entreprises_validees'] }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-gray-600 text-sm">Utilisateurs</h3>
                <p class="text-3xl font-bold text-purple-600">{{ $stats['utilisateurs_total'] }}</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded shadow mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Entreprises en attente de validation</h2>
                <a href="{{ route('admin.entreprises') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Voir toutes
                </a>
            </div>

            @if ($entreprises_en_attente->count() > 0)
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left p-3">Nom</th>
                            <th class="text-left p-3">ICE</th>
                            <th class="text-left p-3">Secteur</th>
                            <th class="text-left p-3">Ville</th>
                            <th class="text-left p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($entreprises_en_attente as $entreprise)
                            <tr class="border-t">
                                <td class="p-3">{{ $entreprise->nom }}</td>
                                <td class="p-3">{{ $entreprise->ice }}</td>
                                <td class="p-3">{{ $entreprise->secteur_activite }}</td>
                                <td class="p-3">{{ $entreprise->ville }}</td>
                                <td class="p-3">
                                    <form method="POST" action="{{ route('admin.entreprises.valider', $entreprise->id) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">
                                            Valider
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.entreprises.rejeter', $entreprise->id) }}" class="inline ml-2">
                                        @csrf
                                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
                                            Rejeter
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500 text-center py-8">
                    Aucune entreprise en attente de validation.
                </p>
            @endif
        </div>
    </div>
</body>
</html>
