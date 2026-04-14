# Diagramme de Classes - Plateforme Kif-Kif

## Classes Principales

### 1. Entreprise
```
---------------------------------
|           Entreprise           |
---------------------------------
| - id: int                      |
| - nom: string                  |
| - ice: string                  |
| - secteur_activite: string     |
| - ville: string                |
| - email: string                |
| - telephone: string            |
| - statut_validation: enum      |
| - date_creation: datetime      |
---------------------------------
| + sInscrire(): bool            |
| + seConnecter(): bool          |
| + mettreAJourProfil(): bool     |
| + validerICE(): bool           |
---------------------------------
```

### 2. Utilisateur
```
---------------------------------
|            Utilisateur          |
---------------------------------
| - id: int                      |
| - nom: string                  |
| - prenom: string               |
| - email: string                |
| - mot_de_passe: string         |
| - role: enum                   |
| - entreprise_id: int           |
| - date_creation: datetime      |
---------------------------------
| + sAuthentifier(): bool        |
| + modifierMotDePasse(): bool   |
| + resetMotDePasse(): bool      |
---------------------------------
```

### 3. Ressource
```
---------------------------------
|            Ressource           |
---------------------------------
| - id: int                      |
| - titre: string                |
| - description: text            |
| - type_ressource: enum         |
| - quantite: float              |
| - unite: string                |
| - etat: string                 |
| - prix_unitaire: decimal       |
| - localisation: string         |
| - photos: array                |
| - statut: enum                 |
| - date_publication: datetime   |
| - entreprise_id: int           |
---------------------------------
| + publierAnnonce(): bool       |
| + modifierAnnonce(): bool      |
| + archiverAnnonce(): bool      |
| + calculerImpactCO2(): float   |
---------------------------------
```

### 4. Transaction
```
---------------------------------
|           Transaction          |
---------------------------------
| - id: int                      |
| - reference: string            |
| - montant_total: decimal       |
| - date_transaction: datetime   |
| - statut: enum                 |
| - mode_paiement: string        |
| - acheteur_id: int             |
| - vendeur_id: int              |
| - ressource_id: int            |
---------------------------------
| + validerTransaction(): bool   |
| + annulerTransaction(): bool   |
| + genererFacture(): string     |
| + notifierParties(): bool      |
---------------------------------
```

### 5. Message
```
---------------------------------
|             Message            |
---------------------------------
| - id: int                      |
| - contenu: text                |
| - date_envoi: datetime         |
| - statut_lecture: bool         |
| - expediteur_id: int           |
| - destinataire_id: int         |
| - ressource_id: int            |
---------------------------------
| + envoyerMessage(): bool       |
| + marquerCommeLu(): bool       |
| + supprimerMessage(): bool     |
---------------------------------
```

### 6. Categorie
```
---------------------------------
|            Categorie           |
---------------------------------
| - id: int                      |
| - nom: string                  |
| - description: text            |
| - icone: string                |
| - parent_id: int               |
---------------------------------
| + ajouterCategorie(): bool     |
| + modifierCategorie(): bool    |
| + supprimerCategorie(): bool   |
---------------------------------
```

### 7. Statistique
```
---------------------------------
|           Statistique          |
---------------------------------
| - id: int                      |
| - type_statistique: enum       |
| - valeur: decimal              |
| - periode: date                |
| - region: string               |
| - secteur_activite: string     |
---------------------------------
| + calculerVolumeTransactions() |
| + calculerImpactEcologique()   |
| + genererRapport(): array      |
---------------------------------
```

### 8. Notification
```
---------------------------------
|          Notification          |
---------------------------------
| - id: int                      |
| - titre: string                |
| - message: text                |
| - type_notification: enum      |
| - date_creation: datetime      |
| - lue: bool                    |
| - utilisateur_id: int          |
---------------------------------
| + envoyerNotification(): bool   |
| + marquerCommeLue(): bool      |
| + supprimerNotification(): bool|
---------------------------------
```

## Relations entre Classes

### Associations
```
Entreprise "1" --- "*" Utilisateur
    (une entreprise a plusieurs utilisateurs)

Entreprise "1" --- "*" Ressource
    (une entreprise publie plusieurs ressources)

Utilisateur "1" --- "" Transaction (acheteur)
Utilisateur "1" --- "" Transaction (vendeur)
    (un utilisateur peut être acheteur ou vendeur)

Ressource "1" --- "*" Transaction
    (une ressource peut être vendue plusieurs fois)

Ressource "1" --- "*" Message
    (une ressource génère plusieurs messages)

Utilisateur "1" --- "" Message (expéditeur)
Utilisateur "1" --- "" Message (destinataire)

Categorie "1" --- "*" Ressource
    (une catégorie contient plusieurs ressources)

Categorie "0..1" --- "*" Categorie (parent/enfant)
    (structure hiérarchique des catégories)

Utilisateur "1" --- "*" Notification
    (un utilisateur reçoit plusieurs notifications)

Administrateur "1" --- "*" Statistique
    (l'admin gère les statistiques)
```

### Héritage
```
          Utilisateur
             /   \
            /     \
    ResponsableTPME  Administrateur
```

### Agrégation
```
Entreprise o--- Transaction
    (une entreprise est agrégée dans ses transactions)

Ressource o--- Message
    (une ressource est agrégée dans les messages)
```

### Composition
```
Entreprise <>--- Utilisateur
    (l'existence des utilisateurs dépend de l'entreprise)

Transaction <>--- Message
    (les messages de transaction dépendent de la transaction)
```

