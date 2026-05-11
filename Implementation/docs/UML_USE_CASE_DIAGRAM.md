# UML Use Case Diagram - Kif-Kif Platform

```mermaid
useCaseDiagram
    actor "Visiteur" as V
    actor "Utilisateur" as U
    actor "Administrateur" as A
    actor "Entreprise" as E
    actor "Particulier" as P

    package "Authentication" {
        usecase "S'authentifier" as UC1
        usecase "S'inscrire (Particulier)" as UC2
        usecase "S'inscrire (Entreprise)" as UC3
        usecase "Se Déconnecter" as UC15
    }

    package "Admin Module" {
        usecase "Voir Dashboard Admin" as UC4
        usecase "Valider Entreprise" as UC5
        usecase "Rejeter Entreprise" as UC6
    }

    package "Entreprise Module" {
        usecase "Voir Dashboard Entreprise" as UC7
        usecase "Créer Annonce" as UC8
        usecase "Gérer Annonces" as UC9
    }

    package "Particulier Module" {
        usecase "Voir Dashboard Particulier" as UC10
        usecase "Mettre à jour Profil" as UC11
    }

    package "Marketplace" {
        usecase "Naviguer Marketplace" as UC12
        usecase "Voir Détails Ressource" as UC13
        usecase "Rechercher Ressources" as UC14
    }

    ' Actor Inheritance
    A --|> U
    E --|> U
    P --|> U

    ' Visitor Associations
    V --> UC1
    V --> UC2
    V --> UC3
    V --> UC12
    V --> UC13
    V --> UC14

    ' Base User Associations
    U --> UC1
    U --> UC15

    ' Admin Associations
    A --> UC4
    A --> UC5
    A --> UC6

    ' Entreprise Associations
    E --> UC7
    E --> UC8
    E --> UC9

    ' Particulier Associations
    P --> UC10
    P --> UC11
    P --> UC12
    P --> UC13
    P --> UC14

    ' Include Relationships
    UC4 ..> UC15 : <<include>>
    UC7 ..> UC15 : <<include>>
    UC10 ..> UC15 : <<include>>

    ' Extend Relationships
    UC13 ..> UC12 : <<extend>>
```

---

## Actor Hierarchy

### Base Actor
- **Utilisateur** - Base actor for all authenticated users

### Specialized Actors (inherit from Utilisateur)
- **Administrateur** - Gère la plateforme, valide les entreprises (extends Utilisateur)
- **Entreprise** - Publie des ressources, gère son profil (extends Utilisateur)
- **Particulier** - Cherche des ressources, contacte les entreprises (extends Utilisateur)

### Separate Actor
- **Visiteur** - Navigateur non authentifié (separate from Utilisateur)

**Note**: A single person can play multiple roles. For example, a user with admin privileges can also act as a particulier. The actors represent the roles users play when interacting with the system, not distinct individuals.

---

## Use Cases Details

### Authentication Module
| ID | Use Case | Description |
|----|----------|-------------|
| UC01 | S'authentifier | Connexion utilisateur avec redirection par rôle |
| UC02 | S'inscrire (Particulier) | Création compte particulier |
| UC03 | S'inscrire (Entreprise) | Création compte entreprise (statut en_attente) |
| UC15 | Se Déconnecter | Déconnexion utilisateur |

### Admin Module
| ID | Use Case | Description |
|----|----------|-------------|
| UC04 | Voir Dashboard Admin | Statistiques globales et entreprises en attente |
| UC05 | Valider Entreprise | Valider entreprise en attente |
| UC06 | Rejeter Entreprise | Rejeter entreprise en attente |

### Entreprise Module
| ID | Use Case | Description |
|----|----------|-------------|
| UC07 | Voir Dashboard Entreprise | Statistiques et annonces récentes |
| UC08 | Créer Annonce | Publier nouvelle ressource |
| UC09 | Gérer Annonces | Voir/modifier/supprimer annonces |

### Particulier Module
| ID | Use Case | Description |
|----|----------|-------------|
| UC10 | Voir Dashboard Particulier | Accueil et raccourcis |
| UC11 | Mettre à jour Profil | Modifier informations personnelles |

### Marketplace Module
| ID | Use Case | Description |
|----|----------|-------------|
| UC12 | Naviguer Marketplace | Voir ressources avec pagination |
| UC13 | Voir Détails Ressource | Détails complets d'une ressource |
| UC14 | Rechercher Ressources | Filtrer par mot-clé, catégorie, ville |

---

## Relationships Summary

### Inheritance Relationships
- **Administrateur** extends **Utilisateur**
- **Entreprise** extends **Utilisateur**
- **Particulier** extends **Utilisateur**

### Include Relationships
- UC04 (Voir Dashboard Admin) includes UC15 (Se Déconnecter)
- UC07 (Voir Dashboard Entreprise) includes UC15 (Se Déconnecter)
- UC10 (Voir Dashboard Particulier) includes UC15 (Se Déconnecter)

### Extend Relationships
- UC13 (Voir Détails Ressource) extends UC12 (Naviguer Marketplace)

### Actor-Use Case Associations
- **Visiteur**: UC12, UC13, UC14, UC01, UC02, UC03
- **Utilisateur** (base): UC01, UC15
- **Administrateur**: UC04, UC05, UC06 (plus inherited from Utilisateur)
- **Entreprise**: UC07, UC08, UC09 (plus inherited from Utilisateur)
- **Particulier**: UC10, UC11, UC12, UC13, UC14 (plus inherited from Utilisateur)
