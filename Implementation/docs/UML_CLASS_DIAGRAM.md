# UML Class Diagram - Kif-Kif Platform

```mermaid
classDiagram
    class User {
        +bigint id
        +varchar(255) nom
        +varchar(255) prenom
        +varchar(255) email
        +varchar(255) password
        +varchar(255) role
        +varchar(255) type
        +bigint entreprise_id
        +bigint particulier_id
        +timestamp email_verified_at
        +varchar(100) remember_token
        +timestamp created_at
        +timestamp updated_at
        +entreprise() BelongsTo
        +particulier() BelongsTo
        +ressources() HasMany
        +transactionsAcheteur() HasMany
        +transactionsVendeur() HasMany
        +messagesEnvoyes() HasMany
        +messagesRecus() HasMany
        +notifications() HasMany
        +statistiques() HasMany
        +isAdministrateur() bool
        +isResponsableTPM() bool
        +isParticulier() bool
        +isEntreprise() bool
        +getAuthPassword() string
    }

    class Entreprise {
        +bigint id
        +varchar(255) nom
        +varchar(255) ice
        +varchar(255) secteur_activite
        +varchar(255) ville
        +varchar(255) email
        +varchar(255) telephone
        +enum statut_validation
        +timestamp date_creation
        +timestamp created_at
        +timestamp updated_at
        +users() HasMany
        +ressources() HasMany
        +isValidee() bool
        +scopeValidees() QueryBuilder
        +scopeEnAttente() QueryBuilder
    }

    class Particulier {
        +bigint id
        +varchar(255) nom
        +varchar(255) prenom
        +varchar(255) ville
        +varchar(255) telephone
        +varchar(255) email
        +timestamp date_inscription
        +timestamp created_at
        +timestamp updated_at
        +user() HasOne
    }

    class Ressource {
        +bigint id
        +varchar(255) titre
        +text description
        +enum type_ressource
        +decimal(10,2) quantite
        +varchar(255) unite
        +varchar(255) etat
        +decimal(10,2) prix_unitaire
        +varchar(255) localisation
        +json photos
        +enum statut
        +timestamp date_publication
        +bigint entreprise_id
        +bigint categorie_id
        +timestamp created_at
        +timestamp updated_at
        +entreprise() BelongsTo
        +categorie() BelongsTo
        +transactions() HasMany
        +messages() HasMany
        +calculerImpactCO2() float
        +scopeActives() QueryBuilder
        +scopeParType() QueryBuilder
        +scopeParVille() QueryBuilder
    }

    class Categorie {
        +bigint id
        +varchar(255) nom
        +text description
        +varchar(255) icone
        +bigint parent_id
        +timestamp created_at
        +timestamp updated_at
        +ressources() HasMany
        +parent() BelongsTo
        +enfants() HasMany
    }

    class Transaction {
        +bigint id
        +timestamp date_transaction
        +decimal(10,2) montant
        +varchar(255) statut
        +bigint ressource_id
        +bigint acheteur_id
        +bigint vendeur_id
        +timestamp created_at
        +timestamp updated_at
        +ressource() BelongsTo
        +acheteur() BelongsTo
        +vendeur() BelongsTo
    }

    class Message {
        +bigint id
        +text contenu
        +timestamp date_envoi
        +boolean statut_lecture
        +bigint ressource_id
        +bigint expediteur_id
        +bigint destinataire_id
        +timestamp created_at
        +timestamp updated_at
        +ressource() BelongsTo
        +expediteur() BelongsTo
        +destinataire() BelongsTo
    }

    class Notification {
        +bigint id
        +varchar(255) type
        +text contenu
        +timestamp date_creation
        +boolean statut_lecture
        +bigint user_id
        +timestamp created_at
        +timestamp updated_at
        +user() BelongsTo
    }

    class Statistique {
        +bigint id
        +varchar(255) type
        +decimal(10,2) valeur
        +timestamp date_enregistrement
        +bigint administrateur_id
        +timestamp created_at
        +timestamp updated_at
        +administrateur() BelongsTo
    }

    ' Relationships
    User "1" --> "0..1" Entreprise : entreprise_id
    User "1" --> "0..1" Particulier : particulier_id
    User "1" --> "*" Ressource : user_id
    User "1" --> "*" Transaction : acheteur_id
    User "1" --> "*" Transaction : vendeur_id
    User "1" --> "*" Message : expediteur_id
    User "1" --> "*" Message : destinataire_id
    User "1" --> "*" Notification : user_id
    User "1" --> "*" Statistique : administrateur_id

    Entreprise "1" --> "*" User : entreprise_id
    Entreprise "1" --> "*" Ressource : entreprise_id

    Particulier "1" --> "1" User : particulier_id

    Ressource "*" --> "1" Entreprise : entreprise_id
    Ressource "*" --> "0..1" Categorie : categorie_id
    Ressource "1" --> "*" Transaction : ressource_id
    Ressource "1" --> "*" Message : ressource_id

    Categorie "1" --> "*" Ressource : categorie_id
    Categorie "0..1" --> "*" Categorie : parent_id

    Transaction "*" --> "1" Ressource : ressource_id
    Transaction "*" --> "1" User : acheteur_id
    Transaction "*" --> "1" User : vendeur_id

    Message "*" --> "1" Ressource : ressource_id
    Message "*" --> "1" User : expediteur_id
    Message "*" --> "1" User : destinataire_id

    Notification "*" --> "1" User : user_id

    Statistique "*" --> "1" User : administrateur_id
```

