<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Annonces - Kif-Kif</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Mobile Header -->
    <header class="lg:hidden bg-white shadow-sm sticky top-0 z-50">
        <div class="px-4 py-3 flex items-center justify-between">
            <h1 class="text-xl font-bold text-emerald-600">Kif-Kif Entreprise</h1>
            <button id="mobile-menu-btn" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </header>

    <!-- Desktop Sidebar -->
    <aside class="fixed left-0 top-0 h-full w-64 bg-white shadow-xl z-50 hidden lg:block">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-emerald-600">Kif-Kif</h1>
            <p class="text-xs text-gray-500 uppercase tracking-wider mt-1">Espace Entreprise</p>
        </div>
        <nav class="mt-8 px-4 space-y-2">
            <a href="{{ route('entreprise.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">
                <span class="material-symbols-outlined">dashboard</span>
                Dashboard
            </a>
            <a href="{{ route('entreprise.ressources.index') }}" class="flex items-center gap-3 px-4 py-3 bg-emerald-50 text-emerald-700 rounded-xl font-medium">
                <span class="material-symbols-outlined">inventory_2</span>
                Mes Annonces
            </a>
            <a href="{{ route('entreprise.ressources.create') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">
                <span class="material-symbols-outlined">add_circle</span>
                Nouvelle Annonce
            </a>
            <a href="{{ route('marketplace.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">
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

    <!-- Mobile Sidebar -->
    <aside id="mobile-sidebar" class="fixed left-0 top-0 h-full w-64 bg-white shadow-xl z-50 transform -translate-x-full transition-transform lg:hidden">
        <div class="p-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-emerald-600">Kif-Kif</h1>
            <button id="close-menu-btn" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <p class="text-xs text-gray-500 uppercase tracking-wider px-6 mt-1">Espace Entreprise</p>
        <nav class="mt-8 px-4 space-y-2">
            <a href="{{ route('entreprise.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">
                <span class="material-symbols-outlined">dashboard</span>
                Dashboard
            </a>
            <a href="{{ route('entreprise.ressources.index') }}" class="flex items-center gap-3 px-4 py-3 bg-emerald-50 text-emerald-700 rounded-xl font-medium">
                <span class="material-symbols-outlined">inventory_2</span>
                Mes Annonces
            </a>
            <a href="{{ route('entreprise.ressources.create') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">
                <span class="material-symbols-outlined">add_circle</span>
                Nouvelle Annonce
            </a>
            <a href="{{ route('marketplace.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">
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

    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

    <!-- Main Content -->
    <main class="lg:ml-64 p-4 lg:p-8 pt-16 lg:pt-8">
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-40 hidden lg:block">
            <div class="px-8 py-4 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Mes Annonces</h2>
                    <p class="text-sm text-gray-500">Gérer vos ressources</p>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('entreprise.ressources.create') }}" class="flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-colors font-medium">
                        <span class="material-symbols-outlined">add_circle</span>
                        Nouvelle annonce
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="p-2 hover:bg-red-100 rounded-full transition-colors">
                            <span class="material-symbols-outlined text-red-600">logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Content -->
        <div class="p-4 lg:p-8">
            @if (session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Mobile Add Button -->
            <div class="lg:hidden mb-6">
                <a href="{{ route('entreprise.ressources.create') }}" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-colors font-medium">
                    <span class="material-symbols-outlined">add_circle</span>
                    Nouvelle annonce
                </a>
            </div>

            <!-- Resources List -->
            @if ($ressources->count() > 0)
                <section class="space-y-4">
                    @foreach ($ressources as $ressource)
                        <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-md transition-all">
                            <div class="p-6">
                                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                    <div class="flex-1">
                                        <div class="flex items-start gap-4">
                                            <div class="w-16 h-16 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                                <span class="material-symbols-outlined text-emerald-600 text-2xl">inventory_2</span>
                                            </div>
                                            <div class="flex-1">
                                                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $ressource->titre }}</h3>
                                                <div class="space-y-1">
                                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                                        <span class="material-symbols-outlined text-lg">attach_money</span>
                                                        <span>{{ $ressource->prix_unitaire }} DH</span>
                                                    </div>
                                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                                        <span class="material-symbols-outlined text-lg">location_on</span>
                                                        <span>{{ $ressource->localisation }}</span>
                                                    </div>
                                                    <div class="flex items-center gap-2 text-sm text-gray-600">
                                                        <span class="material-symbols-outlined text-lg">category</span>
                                                        <span>{{ $ressource->category?->nom ?? 'Non spécifiée' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                                        <span class="px-3 py-1 rounded-full text-sm font-medium {{ $ressource->statut === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                            {{ $ressource->statut === 'active' ? 'Active' : 'Inactive' }}
                                        </span>
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('entreprise.ressources.edit', $ressource->id) }}" class="flex items-center gap-1 px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors text-sm font-medium">
                                                <span class="material-symbols-outlined">edit</span>
                                                Modifier
                                            </a>
                                            <form method="POST" action="{{ route('entreprise.ressources.destroy', $ressource->id) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="flex items-center gap-1 px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors text-sm font-medium">
                                                    <span class="material-symbols-outlined">delete</span>
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </section>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    {{ $ressources->links() }}
                </div>
            @else
                <section class="bg-white rounded-2xl shadow-sm p-12 text-center">
                    <span class="material-symbols-outlined text-6xl text-gray-300">inventory_2</span>
                    <h3 class="text-xl font-semibold text-gray-800 mt-4 mb-2">Aucune annonce</h3>
                    <p class="text-gray-500 mb-6">Vous n'avez pas encore publié d'annonces</p>
                    <a href="{{ route('entreprise.ressources.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-colors font-medium">
                        <span class="material-symbols-outlined">add_circle</span>
                        Créer votre première annonce
                    </a>
                </section>
            @endif
        </div>
    </main>

    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const closeMenuBtn = document.getElementById('close-menu-btn');
        const mobileSidebar = document.getElementById('mobile-sidebar');
        const mobileOverlay = document.getElementById('mobile-overlay');

        const toggleSidebar = () => {
            mobileSidebar.classList.toggle('-translate-x-full');
            mobileOverlay.classList.toggle('hidden');
        };

        const closeSidebar = () => {
            mobileSidebar.classList.add('-translate-x-full');
            mobileOverlay.classList.add('hidden');
        };

        mobileMenuBtn?.addEventListener('click', toggleSidebar);
        closeMenuBtn?.addEventListener('click', closeSidebar);
        mobileOverlay?.addEventListener('click', closeSidebar);
    </script>
</body>
</html>
