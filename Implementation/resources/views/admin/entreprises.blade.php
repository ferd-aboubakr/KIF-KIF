<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation Entreprises - Kif-Kif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-red-600 text-white p-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Kif-Kif - Validation Entreprises</h1>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a>
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

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold mb-6">Entreprises en attente de validation</h2>

            @if ($entreprises->count() > 0)
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left p-3">Nom</th>
                            <th class="text-left p-3">ICE</th>
                            <th class="text-left p-3">Secteur d'activité</th>
                            <th class="text-left p-3">Ville</th>
                            <th class="text-left p-3">Email</th>
                            <th class="text-left p-3">Téléphone</th>
                            <th class="text-left p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($entreprises as $entreprise)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="p-3 font-semibold">{{ $entreprise->nom }}</td>
                                <td class="p-3">{{ $entreprise->ice }}</td>
                                <td class="p-3">{{ $entreprise->secteur_activite }}</td>
                                <td class="p-3">{{ $entreprise->ville }}</td>
                                <td class="p-3">{{ $entreprise->email }}</td>
                                <td class="p-3">{{ $entreprise->telephone }}</td>
                                <td class="p-3">
                                    <form method="POST" action="{{ route('admin.entreprises.valider', $entreprise->id) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                            ✓ Valider
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.entreprises.rejeter', $entreprise->id) }}" class="inline ml-2">
                                        @csrf
                                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                            ✗ Rejeter
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $entreprises->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 text-lg mb-4">Aucune entreprise en attente de validation.</p>
                    <a href="{{ route('admin.dashboard') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Retour au Dashboard
                    </a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
