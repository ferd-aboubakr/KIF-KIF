<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation Entreprises - Kif-Kif</title>
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
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">
                <span class="material-symbols-outlined">dashboard</span>
                Dashboard
            </a>
            <a href="{{ route('admin.entreprises') }}" class="flex items-center gap-3 px-4 py-3 bg-emerald-50 text-emerald-700 rounded-xl font-medium">
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
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-xl transition-colors">
                <span class="material-symbols-outlined">dashboard</span>
                Dashboard
            </a>
            <a href="{{ route('admin.entreprises') }}" class="flex items-center gap-3 px-4 py-3 bg-emerald-50 text-emerald-700 rounded-xl font-medium">
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
                    <h2 class="text-2xl font-bold text-gray-800">Validation Entreprises</h2>
                    <p class="text-sm text-gray-500">Gérez les demandes d'inscription</p>
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
            @if (session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <div class="p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-800">Toutes les Entreprises</h3>
                    <p class="text-sm text-gray-500 mt-1">{{ $entreprises->count() }} entreprise(s) au total</p>
                </div>

                @if ($entreprises->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Entreprise</th>
                                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">ICE</th>
                                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Secteur</th>
                                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Ville</th>
                                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($entreprises as $entreprise)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 
                                                    @if($entreprise->statut_validation === 'validee') bg-emerald-100 text-emerald-600
                                                    @elseif($entreprise->statut_validation === 'suspendue') bg-orange-100 text-orange-600
                                                    @elseif($entreprise->statut_validation === 'rejetee') bg-red-100 text-red-600
                                                    @else bg-gray-100 text-gray-600
                                                    @endif rounded-lg flex items-center justify-center font-bold text-sm">
                                                    {{ substr($entreprise->nom, 0, 2) }}
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-800">{{ $entreprise->nom }}</p>
                                                    <p class="text-xs text-gray-500">{{ $entreprise->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600 font-mono">{{ $entreprise->ice }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-medium rounded-full">{{ $entreprise->secteur_activite }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">{{ $entreprise->ville }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 text-xs font-medium rounded-full
                                                @if($entreprise->statut_validation === 'validee') bg-emerald-50 text-emerald-700
                                                @elseif($entreprise->statut_validation === 'suspendue') bg-orange-50 text-orange-700
                                                @elseif($entreprise->statut_validation === 'rejetee') bg-red-50 text-red-700
                                                @else bg-gray-50 text-gray-700
                                                @endif">
                                                @if($entreprise->statut_validation === 'validee') Validée
                                                @elseif($entreprise->statut_validation === 'suspendue') Suspendue
                                                @elseif($entreprise->statut_validation === 'rejetee') Rejetée
                                                @else En attente
                                                @endif
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end gap-2">
                                                @if($entreprise->statut_validation === 'en_attente')
                                                    <form method="POST" action="{{ route('admin.entreprises.valider', $entreprise->id) }}">
                                                        @csrf
                                                        <button type="submit" class="p-2 hover:bg-emerald-50 text-emerald-600 rounded-lg transition-colors" title="Valider">
                                                            <span class="material-symbols-outlined">check</span>
                                                        </button>
                                                    </form>
                                                    <form method="POST" action="{{ route('admin.entreprises.rejeter', $entreprise->id) }}">
                                                        @csrf
                                                        <button type="submit" class="p-2 hover:bg-red-50 text-red-600 rounded-lg transition-colors" title="Rejeter">
                                                            <span class="material-symbols-outlined">close</span>
                                                        </button>
                                                    </form>
                                                @endif

                                                @if($entreprise->statut_validation === 'validee')
                                                    <form method="POST" action="{{ route('admin.entreprises.suspendre', $entreprise->id) }}">
                                                        @csrf
                                                        <button type="submit" class="p-2 hover:bg-orange-50 text-orange-600 rounded-lg transition-colors" title="Suspendre" onclick="return confirm('Êtes-vous sûr de vouloir suspendre cette entreprise ? Elle devra contacter l\'administration pour être réactivée.')">
                                                            <span class="material-symbols-outlined">pause_circle</span>
                                                        </button>
                                                    </form>
                                                @endif

                                                @if($entreprise->statut_validation === 'suspendue')
                                                    <form method="POST" action="{{ route('admin.entreprises.reactiver', $entreprise->id) }}">
                                                        @csrf
                                                        <button type="submit" class="p-2 hover:bg-emerald-50 text-emerald-600 rounded-lg transition-colors" title="Réactiver" onclick="return confirm('Êtes-vous sûr de vouloir réactiver cette entreprise ? Elle pourra de nouveau publier des annonces.')">
                                                            <span class="material-symbols-outlined">play_circle</span>
                                                        </button>
                                                    </form>
                                                @endif

                                                <form method="POST" action="{{ route('admin.entreprises.delete', $entreprise->id) }}" onsubmit="event.preventDefault(); if(confirm('Êtes-vous sûr de vouloir supprimer définitivement cette entreprise ? Cette action est irréversible et supprimera toutes les données associées.')) { this.submit(); }">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 hover:bg-red-50 text-red-600 rounded-lg transition-colors" title="Supprimer">
                                                        <span class="material-symbols-outlined">delete_forever</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4 border-t">
                        {{ $entreprises->links() }}
                    </div>
                @else
                    <div class="p-12 text-center">
                        <span class="material-symbols-outlined text-4xl text-gray-300">business</span>
                        <p class="text-gray-500 mt-2">Aucune entreprise trouvée</p>
                        <a href="{{ route('admin.dashboard') }}" class="inline-block mt-4 text-emerald-600 hover:text-emerald-700 font-medium">
                            Retour au Dashboard →
                        </a>
                    </div>
                @endif
        </main>
    </main>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-sidebar').classList.toggle('-translate-x-full');
            document.getElementById('mobile-overlay').classList.toggle('hidden');
        });

        document.getElementById('close-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-sidebar').classList.add('-translate-x-full');
            document.getElementById('mobile-overlay').classList.add('hidden');
        });

        document.getElementById('mobile-overlay').addEventListener('click', function() {
            document.getElementById('mobile-sidebar').classList.add('-translate-x-full');
            document.getElementById('mobile-overlay').classList.add('hidden');
        });
    </script>
</body>
</html>
