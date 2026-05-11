# Kif-Kif - Plateforme B2B de Gestion de Ressources

Une plateforme B2B moderne pour la gestion et l'échange de ressources de construction entre entreprises et particuliers.

## 📋 Table des Matières

- [Vue d'ensemble](#vue-densemble)
- [Fonctionnalités](#fonctionnalités)
- [Architecture Technique](#architecture-technique)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Configuration](#configuration)
- [Structure du Projet](#structure-du-projet)
- [Modèles de Données](#modèles-de-données)
- [Routes et Contrôleurs](#routes-et-contrôleurs)
- [Rôles et Permissions](#rôles-et-permissions)
- [Tests](#tests)
- [Déploiement](#déploiement)

## 🎯 Vue d'ensemble

Kif-Kif est une plateforme B2B qui permet aux entreprises de construction de gérer leurs ressources (matériaux, équipements, espaces de stockage) et aux particuliers de découvrir et contacter ces entreprises. La plateforme inclut un système de validation des entreprises par les administrateurs.

## ✨ Fonctionnalités

### Pour les Administrateurs
- Dashboard avec statistiques globales
- Validation des entreprises en attente
- Gestion des utilisateurs
- Accès aux statistiques de la plateforme

### Pour les Entreprises
- Dashboard personnalisé avec statistiques
- Création et gestion des annonces de ressources
- Suivi des transactions
- Gestion du profil entreprise

### Pour les Particuliers
- Dashboard personnalisé
- Navigation dans la marketplace
- Recherche de ressources par catégorie, ville, mot-clé
- Gestion du profil personnel
- Contact avec les entreprises

### Marketplace Publique
- Recherche et filtrage des ressources
- Affichage détaillé des ressources
- Pagination des résultats
- Interface responsive (mobile et desktop)

## 🏗️ Architecture Technique

### Stack Technologique
- **Backend**: Laravel 10 (PHP 8.2+)
- **Base de données**: MySQL
- **Authentification**: Laravel Breeze
- **Gestion des rôles**: Spatie Laravel-Permission
- **Frontend**: Blade Templates + Tailwind CSS
- **Icônes**: Material Symbols Outlined
- **Polices**: Google Fonts (Inter)

### Structure MVC
- **Modèles**: Eloquent ORM avec relations
- **Contrôleurs**: Logique métier par rôle
- **Vues**: Templates Blade avec design moderne
- **Routes**: Groupées par rôle avec middleware

## 📦 Prérequis

- PHP >= 8.2
- Composer
- MySQL >= 5.7
- Node.js & NPM (pour les assets si nécessaire)
- Git

## 🚀 Installation

### 1. Cloner le dépôt
```bash
git clone <repository-url>
cd Kif-Kif/Implementation
```

### 2. Installer les dépendances
```bash
composer install
npm install
```

### 3. Configuration de l'environnement
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurer la base de données
Éditez le fichier `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kifkif
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Exécuter les migrations
```bash
php artisan migrate
```

### 6. Seeder la base de données
```bash
php artisan db:seed
```

Cela créera:
- 3 rôles (admin, entreprise, particulier)
- 3 utilisateurs de test
- 6 catégories de ressources
- 6 ressources exemples

### 7. Lancer le serveur de développement
```bash
php artisan serve
```

L'application sera accessible sur `http://localhost:8000`

## 🔧 Configuration

### Utilisateurs de Test

| Rôle | Email | Mot de passe |
|------|-------|--------------|
| Admin | admin@kifkif.ma | password |
| Entreprise | entreprise@kifkif.ma | password |
| Particulier | particulier@kifkif.ma | password |

### Rôles et Permissions

Les rôles sont gérés via Spatie Laravel-Permission:
- **admin**: Accès complet au panneau d'administration
- **entreprise**: Accès au dashboard et gestion des ressources
- **particulier**: Accès à la marketplace et gestion du profil

## 📁 Structure du Projet

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   └── AdminController.php
│   │   ├── Entreprise/
│   │   │   ├── AuthController.php
│   │   │   ├── DashboardController.php
│   │   │   └── RessourceController.php
│   │   ├── MarketplaceController.php
│   │   ├── ParticulierController.php
│   │   ├── DashboardRedirectController.php
│   │   └── Auth/
│   │       └── AuthenticatedSessionController.php
│   └── Middleware/
│       └── RedirectBasedOnRole.php
├── Models/
│   ├── User.php
│   ├── Entreprise.php
│   ├── Particulier.php
│   ├── Ressource.php
│   ├── Categorie.php
│   ├── Transaction.php
│   ├── Message.php
│   ├── Notification.php
│   └── Statistique.php
database/
├── migrations/
├── seeders/
│   ├── RolePermissionSeeder.php
│   ├── CategorieSeeder.php
│   ├── RessourceSeeder.php
│   └── UserSeeder.php
resources/
└── views/
    ├── admin/
    │   ├── dashboard.blade.php
    │   └── entreprises.blade.php
    ├── entreprise/
    │   └── dashboard.blade.php
    ├── particulier/
    │   ├── dashboard.blade.php
    │   └── profile.blade.php
    ├── marketplace/
    │   └── index.blade.php
    └── auth/
routes/
└── web.php
```

## 🗄️ Modèles de Données

### User
- Relations: belongsTo(Entreprise), belongsTo(Particulier)
- Rôles: admin, entreprise, particulier
- Type: entreprise, particulier

### Entreprise
- Attributs: nom, ice, secteur_activite, ville, email, telephone, statut_validation
- Relations: hasMany(User), hasMany(Ressource)
- Statuts: en_attente, validee, rejetee

### Particulier
- Attributs: nom, prenom, ville, telephone, email, date_inscription
- Relations: hasOne(User)

### Ressource
- Attributs: titre, description, type_ressource, quantite, unite, etat, prix_unitaire, localisation, photos, statut
- Relations: belongsTo(Entreprise), belongsTo(Categorie), hasMany(Transaction), hasMany(Message)
- Types: matiere_premiere, sous_produit, machine, espace_stockage
- Statuts: active, vendue, en_attente, archivee

### Categorie
- Attributs: nom, description, icone, parent_id
- Relations: hasMany(Ressource), belongsTo(Categorie, parent), hasMany(Categorie, enfants)
- Structure hiérarchique avec catégories parent/enfant

### Transaction
- Attributs: date_transaction, montant, statut
- Relations: belongsTo(Ressource), belongsTo(User, acheteur), belongsTo(User, vendeur)

### Message
- Attributs: contenu, date_envoi, statut_lecture
- Relations: belongsTo(Ressource), belongsTo(User, expediteur), belongsTo(User, destinataire)

### Notification
- Attributs: type, contenu, date_creation, statut_lecture
- Relations: belongsTo(User)

### Statistique
- Attributs: type, valeur, date_enregistrement
- Relations: belongsTo(User, administrateur)

## 🛣️ Routes et Contrôleurs

### Routes Publiques
- `GET /` - Page d'accueil
- `GET /marketplace` - Marketplace index
- `GET /marketplace/search` - Recherche de ressources
- `GET /marketplace/{id}` - Détails d'une ressource
- `GET /login` - Connexion (Breeze)
- `GET /register` - Inscription (Breeze)
- `GET /entreprise/login` - Connexion entreprise
- `GET /entreprise/register` - Inscription entreprise

### Routes Admin (middleware: auth, role:admin)
- `GET /admin/dashboard` - Dashboard admin
- `GET /admin/entreprises` - Liste des entreprises
- `POST /admin/entreprises/{id}/valider` - Valider une entreprise
- `POST /admin/entreprises/{id}/rejeter` - Rejeter une entreprise

### Routes Entreprise (middleware: auth, entreprise)
- `GET /entreprise/dashboard` - Dashboard entreprise
- `GET /entreprise/ressources` - Liste des ressources
- `GET /entreprise/ressources/create` - Formulaire création
- `POST /entreprise/ressources` - Créer une ressource
- `POST /entreprise/logout` - Déconnexion entreprise

### Routes Particulier (middleware: auth, role:particulier)
- `GET /particulier/dashboard` - Dashboard particulier
- `GET /particulier/profile` - Profil particulier
- `PUT /particulier/profile` - Mettre à jour le profil

### Route de Redirection
- `GET /dashboard` - Redirection basée sur le rôle

## 🔐 Rôles et Permissions

### Middleware Custom
- `entreprise`: Vérifie que l'utilisateur est de type entreprise
- `role:admin`: Vérifie que l'utilisateur a le rôle admin
- `role:particulier`: Vérifie que l'utilisateur a le rôle particulier

### Logique de Redirection
Après connexion, les utilisateurs sont redirigés vers:
- Admin → `/admin/dashboard`
- Entreprise → `/entreprise/dashboard`
- Particulier → `/particulier/dashboard`

## 🧪 Tests

### Tests Unitaires
```bash
php artisan test
```

### Tests de Routes
```bash
php artisan route:list
```

### Tests de Base de Données
```bash
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=CategorieSeeder
php artisan db:seed --class=RessourceSeeder
```

## 📱 Design Responsive

Toutes les vues sont responsive avec:
- Sidebar fixe sur desktop (lg+)
- Menu hamburger sur mobile
- Grilles adaptatives (grid-cols-1 md:grid-cols-2 lg:grid-cols-3)
- Padding adaptatif (p-4 lg:p-8)
- Header sticky sur mobile

## 🚢 Déploiement

### Production
1. Configurer les variables d'environnement
2. Exécuter `php artisan key:generate`
3. Exécuter `php artisan migrate --force`
4. Exécuter `php artisan db:seed --force`
5. Configurer le cache: `php artisan config:cache`
6. Optimiser les assets: `npm run build`
7. Configurer le serveur web (Apache/Nginx)

### Variables d'Environnement Requises
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://your-domain.com`
- Database configuration
- Mail configuration

## 📝 Notes de Développement

- Le projet utilise Laravel Breeze pour l'authentification
- Les vues utilisent Tailwind CSS via CDN pour le développement
- Les icônes proviennent de Material Symbols Outlined
- La police Inter est chargée depuis Google Fonts
- Les rôles sont gérés via Spatie Laravel-Permission

## 🤝 Contribution

Pour contribuer à ce projet:
1. Fork le dépôt
2. Créer une branche feature (`git checkout -b feature/AmazingFeature`)
3. Commit les changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## 📄 Licence

Ce projet est sous licence MIT.

## 👥 Équipe

- Développement: [Votre Nom]
- Design: [Votre Nom]
- Project Manager: [Votre Nom]

## 📞 Support

Pour toute question ou support, contactez: support@kifkif.ma
