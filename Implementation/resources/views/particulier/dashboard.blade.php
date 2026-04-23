<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Particulier - Kif-Kif</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f3f4f6;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <nav style="background-color: #16a34a; color: white; padding: 20px; margin-bottom: 20px;">
            <h1 style="margin: 0;">Kif-Kif - Espace Particulier</h1>
            <div style="margin-top: 10px;">
                @if($particulier)
                    <span>{{ $particulier->nom }} {{ $particulier->prenom }}</span>
                @else
                    <span>Particulier data not found</span>
                @endif
                <a href="{{ route('logout') }}" style="color: white; margin-left: 20px; text-decoration: underline;">Déconnexion</a>
            </div>
        </nav>

        <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <h2 style="margin-top: 0;">Bienvenue sur Kif-Kif !</h2>
            <p>Découvrez les ressources disponibles dans votre région et contactez les entreprises directement.</p>
            
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 30px;">
                <div style="background: #eff6ff; padding: 20px; border-radius: 8px;">
                    <h3 style="color: #1e40af; margin-top: 0;">Explorer</h3>
                    <p>Parcourez les annonces de ressources</p>
                    <a href="{{ route('marketplace.index') }}" style="display: inline-block; background: #2563eb; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; margin-top: 10px;">
                        Voir Marketplace
                    </a>
                </div>
                
                <div style="background: #f0fdf4; padding: 20px; border-radius: 8px;">
                    <h3 style="color: #166534; margin-top: 0;">Mon Profil</h3>
                    <p>Gérez vos informations personnelles</p>
                    <a href="{{ route('particulier.profile') }}" style="display: inline-block; background: #16a34a; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; margin-top: 10px;">
                        Modifier Profil
                    </a>
                </div>
                
                <div style="background: #faf5ff; padding: 20px; border-radius: 8px;">
                    <h3 style="color: #7e22ce; margin-top: 0;">Contact</h3>
                    <p>Contactez les vendeurs</p>
                    <a href="{{ route('marketplace.index') }}" style="display: inline-block; background: #9333ea; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; margin-top: 10px;">
                        Contacter
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
