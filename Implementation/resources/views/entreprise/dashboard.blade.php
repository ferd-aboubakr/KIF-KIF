<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ $entreprise->nom }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-600 text-white p-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Kif-Kif - Espace Entreprise</h1>
            <div class="flex items-center gap-4">
                <span>{{ $entreprise->nom }}</span>
                <span class="px-2 py-1 rounded text-sm {{ $entreprise->statut_validation === 'validee' ? 'bg-green-500' : 'bg-yellow-500' }}">
                    {{ $entreprise->statut_validation }}
                </span>
                <form method="POST" action="{{ route('entreprise.logout') }}">
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
        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-gray-600 text-sm">Annonces actives</h3>
                <p class="text-3xl font-bold text-blue-600">{{ $stats['annonces_actives'] }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-gray-600 text-sm">Total annonces</h3>
                <p class="text-3xl font-bold text-green-600">{{ $stats['total_annonces'] }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-gray-600 text-sm">Transactions</h3>
                <p class="text-3xl font-bold text-purple-600">{{ $stats['transactions'] }}</p>
            </div>
        </div>

        <div class="bg-white p-4 rounded shadow mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Mes Annonces Récentes</h2>
                <a href="{{ route('entreprise.ressources.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    + Nouvelle annonce
                </a>
            </div>

            @if ($annonces->count() > 0)
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left p-3">Titre</th>
                            <th class="text-left p-3">Type</th>
                            <th class="text-left p-3">Prix</th>
                            <th class="text-left p-3">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($annonces as $annonce)
                            <tr class="border-t">
                                <td class="p-3">{{ $annonce->titre }}</td>
                                <td class="p-3">{{ $annonce->type_ressource }}</td>
                                <td class="p-3">{{ $annonce->prix_unitaire }} DH</td>
                                <td class="p-3">
                                    <span class="px-2 py-1 rounded text-sm {{ $annonce->statut === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                        {{ $annonce->statut }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4 text-right">
                    <a href="{{ route('entreprise.ressources.index') }}" class="text-blue-600 hover:underline">
                        Voir toutes les annonces →
                    </a>
                </div>
            @else
                <p class="text-gray-500 text-center py-8">
                    Aucune annonce pour le moment. 
                    <a href="{{ route('entreprise.ressources.create') }}" class="text-blue-600">Créer une annonce</a>
                </p>
            @endif
        </div>
    </div>
</body>
</html>
