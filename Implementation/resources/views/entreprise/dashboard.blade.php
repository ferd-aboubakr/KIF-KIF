<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ $entreprise->nom }}</title>
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
                    <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
                    <p class="text-sm text-gray-500">{{ $entreprise->nom }}</p>
                </div>
                <div class="flex items-center gap-4">
                    <span class="px-3 py-1 rounded-full text-sm font-medium {{ $entreprise->statut_validation === 'validee' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                        {{ $entreprise->statut_validation === 'validee' ? 'Validée' : 'En attente' }}
                    </span>
                    <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-emerald-600">business</span>
                    </div>
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

            <!-- Stats Grid -->
            <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-blue-600">campaign</span>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['annonces_actives'] }}</p>
                    <p class="text-sm text-gray-500 mt-1">Annonces actives</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-green-600">inventory</span>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['total_annonces'] }}</p>
                    <p class="text-sm text-gray-500 mt-1">Total annonces</p>
                </div>

            </section>

            <!-- Recent Ads -->
            <section class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <div class="p-6 border-b flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">Annonces récentes</h3>
                    <a href="{{ route('entreprise.ressources.index') }}" class="text-emerald-600 hover:text-emerald-700 font-medium text-sm">
                        Voir tout
                    </a>
                </div>
                <div class="p-6">
                    @if(isset($recent_ressources) && $recent_ressources->count() > 0)
                        <div class="space-y-4">
                            @foreach($recent_ressources->take(5) as $ressource)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                            <span class="material-symbols-outlined text-emerald-600">inventory_2</span>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-800">{{ $ressource->titre }}</h4>
                                            <p class="text-sm text-gray-500">{{ $ressource->prix_unitaire }} DH • {{ $ressource->localisation }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ $ressource->statut === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                            {{ $ressource->statut === 'active' ? 'Active' : 'Inactive' }}
                                        </span>
                                        <a href="{{ route('entreprise.ressources.edit', $ressource->id) }}" class="text-emerald-600 hover:text-emerald-700">
                                            <span class="material-symbols-outlined">edit</span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <span class="material-symbols-outlined text-4xl text-gray-300">inventory_2</span>
                            <p class="text-gray-500 mt-2">Aucune annonce récente</p>
                            <a href="{{ route('entreprise.ressources.create') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-colors font-medium">
                                <span class="material-symbols-outlined">add_circle</span>
                                Créer une annonce
                            </a>
                        </div>
                    @endif
                </div>
            </section>

            <!-- Quick Actions -->
            <section class="mt-8 bg-white rounded-2xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Actions rapides</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('entreprise.ressources.create') }}" class="flex items-center gap-3 p-4 bg-emerald-50 rounded-xl hover:bg-emerald-100 transition-colors">
                        <span class="material-symbols-outlined text-emerald-600 text-2xl">add_circle</span>
                        <div>
                            <p class="font-medium text-gray-800">Nouvelle annonce</p>
                            <p class="text-sm text-gray-600">Ajouter une nouvelle ressource</p>
                        </div>
                    </a>

                    <a href="{{ route('entreprise.ressources.index') }}" class="flex items-center gap-3 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition-colors">
                        <span class="material-symbols-outlined text-blue-600 text-2xl">inventory_2</span>
                        <div>
                            <p class="font-medium text-gray-800">Mes annonces</p>
                            <p class="text-sm text-gray-600">Gérer mes ressources</p>
                        </div>
                    </a>
                </div>
            </section>
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
