<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Particulier - Kif-Kif</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen lg:ml-64">
    <!-- Mobile Header -->
    <header class="lg:hidden bg-white shadow-sm sticky top-0 z-50">
        <div class="px-4 py-3 flex items-center justify-between">
            <h1 class="text-xl font-bold text-emerald-600">Kif-Kif Particulier</h1>
            <button id="mobile-menu-btn" class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </header>

    <!-- Desktop Sidebar -->
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
    <main class="p-4 lg:p-8 pt-16 lg:pt-8">
        <!-- Header -->
        <header class="bg-white shadow-sm sticky top-0 z-40 hidden lg:block">
            <div class="px-8 py-4 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
                    <p class="text-sm text-gray-500">Bienvenue, {{ $particulier->nom }} {{ $particulier->prenom }}</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-emerald-600">person</span>
                    </div>
                </div>
            </div>
        </header>
            @if (session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-2xl p-8 mb-8 text-white">
                <h3 class="text-2xl font-bold mb-2">Bienvenue sur votre espace personnel !</h3>
                <p class="text-emerald-100">Accédez à votre profil, parcourez les ressources disponibles et gérez vos préférences.</p>
            </div>

            <!-- Action Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <a href="{{ route('marketplace.index') }}" class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-blue-600">explore</span>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Explorer</h4>
                    <p class="text-sm text-gray-500">Parcourez les annonces de ressources disponibles</p>
                </a>

                <a href="{{ route('particulier.profile') }}" class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-emerald-600">account_circle</span>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Mon Profil</h4>
                    <p class="text-sm text-gray-500">Gérez vos informations personnelles</p>
                </a>

                <a href="{{ route('marketplace.index') }}" class="bg-white p-6 rounded-2xl shadow-sm hover:shadow-md transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-purple-600">contact_mail</span>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">Contact</h4>
                    <p class="text-sm text-gray-500">Contactez les vendeurs directement</p>
                </a>
            </div>

            <!-- User Info -->
            <div class="bg-white rounded-2xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Mes Informations</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Nom</p>
                        <p class="font-medium text-gray-800">{{ $particulier->nom }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Prénom</p>
                        <p class="font-medium text-gray-800">{{ $particulier->prenom }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Ville</p>
                        <p class="font-medium text-gray-800">{{ $particulier->ville }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Téléphone</p>
                        <p class="font-medium text-gray-800">{{ $particulier->telephone }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Email</p>
                        <p class="font-medium text-gray-800">{{ $particulier->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Membre depuis</p>
                        <p class="font-medium text-gray-800">{{ $particulier->date_inscription->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        </main>

    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const closeMenuBtn = document.getElementById('close-menu-btn');
        const mobileSidebar = document.getElementById('mobile-sidebar');
        const mobileOverlay = document.getElementById('mobile-overlay');

        function openMenu() {
            mobileSidebar.classList.remove('-translate-x-full');
            mobileOverlay.classList.remove('hidden');
        }

        function closeMenu() {
            mobileSidebar.classList.add('-translate-x-full');
            mobileOverlay.classList.add('hidden');
        }

        mobileMenuBtn.addEventListener('click', openMenu);
        closeMenuBtn.addEventListener('click', closeMenu);
        mobileOverlay.addEventListener('click', closeMenu);
    </script>
</body>
</html>