---

## Classes and Relationships

### User (extends Authenticatable)
**Attributes:**
- id: bigint (PK)
- nom: varchar(255)
- prenom: varchar(255)
- email: varchar(255) (unique)
- password: varchar(255)
- role: varchar(255) [administrateur, responsable_tpm]
- type: varchar(255) [entreprise, particulier]
- entreprise_id: bigint (FK, nullable)
- particulier_id: bigint (FK, nullable)
- email_verified_at: timestamp (nullable)
- remember_token: varchar(100) (nullable)
- created_at: timestamp
- updated_at: timestamp

**Methods:**
- entreprise(): BelongsTo → Entreprise
- particulier(): BelongsTo → Particulier
- ressources(): HasMany → Ressource
- transactionsAcheteur(): HasMany → Transaction
- transactionsVendeur(): HasMany → Transaction
- messagesEnvoyes(): HasMany → Message
- messagesRecus(): HasMany → Message
- notifications(): HasMany → Notification
- statistiques(): HasMany → Statistique
- isAdministrateur(): bool
- isResponsableTPM(): bool
- isParticulier(): bool
- isEntreprise(): bool
- getAuthPassword(): string

---

### Entreprise (Model)
**Attributes:**
- id: bigint (PK)
- nom: varchar(255)
- ice: varchar(255)
- secteur_activite: varchar(255)
- ville: varchar(255)
- email: varchar(255)
- telephone: varchar(255)
- statut_validation: enum [en_attente, validee, rejetee]
- date_creation: timestamp
- created_at: timestamp
- updated_at: timestamp

**Methods:**
- users(): HasMany → User
- ressources(): HasMany → Ressource
- isValidee(): bool
- scopeValidees($query): QueryBuilder
- scopeEnAttente($query): QueryBuilder

---

### Particulier (Model)
**Attributes:**
- id: bigint (PK)
- nom: varchar(255)
- prenom: varchar(255)
- ville: varchar(255)
- telephone: varchar(255)
- email: varchar(255)
- date_inscription: timestamp
- created_at: timestamp
- updated_at: timestamp

**Methods:**
- user(): HasOne → User

---

### Ressource (Model)
**Attributes:**
- id: bigint (PK)
- titre: varchar(255)
- description: text
- type_ressource: enum [matiere_premiere, sous_produit, machine, espace_stockage]
- quantite: decimal(10,2)
- unite: varchar(255)
- etat: varchar(255)
- prix_unitaire: decimal(10,2)
- localisation: varchar(255)
- photos: json (nullable)
- statut: enum [active, vendue, en_attente, archivee]
- date_publication: timestamp
- entreprise_id: bigint (FK)
- categorie_id: bigint (FK, nullable)
- created_at: timestamp
- updated_at: timestamp

