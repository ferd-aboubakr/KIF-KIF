<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace - Kif-Kif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-600 text-white p-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Kif-Kif - Marketplace</h1>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ auth()->user()->hasRole('particulier') ? route('particulier.dashboard') : (auth()->user()->hasRole('entreprise') ? route('entreprise.dashboard') : route('dashboard')) }}" class="hover:underline">
                        {{ auth()->user()->hasRole('particulier') ? 'Dashboard Particulier' : (auth()->user()->hasRole('entreprise') ? 'Dashboard Entreprise' : 'Dashboard') }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm underline">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:underline">Connexion</a>
                    <a href="{{ route('entreprise.login') }}" class="hover:underline">Espace Entreprise</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto p-4">
        <!-- Search and Filters -->
        <div class="bg-white p-4 rounded shadow mb-6">
            <form method="GET" action="{{ route('marketplace.search') }}" class="grid grid-cols-4 gap-4">
                <div>
                    <label class="block text-gray-700 mb-2">Recherche</label>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher une ressource..." class="w-full border p-2 rounded">
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Catégorie</label>
                    <select name="categorie" class="w-full border p-2 rounded">
                        <option value="">Toutes les catégories</option>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}" {{ request('categorie') == $categorie->id ? 'selected' : '' }}>
                                {{ $categorie->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Ville</label>
                    <select name="ville" class="w-full border p-2 rounded">
                        <option value="">Toutes les villes</option>
                        @foreach ($villes as $ville)
                            <option value="{{ $ville }}" {{ request('ville') == $ville ? 'selected' : '' }}>
                                {{ $ville }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Rechercher
                    </button>
                </div>
            </form>
        </div>

        <!-- Resources Grid -->
        @if ($ressources->count() > 0)
            <div class="grid grid-cols-3 gap-6 mb-6">
                @foreach ($ressources as $ressource)
                    <div class="bg-white rounded shadow overflow-hidden hover:shadow-lg transition-shadow">
                        @if ($ressource->photos)
                            <div class="h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">Photo disponible</span>
                            </div>
                        @else
                            <div class="h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">Aucune photo</span>
                            </div>
                        @endif
                        
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-semibold text-lg">{{ $ressource->titre }}</h3>
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">
                                    {{ $ressource->prix_unitaire }} DH
                                </span>
                            </div>
                            
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                {{ $ressource->description }}
                            </p>
                            
                            <div class="flex justify-between items-center text-sm text-gray-500 mb-3">
                                <span>{{ $ressource->quantite }} {{ $ressource->unite }}</span>
                                <span>{{ $ressource->categorie->nom }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-600">Vendeur: {{ $ressource->entreprise->nom }}</p>
                                    <p class="text-xs text-gray-500">{{ $ressource->localisation }}</p>
                                </div>
                                @auth
                                    <a href="{{ route('marketplace.show', $ressource->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                                        Voir détails
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="bg-gray-600 text-white px-4 py-2 rounded text-sm hover:bg-gray-700">
                                        Connecter pour contacter
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="flex justify-center">
                {{ $ressources->links() }}
            </div>
        @else
            <div class="bg-white p-12 rounded shadow text-center">
                <div class="text-gray-500 mb-4">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707 0l-2.414-2.414a1 1 0 00-.707-.293H16"></path>
                    </svg>
                    <h3 class="text-lg font-semibold mb-2">Aucune ressource trouvée</h3>
                    <p class="mb-4">Essayez de modifier vos critères de recherche.</p>
                    <a href="{{ route('marketplace.index') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Réinitialiser la recherche
                    </a>
                </div>
            </div>
        @endif
    </div>
</body>
</html>