## Diagramme Textuel Complet

```
                    +----------------+
                    |   Utilisateur  |
                    +----------------+
                    | - id: int      |
                    | - email: string|
                    | - role: enum   |
                    +----------------+
                    | + sAuthentifier|
                    +----------------+
                         ^
                         |
            +------------+-------------+
            |                          |
    +----------------+        +----------------+
    | ResponsableTPME|        | Administrateur|
    +----------------+        +----------------+
    |                |        |                |
    +----------------+        +----------------+
            |                          |
            |                          |
    +-------+-------+        +---------+---------+
    |               |        |                   |
+--------+    +-----------+  |     +-----------+ |
|Entreprise|    |Ressource |  |     |Statistique| |
+--------+    +-----------+  |     +-----------+ |
| -id: int|    | -id: int |  |     | -id: int  | |
| -ice:   |    | -prix:   |  |     | -valeur:  | |
+--------+    +-----------+  |     +-----------+ |
    |              |        |           ^       |
    |              |        |           |       |
    |              |        |     +-----+-----+ |
    |              |        |     |Notification| |
    |              |        |     +-----+-----+ |
    |              |        |           ^       |
    |              |        |           |       |
    |              |        |     +-----+-----+ |
    |              |        |     |Categorie   | |
    |              |        |     +-----+-----+ |
    |              |        |           ^       |
    |              |        |           |       |
    |              +--------+-----------+-------+
    |                       |
    |              +-----------+
    |              |Transaction|
    |              +-----------+
    |              | -id: int  |
    |              | -montant: |
    |              +-----------+
    |                   |
    |              +-----------+
    |              |  Message  |
    |              +-----------+
    |              | -id: int  |
    |              | -contenu: |
    |              +-----------+
    |                   |
    +-------------------+
```

## Contraintes et Règles Métier

### Contraintes d'Intégrité
- **ICE** : Unique et non null pour chaque entreprise
- **Email** : Unique pour chaque utilisateur
- **Statut validation** : Par défaut "En attente" pour les nouvelles entreprises
- **Prix** : Doit être supérieur à 0 pour les ressources payantes

### Règles de Navigation
- Une entreprise non validée ne peut pas publier d'annonces
- Seul un administrateur peut modifier les statistiques globales
- Une transaction ne peut être validée que si les deux parties sont des entreprises validées

### Multiplicités
- Une entreprise doit avoir au moins un utilisateur administrateur
- Une ressource peut avoir 0 ou plusieurs transactions
- Un utilisateur peut avoir 0 ou plusieurs messages
- Une catégorie peut avoir 0 ou plusieurs ressources


Résumé des Relations
1️⃣ Entreprise (1) → Utilisateur (*)
Type : Composition (◆)
Détails : Une entreprise a plusieurs utilisateurs. Si l'entreprise est supprimée, les utilisateurs aussi.
Migration : utilisateurs.entreprise_id avec constrained('entreprises')->onDelete('cascade')
2️⃣ Entreprise (1) → Ressource (*)
Type : Association
Détails : Une entreprise publie plusieurs ressources.
Migration : ressources.entreprise_id avec constrained('entreprises')->onDelete('cascade')
3️⃣ Utilisateur (1) → Transaction (*) [Acheteur/Vendeur]
Type : Association
Détails : Un utilisateur peut être acheteur ou vendeur dans plusieurs transactions.
Migration : transactions.acheteur_id et transactions.vendeur_id
4️⃣ Ressource (1) → Transaction (*)
Type : Association
Détails : Une ressource peut être vendue plusieurs fois (si quantité permet).
Migration : transactions.ressource_id
5️⃣ Ressource (1) → Message (*)
Type : Agrégation (◇)
Détails : Une ressource génère plusieurs messages (questions des acheteurs).
Migration : messages.ressource_id (nullable)
6️⃣ Transaction (1) → Message (*)
Type : Composition (◆)
Détails : Les messages liés à une transaction dépendent de celle-ci.
Migration : messages.transaction_id (nullable)
7️⃣ Utilisateur (1) → Message (*) [Expéditeur/Destinataire]
Type : Association
Détails : Un utilisateur envoie et reçoit des messages.
Migration : messages.expediteur_id et messages.destinataire_id
8️⃣ Categorie (1) → Ressource (*)
Type : Association
Détails : Une catégorie contient plusieurs ressources.
Migration : ressources.categorie_id (nullable)
9️⃣ Categorie (0..1) → Categorie (*) [Parent/Enfant]
Type : Auto-référence (hiérarchie)
Détails : Structure hiérarchique des catégories.
Migration : categories.parent_id (nullable, self-constrained)
🔟 Utilisateur (1) → Notification (*)
Type : Composition (◆)
Détails : Les notifications appartiennent à un utilisateur.
Migration : notifications.utilisateur_id
1️⃣1️⃣ Utilisateur (1) → Statistique (*) [Admin]
Type : Association
Détails : L'administrateur gère les statistiques.
Migration : statistiques.administrateur_id

📐 Schéma des Multiplicités



Entreprise (1) ────── (*) Utilisateur
      │
      └── (*) Ressource ────── (*) Transaction ──── (*) Message
            │                    │   │
            │                    │   └── Acheteur (Utilisateur)
            │                    │   └── Vendeur (Utilisateur)
            │                    │
            └── (*) Categorie    └── (*) Statistique (par Admin)
            │
            └── Parent/Enfant (auto-référence)