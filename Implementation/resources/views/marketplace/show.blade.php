<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $ressource->titre }} - Kif-Kif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-600 text-white p-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Kif-Kif - {{ $ressource->titre }}</h1>
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

    <div class="max-w-4xl mx-auto p-4">
        <div class="bg-white rounded shadow overflow-hidden">
            <!-- Photos -->
            @if ($ressource->photos)
                <div class="h-96 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500">Photo disponible</span>
                </div>
            @else
                <div class="h-96 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500">Aucune photo</span>
                </div>
            @endif

            <div class="p-6">
                <!-- Header -->
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">{{ $ressource->titre }}</h2>
                        <span class="bg-green-100 text-green-800 px-3 py-2 rounded text-lg font-semibold">
                            {{ $ressource->prix_unitaire }} DH / {{ $ressource->unite }}
                        </span>
                    </div>
                    <div class="text-right">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded text-sm">
                            {{ $ressource->categorie->nom }}
                        </span>
                        <p class="text-gray-500 mt-2">{{ $ressource->localisation }}</p>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-3">Description</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $ressource->description }}</p>
                </div>

                <!-- Details -->
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="bg-gray-50 p-4 rounded">
                        <h4 class="font-semibold text-gray-800 mb-2">Quantité</h4>
                        <p class="text-2xl font-bold text-blue-600">{{ $ressource->quantite }} {{ $ressource->unite }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded">
                        <h4 class="font-semibold text-gray-800 mb-2">Type</h4>
                        <p class="text-lg">{{ $ressource->type_ressource }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded">
                        <h4 class="font-semibold text-gray-800 mb-2">État</h4>
                        <p class="text-lg">{{ $ressource->etat }}</p>
                    </div>
                </div>

                <!-- Seller Info -->
                <div class="bg-blue-50 p-6 rounded">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-semibold mb-3">Informations du vendeur</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">Entreprise</p>
                                    <p class="font-medium">{{ $ressource->entreprise->nom }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Secteur</p>
                                    <p class="font-medium">{{ $ressource->entreprise->secteur_activite }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Ville</p>
                                    <p class="font-medium">{{ $ressource->entreprise->ville }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Email</p>
                                    <p class="font-medium">{{ $ressource->entreprise->email }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Contact Actions -->
                        @auth
                            @if (auth()->user()->hasRole('particulier') || auth()->user()->hasRole('entreprise'))
                                <div class="text-right">
                                    <button class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700">
                                        Contacter le vendeur
                                    </button>
                                </div>
                            @endif
                        @else
                            <div class="text-right">
                                <a href="{{ route('login') }}" class="bg-gray-600 text-white px-6 py-3 rounded hover:bg-gray-700">
                                    Connectez-vous pour contacter
                                </a>
                                <a href="{{ route('entreprise.login') }}" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 ml-2">
                                    Espace Entreprise
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>

                <!-- Back Button -->
                <div class="mt-6">
                    <a href="{{ route('marketplace.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                        ← Retour à la marketplace
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
