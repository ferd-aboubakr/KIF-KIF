<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Annonce - Kif-Kif</title>
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
            <a href="{{ route('entreprise.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">
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
                    <h2 class="text-2xl font-bold text-gray-800">Modifier Annonce</h2>
                    <p class="text-sm text-gray-500">Mettre à jour votre ressource</p>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('entreprise.ressources.index') }}" class="flex items-center gap-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition-colors font-medium">
                        <span class="material-symbols-outlined">arrow_back</span>
                        Retour
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
            <!-- Mobile Back Button -->
            <div class="lg:hidden mb-6">
                <a href="{{ route('entreprise.ressources.index') }}" class="flex items-center gap-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition-colors font-medium">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Retour aux annonces
                </a>
            </div>

            <!-- Form -->
            <section class="bg-white rounded-2xl shadow-sm p-6 lg:p-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Modifier les informations</h3>

                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('entreprise.ressources.update', request('id')) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Titre de l'annonce *</label>
                        <input type="text" name="titre" required value="{{ $ressource->titre }}" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                               placeholder="Ex: Matériaux de construction">
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                        <textarea name="description" required rows="4"
                                  class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                                  placeholder="Décrivez votre ressource en détail...">{{ $ressource->description }}</textarea>
                    </div>

                    <!-- Price and Location -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Prix unitaire (DH) *</label>
                            <input type="number" name="prix_unitaire" required min="0" step="0.01" value="{{ $ressource->prix_unitaire }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                                   placeholder="0.00">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Localisation *</label>
                            <input type="text" name="localisation" required value="{{ $ressource->localisation }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                                   placeholder="Ex: Casablanca">
                        </div>
                    </div>

                    <!-- Type and Quantity -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Type de ressource *</label>
                            <select name="type_ressource" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                                <option value="matiere_premiere" {{ $ressource->type_ressource === 'matiere_premiere' ? 'selected' : '' }}>Matière première</option>
                                <option value="sous_produit" {{ $ressource->type_ressource === 'sous_produit' ? 'selected' : '' }}>Sous-produit</option>
                                <option value="machine" {{ $ressource->type_ressource === 'machine' ? 'selected' : '' }}>Machine</option>
                                <option value="espace_stockage" {{ $ressource->type_ressource === 'espace_stockage' ? 'selected' : '' }}>Espace de stockage</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Quantité disponible *</label>
                            <input type="number" name="quantite" required min="0" value="{{ $ressource->quantite }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                                   placeholder="1">
                        </div>
                    </div>

                    <!-- Unit and State -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Unité *</label>
                            <input type="text" name="unite" required value="{{ $ressource->unite }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                                   placeholder="Ex: kg, litres, unités">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">État *</label>
                            <input type="text" name="etat" required value="{{ $ressource->etat }}"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all"
                                   placeholder="Ex: neuf, bon état, usagé">
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t">
                        <button type="submit" class="flex-1 flex items-center justify-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-colors font-medium">
                            <span class="material-symbols-outlined">save</span>
                            Enregistrer les modifications
                        </button>
                        <a href="{{ route('entreprise.ressources.index') }}" class="flex-1 flex items-center justify-center gap-2 px-6 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition-colors font-medium">
                            <span class="material-symbols-outlined">cancel</span>
                            Annuler
                        </a>
                    </div>
                </form>
            </section>

            <!-- Danger Zone -->
            <section class="mt-8 bg-red-50 rounded-2xl p-6">
                <h4 class="font-semibold text-red-800 mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined">warning</span>
                    Zone de danger
                </h4>
                <p class="text-red-700 mb-4">La suppression de cette annonce est irréversible. Toutes les données seront perdues.</p>
                <form method="POST" action="{{ route('entreprise.ressources.destroy', $ressource->id ?? $ressource) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ? Cette action est irréversible.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors font-medium">
                        <span class="material-symbols-outlined">delete</span>
                        Supprimer cette annonce
                    </button>
                </form>
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