**Methods:**
- entreprise(): BelongsTo → Entreprise
- categorie(): BelongsTo → Categorie
- transactions(): HasMany → Transaction
- messages(): HasMany → Message
- calculerImpactCO2(): float
- scopeActives($query): QueryBuilder
- scopeParType($query, $type): QueryBuilder
- scopeParVille($query, $ville): QueryBuilder

---

### Categorie (Model)
**Attributes:**
- id: bigint (PK)
- nom: varchar(255)
- description: text (nullable)
- icone: varchar(255) (nullable)
- parent_id: bigint (FK, nullable)
- created_at: timestamp
- updated_at: timestamp

**Methods:**
- ressources(): HasMany → Ressource
- parent(): BelongsTo → Categorie
- enfants(): HasMany → Categorie

---

### Transaction (Model)
**Attributes:**
- id: bigint (PK)
- date_transaction: timestamp
- montant: decimal(10,2)
- statut: varchar(255)
- ressource_id: bigint (FK)
- acheteur_id: bigint (FK)
- vendeur_id: bigint (FK)
- created_at: timestamp
- updated_at: timestamp

**Methods:**
- ressource(): BelongsTo → Ressource
- acheteur(): BelongsTo → User
- vendeur(): BelongsTo → User

---

### Message (Model)
**Attributes:**
- id: bigint (PK)
- contenu: text
- date_envoi: timestamp
- statut_lecture: boolean
- ressource_id: bigint (FK)
- expediteur_id: bigint (FK)
- destinataire_id: bigint (FK)
- created_at: timestamp
- updated_at: timestamp

**Methods:**
- ressource(): BelongsTo → Ressource
- expediteur(): BelongsTo → User
- destinataire(): BelongsTo → User

---

### Notification (Model)
**Attributes:**
- id: bigint (PK)
- type: varchar(255)
- contenu: text
- date_creation: timestamp
- statut_lecture: boolean
- user_id: bigint (FK)
- created_at: timestamp
- updated_at: timestamp

**Methods:**
- user(): BelongsTo → User

---

### Statistique (Model)
**Attributes:**
- id: bigint (PK)
- type: varchar(255)
- valeur: decimal(10,2)
- date_enregistrement: timestamp
- administrateur_id: bigint (FK)
- created_at: timestamp
- updated_at: timestamp

**Methods:**
- administrateur(): BelongsTo → User

---

## Relationship Summary

### One-to-One
- **Particulier** ↔ **User** (particulier_id)
  - One Particulier has one User
  - One User belongs to one Particulier (nullable)

### One-to-Many
- **Entreprise** → **User** (entreprise_id)
- **Entreprise** → **Ressource** (entreprise_id)
- **Categorie** → **Ressource** (categorie_id)
- **Categorie** → **Categorie** (parent_id, self-referencing)
- **Ressource** → **Transaction** (ressource_id)
- **Ressource** → **Message** (ressource_id)
- **User** → **Transaction** (acheteur_id)
- **User** → **Transaction** (vendeur_id)
- **User** → **Message** (expediteur_id)
- **User** → **Message** (destinataire_id)
- **User** → **Notification** (user_id)
- **User** → **Statistique** (administrateur_id)

---

## Foreign Keys

| Table | Foreign Key | References | On Delete |
|-------|-------------|------------|-----------|
| users | entreprise_id | entreprises.id | CASCADE |
| users | particulier_id | particuliers.id | SET NULL |
| ressources | entreprise_id | entreprises.id | CASCADE |
| ressources | categorie_id | categories.id | SET NULL |
| categories | parent_id | categories.id | SET NULL |
| transactions | ressource_id | ressources.id | - |
| transactions | acheteur_id | users.id | - |
| transactions | vendeur_id | users.id | - |
| messages | ressource_id | ressources.id | - |
| messages | expediteur_id | users.id | - |
| messages | destinataire_id | users.id | - |
| notifications | user_id | users.id | - |
| statistiques | administrateur_id | users.id | - |

---

## Enums

### type_ressource (ressources table)
- matiere_premiere
- sous_produit
- machine
- espace_stockage

### statut (ressources table)
- active
- vendue
- en_attente
- archivee

### statut_validation (entreprises table)
- en_attente
- validee
- rejetee

### role (users table - via Spatie)
- admin
- entreprise
- particulier

### type (users table)
- entreprise
- particulier
