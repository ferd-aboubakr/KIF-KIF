<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Particulier - Kif-Kif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-green-600 text-white p-4">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Kif-Kif - Mon Profil</h1>
            <div class="flex items-center gap-4">
                <a href="{{ route('particulier.dashboard') }}" class="hover:underline">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm underline">Déconnexion</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-2xl mx-auto p-4">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-6">Modifier mon profil</h2>
            
            <form method="POST" action="{{ route('particulier.profile.update') }}">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 mb-2">Nom</label>
                        <input type="text" name="nom" value="{{ old('nom', $user->nom) }}" class="w-full border p-2 rounded" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Prénom</label>
                        <input type="text" name="prenom" value="{{ old('prenom', $user->prenom) }}" class="w-full border p-2 rounded" required>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border p-2 rounded" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Ville</label>
                        <input type="text" name="ville" value="{{ old('ville', $particulier->ville) }}" class="w-full border p-2 rounded" required>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 mb-2">Téléphone</label>
                    <input type="text" name="telephone" value="{{ old('telephone', $particulier->telephone) }}" class="w-full border p-2 rounded" required>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                        Mettre à jour
                    </button>
                    <a href="{{ route('particulier.dashboard') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
