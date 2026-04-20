<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Entreprise - Kif-Kif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen py-8">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-center">Inscription Entreprise</h1>
        
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('entreprise.register.post') }}">
            @csrf
            <h2 class="text-lg font-semibold mb-4">Informations Entreprise</h2>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 mb-2">Nom entreprise</label>
                    <input type="text" name="nom_entreprise" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">ICE</label>
                    <input type="text" name="ice" class="w-full border p-2 rounded" required>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 mb-2">Secteur d'activité</label>
                    <input type="text" name="secteur_activite" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Ville</label>
                    <input type="text" name="ville" class="w-full border p-2 rounded" required>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Téléphone</label>
                    <input type="text" name="telephone" class="w-full border p-2 rounded" required>
                </div>
            </div>

            <h2 class="text-lg font-semibold mb-4">Responsable</h2>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 mb-2">Nom</label>
                    <input type="text" name="nom" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Prénom</label>
                    <input type="text" name="prenom" class="w-full border p-2 rounded" required>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-gray-700 mb-2">Mot de passe</label>
                    <input type="password" name="password" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block text-gray-700 mb-2">Confirmer mot de passe</label>
                    <input type="password" name="password_confirmation" class="w-full border p-2 rounded" required>
                </div>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white p-2 rounded hover:bg-green-700">
                S'inscrire
            </button>
        </form>

        <p class="mt-4 text-center text-sm">
            Déjà inscrit ? 
            <a href="{{ route('entreprise.login') }}" class="text-blue-600">Se connecter</a>
        </p>
    </div>
</body>
</html>
