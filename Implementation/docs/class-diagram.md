# Plateforme Kif-Kif - Diagramme de Classes

```mermaid
classDiagram
    class User {
        +int id
        +string email
        +string password
        +string nom
        +string prenom
        +int entreprise_id
        +int particulier_id
        +isAdministrateur() bool
        +isParticulier() bool
        +isEntreprise() bool
        +entreprise() BelongsTo
        +particulier() BelongsTo
        +ressources() HasMany
    }

    class Entreprise {
        +int id
        +string nom
        +string ice
        +string secteur_activite
        +string ville
        +string email
        +string telephone
        +string statut_validation
        +isValidee() bool
        +isSuspendue() bool
        +users() HasMany
        +ressources() HasMany
    }

    class Particulier {
        +int id
        +string nom
        +string prenom
        +string ville
        +string telephone
        +string email
        +user() HasOne
    }

    class Ressource {
        +int id
        +string titre
        +string description
        +string type_ressource
        +decimal quantite
        +string unite
        +string etat
        +decimal prix_unitaire
        +string localisation
        +array photos
        +string statut
        +int entreprise_id
        +int categorie_id
        +entreprise() BelongsTo
        +categorie() BelongsTo
        +calculerImpactCO2() float
        +scopeActives() Scope
        +scopeParType() Scope
        +scopeParVille() Scope
    }

    class Categorie {
        +int id
        +string nom
        +string description
        +ressources() HasMany
    }

    class AdminController {
        +index() View
        +entreprises() View
        +validerEntreprise() Redirect
        +rejeterEntreprise() Redirect
        +suspendreEntreprise() Redirect
        +reactiverEntreprise() Redirect
        +deleteEntreprise() Redirect
        +profile() View
        +updateProfile() Redirect
    }

    class EntrepriseDashboardController {
        +index() View
    }

    class EntrepriseRessourceController {
        +index() View
        +create() View
        +store() Redirect
        +edit() View
        +update() Redirect
        +destroy() Redirect
    }

    class ParticulierController {
        +dashboard() View
        +profile() View
        +updateProfile() Redirect
    }

    class MarketplaceController {
        +index() View
        +search() View
        +show() View
    }

    User "1" -- "*" Entreprise : appartient à
    User "1" -- "1" Particulier : appartient à
    User "1" -- "*" Ressource : possède
    Entreprise "1" -- "*" User : possède
    Entreprise "1" -- "*" Ressource : possède
    Particulier "1" -- "1" User : possède
    Ressource "*" -- "1" Entreprise : appartient à
    Ressource "*" -- "1" Categorie : appartient à
    Categorie "1" -- "*" Ressource : possède

    AdminController ..> User : gère
    EntrepriseDashboardController ..> Entreprise : gère
    EntrepriseRessourceController ..> Ressource : gère
    ParticulierController ..> Particulier : gère
    MarketplaceController ..> Ressource : affiche
    MarketplaceController ..> Categorie : utilise
```

## Légende

**Cardinalités :**
- **"1"** : Exactement une instance
- **"*"** : Zéro ou plusieurs instances
- **"0..1"** : Zéro ou une instance

**Types de relations :**
- **--** : Association (relation simple entre classes, typique des clés étrangères en base de données)
- **..>** : Dépendance/Utilisation (un contrôleur dépend d'un modèle)

**Modificateurs d'accès :**
- **+** : Attribut/méthode public
- **-** : Attribut/méthode privé
- **#** : Attribut/méthode protégé

**Note :** Les relations d'agrégation (`o--`) et de composition (`*--`) ne sont pas utilisées car les relations Eloquent de Laravel sont basées sur des clés étrangères et ne représentent pas des relations de cycle de vie UML strictes.
