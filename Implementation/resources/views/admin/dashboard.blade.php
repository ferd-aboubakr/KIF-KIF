<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Kif-Kif</title>
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
            <h1 class="text-xl font-bold text-emerald-600">Kif-Kif Admin</h1>
            <button id="mobile-menu-btn" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </header>

    <!-- Desktop Sidebar -->
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
            <a href="{{ route('marketplace.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">
                <span class="material-symbols-outlined">storefront</span>
                Marketplace
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

    <!-- Mobile Sidebar -->
    <aside id="mobile-sidebar" class="fixed left-0 top-0 h-full w-64 bg-white shadow-xl z-50 transform -translate-x-full transition-transform lg:hidden">
        <div class="p-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-emerald-600">Kif-Kif</h1>
            <button id="close-menu-btn" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <p class="text-xs text-gray-500 uppercase tracking-wider px-6 mt-1">Admin Portal</p>
        <nav class="mt-8 px-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-emerald-50 text-emerald-700 rounded-xl font-medium">
                <span class="material-symbols-outlined">dashboard</span>
                Dashboard
            </a>
            <a href="{{ route('admin.entreprises') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">
                <span class="material-symbols-outlined">business</span>
                Entreprises
            </a>
            <a href="{{ route('marketplace.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">
                <span class="material-symbols-outlined">storefront</span>
                Marketplace
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

    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

    <!-- Main Content -->
    <main class="lg:ml-64 p-4 lg:p-8 pt-16 lg:pt-8">
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-40 hidden lg:block">
            <div class="px-8 py-4 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Tableau de bord</h2>
                    <p class="text-sm text-gray-500">Vue d'ensemble du système</p>
                </div>
                <div class="flex items-center gap-4">
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
        <main class="p-4 lg:p-8">
            <!-- Stats Grid -->
            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-emerald-100 rounded-xl">
                            <span class="material-symbols-outlined text-emerald-600 text-2xl">business</span>
                        </div>
                        <span class="text-sm text-gray-500">+12%</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $entreprises_count ?? 0 }}</h3>
                    <p class="text-gray-600 text-sm">Entreprises</p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-blue-100 rounded-xl">
                            <span class="material-symbols-outlined text-blue-600 text-2xl">person</span>
                        </div>
                        <span class="text-sm text-gray-500">+8%</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $particuliers_count ?? 0 }}</h3>
                    <p class="text-gray-600 text-sm">Particuliers</p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-purple-100 rounded-xl">
                            <span class="material-symbols-outlined text-purple-600 text-2xl">storefront</span>
                        </div>
                        <span class="text-sm text-gray-500">+25%</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $ressources_count ?? 0 }}</h3>
                    <p class="text-gray-600 text-sm">Ressources</p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-lg transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-orange-100 rounded-xl">
                            <span class="material-symbols-outlined text-orange-600 text-2xl">category</span>
                        </div>
                        <span class="text-sm text-gray-500">+5%</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $categories_count ?? 0 }}</h3>
                    <p class="text-gray-600 text-sm">Catégories</p>
                </div>
            </section>

            <!-- Recent Activity -->
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Entreprises récentes</h2>
                    <div class="space-y-4">
                        @if(isset($recent_entreprises) && $recent_entreprises->count() > 0)
                            @foreach($recent_entreprises->take(5) as $entreprise)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                                            <span class="material-symbols-outlined text-emerald-600">business</span>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $entreprise->nom }}</p>
                                            <p class="text-sm text-gray-500">{{ $entreprise->created_at->format('d/m/Y') }}</p>
                                        </div>
                                    </div>
                                    <span class="material-symbols-outlined text-gray-400">arrow_forward</span>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8">
                                <span class="material-symbols-outlined text-4xl text-gray-300">business</span>
                                <p class="text-gray-500 mt-2">Aucune entreprise récente</p>
                            </div>
                        @endif
                    </div>
                    @if(isset($recent_entreprises) && $recent_entreprises->count() > 0)
                        <div class="mt-4">
                            <a href="{{ route('admin.entreprises') }}" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition-colors font-medium">
                                Voir toutes les entreprises
                            </a>
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Ressources récentes</h2>
                    <div class="space-y-4">
                        @if(isset($recent_ressources) && $recent_ressources->count() > 0)
                            @foreach($recent_ressources->take(5) as $ressource)
                                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                            <span class="material-symbols-outlined text-purple-600">storefront</span>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $ressource->titre }}</p>
                                            <p class="text-sm text-gray-500">{{ $ressource->created_at->format('d/m/Y') }}</p>
                                        </div>
                                    </div>
                                    <span class="material-symbols-outlined text-gray-400">arrow_forward</span>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8">
                                <span class="material-symbols-outlined text-4xl text-gray-300">storefront</span>
                                <p class="text-gray-500 mt-2">Aucune ressource récente</p>
                            </div>
                        @endif
                    </div>
                    @if(isset($recent_ressources) && $recent_ressources->count() > 0)
                        <div class="mt-4">
                            <a href="{{ route('marketplace.index') }}" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition-colors font-medium">
                                Voir toutes les ressources
                            </a>
                        </div>
                    @endif
                </div>
            </section>

            <!-- Quick Actions -->
            <section class="bg-white rounded-2xl shadow-sm p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Actions rapides</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('admin.entreprises') }}" class="flex items-center gap-3 p-4 bg-emerald-50 rounded-xl hover:bg-emerald-100 transition-colors">
                        <span class="material-symbols-outlined text-emerald-600 text-2xl">business</span>
                        <div>
                            <p class="font-medium text-gray-800">Gérer les entreprises</p>
                            <p class="text-sm text-gray-600">Valider et gérer les comptes</p>
                        </div>
                    </a>

                    <a href="{{ route('marketplace.index') }}" class="flex items-center gap-3 p-4 bg-purple-50 rounded-xl hover:bg-purple-100 transition-colors">
                        <span class="material-symbols-outlined text-purple-600 text-2xl">storefront</span>
                        <div>
                            <p class="font-medium text-gray-800">Voir la marketplace</p>
                            <p class="text-sm text-gray-600">Explorer les ressources</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.profile') }}" class="flex items-center gap-3 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition-colors">
                        <span class="material-symbols-outlined text-blue-600 text-2xl">person</span>
                        <div>
                            <p class="font-medium text-gray-800">Mon profil</p>
                            <p class="text-sm text-gray-600">Gérer mes informations</p>
                        </div>
                    </a>
                </div>
            </section>
        </main>
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
