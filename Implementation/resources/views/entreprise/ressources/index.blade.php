<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Annonces - Kif-Kif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-600 text-white p-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Kif-Kif - Mes Annonces</h1>
            <div class="flex items-center gap-4">
                <a href="{{ route('entreprise.dashboard') }}" class="hover:underline">Dashboard</a>
                <form method="POST" action="{{ route('entreprise.logout') }}">
                    @csrf
                    <button type="submit" class="text-sm underline">Déconnexion</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto p-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Toutes mes annonces</h2>
            <a href="{{ route('entreprise.ressources.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                + Nouvelle annonce
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($ressources->count() > 0)
            <div class="bg-white rounded shadow overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left p-3">Titre</th>
                            <th class="text-left p-3">Type</th>
                            <th class="text-left p-3">Quantité</th>
                            <th class="text-left p-3">Prix unitaire</th>
                            <th class="text-left p-3">Statut</th>
                            <th class="text-left p-3">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ressources as $ressource)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="p-3">{{ $ressource->titre }}</td>
                                <td class="p-3">{{ $ressource->type_ressource }}</td>
                                <td class="p-3">{{ $ressource->quantite }} {{ $ressource->unite }}</td>
                                <td class="p-3">{{ $ressource->prix_unitaire }} DH</td>
                                <td class="p-3">
                                    <span class="px-2 py-1 rounded text-sm 
                                        {{ $ressource->statut === 'active' ? 'bg-green-100 text-green-700' : '' }}
                                        {{ $ressource->statut === 'vendue' ? 'bg-blue-100 text-blue-700' : '' }}
                                        {{ $ressource->statut === 'archivee' ? 'bg-gray-100 text-gray-700' : '' }}">
                                        {{ $ressource->statut }}
                                    </span>
                                </td>
                                <td class="p-3 text-sm text-gray-500">{{ $ressource->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $ressources->links() }}
            </div>
        @else
            <div class="bg-white p-8 rounded shadow text-center">
                <p class="text-gray-500 mb-4">Vous n'avez pas encore d'annonces.</p>
                <a href="{{ route('entreprise.ressources.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Créer ma première annonce
                </a>
            </div>
        @endif
    </div>
</body>
</html>
