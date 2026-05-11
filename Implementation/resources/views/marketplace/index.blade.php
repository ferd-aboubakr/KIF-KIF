<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace - Kif-Kif</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen lg:ml-64">
    @auth
        <!-- Admin Sidebar -->
        @if(auth()->user()->hasRole('admin'))
            <aside class="fixed left-0 top-0 h-full w-64 bg-white shadow-xl z-50 hidden lg:block">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-emerald-600">Kif-Kif</h1>
                    <p class="text-xs text-gray-500 uppercase tracking-wider mt-1">Admin Portal</p>
                </div>
                <nav class="mt-8 px-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-emerald-50 text-emerald-700 rounded-xl font-medium">
                        <span class="material-symbols-outlined">dashboard</span>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.entreprises') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">
                        <span class="material-symbols-outlined">business</span>
                        Entreprises
                    </a>
                    <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">
                        <span class="material-symbols-outlined">person</span>
                        Profile
                    </a>
                </nav>
                <div class="absolute bottom-0 left-0 right-0 p-4 border-t">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition-colors">
                            <span class="material-symbols-outlined">logout</span>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </aside>
        @endif

        <!-- Entreprise Sidebar -->
        @if(auth()->user()->hasRole('entreprise'))
            <aside class="fixed left-0 top-0 h-full w-64 bg-white shadow-xl z-50 hidden lg:block">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-emerald-600">Kif-Kif</h1>
                    <p class="text-xs text-gray-500 uppercase tracking-wider mt-1">Espace Entreprise</p>
                </div>
                <nav class="mt-8 px-4 space-y-2">
                    <a href="{{ route('entreprise.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-emerald-50 text-emerald-700 rounded-xl font-medium">
                        <span class="material-symbols-outlined">dashboard</span>
                        Dashboard
                    </a>
                    <a href="{{ route('entreprise.ressources.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">
                        <span class="material-symbols-outlined">inventory_2</span>
                        Mes Annonces
                    </a>
                    <a href="{{ route('entreprise.ressources.create') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">
                        <span class="material-symbols-outlined">add_circle</span>
                        Nouvelle Annonce
                    </a>
                    <a href="{{ route('marketplace.index') }}" class="flex items-center gap-3 px-4 py-3 bg-emerald-50 text-emerald-700 rounded-xl font-medium">
                        <span class="material-symbols-outlined">storefront</span>
                        Marketplace
                    </a>
                </nav>
                <div class="absolute bottom-0 left-0 right-0 p-4 border-t">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition-colors">
                            <span class="material-symbols-outlined">logout</span>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </aside>
        @endif

        <!-- Particulier Sidebar -->
        @if(auth()->user()->hasRole('particulier'))
            <aside class="fixed left-0 top-0 h-full w-64 bg-white shadow-xl z-50 hidden lg:block">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-emerald-600">Kif-Kif</h1>
                    <p class="text-xs text-gray-500 uppercase tracking-wider mt-1">Espace Particulier</p>
                </div>
                <nav class="mt-8 px-4 space-y-2">
                    <a href="{{ route('particulier.profile') }}" class="flex items-center gap-3 px-4 py-3 bg-emerald-50 text-emerald-700 rounded-xl font-medium">
                        <span class="material-symbols-outlined">person</span>
                        Mon Profil
                    </a>
                    <a href="{{ route('marketplace.index') }}" class="flex items-center gap-3 px-4 py-3 bg-emerald-50 text-emerald-700 rounded-xl font-medium">
                        <span class="material-symbols-outlined">storefront</span>
                        Marketplace
                    </a>
                </nav>
                <div class="absolute bottom-0 left-0 right-0 p-4 border-t">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition-colors">
                            <span class="material-symbols-outlined">logout</span>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </aside>
        @endif
    @else
        <!-- Guest Sidebar -->
        <aside class="fixed left-0 top-0 h-full w-64 bg-white shadow-xl z-50 hidden lg:block">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-emerald-600">Kif-Kif</h1>
                <p class="text-xs text-gray-500 uppercase tracking-wider mt-1">Marketplace</p>
            </div>
            <nav class="mt-8 px-4 space-y-2">
                <a href="{{ route('login') }}" class="flex items-center gap-3 px-4 py-3 bg-emerald-50 text-emerald-700 rounded-xl font-medium">
                    <span class="material-symbols-outlined">login</span>
                    Se Connecter
                </a>
                <a href="{{ route('register') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">
                    <span class="material-symbols-outlined">person_add</span>
                    S'inscrire
                </a>
            </nav>
        </aside>
    @endauth

    <!-- Main Content -->
    <main class="p-4 lg:p-8 pt-16 lg:pt-8">
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-40 hidden lg:block">
            <div class="px-8 py-4 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Marketplace</h2>
                    <p class="text-sm text-gray-500">Découvrez les ressources disponibles dans votre région</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-emerald-600">storefront</span>
                    </div>
                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="p-2 hover:bg-red-100 rounded-full transition-colors">
                                <span class="material-symbols-outlined text-red-600">logout</span>
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </header>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search Section -->
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
            <form action="{{ route('marketplace.search') }}" method="GET" class="flex gap-4">
                <div class="flex-1 relative">
                    <input type="text" name="search" placeholder="Rechercher une ressource..." value="{{ request('search') }}" class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">search</span>
                </div>
                <button type="submit" class="px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-colors font-medium">
                    Rechercher
                </button>
            </form>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Filtrer par catégorie</h3>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('marketplace.index') }}" class="px-4 py-2 bg-emerald-100 text-emerald-700 rounded-lg hover:bg-emerald-200 transition-colors">
                    Toutes
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('marketplace.index', ['category' => $category->id]) }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors {{ request('category') == $category->id ? 'ring-2 ring-emerald-500' : '' }}">
                        {{ $category->nom }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Resources Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if($resources->count() > 0)
                @foreach($resources as $resource)
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition-all">
                        @if($resource->image)
                            <div class="h-48 bg-gray-200 relative">
                                <img src="{{ asset($resource->image) }}" alt="{{ $resource->titre }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-800 mb-2">{{ $resource->titre }}</h4>
                                    <p class="text-sm text-gray-500">{{ $resource->categorie->nom }}</p>
                                </div>
                                @auth
                                    @if(auth()->user()->hasRole('entreprise') && auth()->user()->entreprise->id == $resource->entreprise_id)
                                        <a href="{{ route('entreprise.ressources.edit', $resource->id) }}" class="px-3 py-1 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors text-sm">
                                            Modifier
                                        </a>
                                    @endif
                                @endauth
                            </div>
                            <p class="text-gray-600 mb-4">{{ Str::limit($resource->description, 100) }}</p>
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-500">
                                    <span class="material-symbols-outlined">location_on</span>
                                    {{ $resource->localisation }}
                                </div>
                                <div class="text-sm text-emerald-600 font-semibold">
                                    @if($resource->prix)
                                        {{ number_format($resource->prix, 0, ',', ' ') }} €
                                    @else
                                        Gratuit
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-500">
                        <span class="material-symbols-outlined text-4xl">search_off</span>
                        <p class="mt-2">Aucune ressource trouvée pour cette recherche</p>
                    </div>
                </div>
            @endif
        </div>
    </main>
</body>
</html>
