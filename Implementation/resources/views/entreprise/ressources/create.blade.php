<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Annonce - Kif-Kif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-blue-600 text-white p-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Kif-Kif - Nouvelle Annonce</h1>
            <div class="flex items-center gap-4">
                <a href="{{ route('entreprise.dashboard') }}" class="hover:underline">Dashboard</a>
                <a href="{{ route('entreprise.ressources.index') }}" class="hover:underline">Mes annonces</a>
                <form method="POST" action="{{ route('entreprise.logout') }}">
                    @csrf
                    <button type="submit" class="text-sm underline">Déconnexion</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto p-4">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-6">Publier une annonce</h2>

            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul class="list-disc ml-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('entreprise.ressources.store') }}">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Titre</label>
                    <input type="text" name="titre" value="{{ old('titre') }}" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="4" class="w-full border p-2 rounded" required>{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 mb-2">Type de ressource</label>
                        <select name="type_ressource" class="w-full border p-2 rounded" required>
                            <option value="">-- Choisir --</option>
                            <option value="matiere_premiere" {{ old('type_ressource') === 'matiere_premiere' ? 'selected' : '' }}>Matière première</option>
                            <option value="sous_produit" {{ old('type_ressource') === 'sous_produit' ? 'selected' : '' }}>Sous-produit</option>
                            <option value="machine" {{ old('type_ressource') === 'machine' ? 'selected' : '' }}>Machine</option>
                            <option value="espace_stockage" {{ old('type_ressource') === 'espace_stockage' ? 'selected' : '' }}>Espace de stockage</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">État</label>
                        <input type="text" name="etat" value="{{ old('etat') }}" placeholder="ex: Neuf, Bon état..." class="w-full border p-2 rounded" required>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 mb-2">Quantité</label>
                        <input type="number" name="quantite" value="{{ old('quantite') }}" step="0.01" class="w-full border p-2 rounded" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Unité</label>
                        <input type="text" name="unite" value="{{ old('unite') }}" placeholder="kg, litres, unités..." class="w-full border p-2 rounded" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Prix unitaire (DH)</label>
                        <input type="number" name="prix_unitaire" value="{{ old('prix_unitaire') }}" step="0.01" class="w-full border p-2 rounded" required>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 mb-2">Localisation</label>
                    <input type="text" name="localisation" value="{{ old('localisation') }}" class="w-full border p-2 rounded" required>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                        Publier
                    </button>
                    <a href="{{ route('entreprise.ressources.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
