# Maquette Figma - Plateforme Kif-Kif

## Structure des Pages

### 1. Page d'Accueil (Landing Page)
```
[Header - Navigation]
Logo Kif-Kif                    [Connexion] [S'inscrire]

[Hero Section]
# Kif-Kif : L'Économie Circulaire au Maroc
Transformez vos surplus en opportunités
[CTA] Rejoindre la plateforme

[Indicateurs de Sobriété]
- 2.3s temps de chargement
- < 500KB poids total
- 100% mobile-friendly

[Dernières Ressources]
| Matière Première | Machine | Espace | Prix |
|------------------|---------|--------|------|
| Tissu coton      | Machine | 100m²  | 500DH|
| Plastique PET    | Presse  | 50m²   | 200DH|

[Valeurs]
- Réduction des coûts
- Impact écologique
- Soutien local

[Footer]
Contact | Mentions légales | CGU
```

### 2. Page d'Inscription
```
[Header]
Logo Kif-Kif                    [Déjà inscrit ? Connexion]

[Formulaire d'Inscription]
# Créer votre compte entreprise

[Informations Entreprise]
Nom de l'entreprise* __________________
ICE* __________________
Secteur d'activité* [Dropdown]
Ville* __________________

[Coordonnées]
Email* __________________
Téléphone* __________________
Mot de passe* ________________
Confirmer mot de passe* ________

[Validation]
[ ] J'accepte les CGU
[Créer mon compte]

[Footer]
© 2024 Kif-Kif - Tous droits réservés
```

### 3. Tableau de Bord Entreprise
```
[Header]
Logo Kif-Kif  [Notifications]  [Profil]  [Déconnexion]

[Métriques Circulaires]
+----------------+----------------+----------------+
| Revenus générés| Économies réalisées| CO2 évité    |
|     15,000DH   |     8,500DH    |    2.3 tonnes  |
+----------------+----------------+----------------+

[Navigation Secondaire]
[Mes Annonces] [Marketplace] [Transactions] [Paramètres]

[Mes Annonces Actives]
| Titre              | Type    | Prix   | Statut     | Actions |
|--------------------|---------|--------|------------|---------|
| Chutes de tissu    | Matière | 500DH  | Active     | Modifier |
| Machine à coudre   | Machine | 2,000DH| En attente | Voir    |

[Actions Rapides]
[Déposer une annonce] [Voir marketplace] [Exporter rapport]
```

### 4. Marketplace (Exploration)
```
[Header]
Logo Kif-Kif  [Recherche]  [Filtres]  [Déposer annonce]

[Filtres Latéraux]
Type de ressource
[ ] Matière première
[ ] Machine
[ ] Espace
[ ] Sous-produit

Secteur d'activité
[ ] Textile
[ ] Agroalimentaire
[ ] BTP
[ ] Électronique

Localisation
[Ville: Dropdown]
[Rayon: < 50km]

[Grille de Résultats]
+-------------------+-------------------+-------------------+
| [Image]           | [Image]           | [Image]           |
| Chutes de tissu   | Presse hydraulique| Entrepôt 200m²    |
| Casablanca        | Tanger            | Rabat             |
| 500DH/tonne       | 15,000DH          | 2,000DH/mois      |
| [Contacter]       | [Contacter]       | [Contacter]       |
+-------------------+-------------------+-------------------+

[Pagination] 1 2 3 ... 10 [Suivant]
```

### 5. Détail d'Annonce
```
[Header]
Logo Kif-Kif  [Retour marketplace]

[Images Carousel]
[Image 1] [Image 2] [Image 3]

[Informations Ressource]
# Chutes de tissu coton
Entreprise: TextileMaroc
Publié: 15/04/2024

[Détails]
Type: Matière première
Quantité: 2 tonnes
État: Bon état
Localisation: Casablanca, Sidi Bernoussi
Prix: 500 DH/tonne

[Description]
Surplus de production de tissu coton 100% naturel, idéal pour recyclage ou fabrication de produits textiles secondaires. Disponible immédiatement.

[Actions]
[Contacter le vendeur] [Réserver] [Partager]

[Entreprise Vendeur]
TextileMaroc
- Membre depuis 2023
- 15 transactions réussies
- 4.8/5 étoiles
[Voir profil]
```

### 6. Tableau de Bord Administrateur
```
[Header]
Logo Kif-Kif  [Admin]  [Déconnexion]

[Statistiques Globales]
+----------------+----------------+----------------+
| TPME inscrites | Transactions   | Volume total   |
|      245       |     1,234      |   450 tonnes   |
+----------------+----------------+----------------+

[Carte Densité Industrielle]
[Carte du Maroc avec points colorés par région]
Casablanca-Settat: 45%
Tanger-Tétouan: 25%
Rabat-Salé: 15%
Autres: 15%

[Actions Admin]
[Validation entreprises] [Modération annonces] [Rapports]

[Entreprises en Attente]
| Nom          | ICE      | Secteur     | Actions      |
|--------------|----------|-------------|--------------|
| AlphaTech    | 123456   | Électronique| [Valider][Rejeter] |
| BioFood      | 789012   | Agroaliment.| [Valider][Rejeter] |
```

## Spécifications Design

### Palette de Couleurs
- **Primaire** : #2E7D32 (Vert écologique)
- **Secondaire** : #FF6F00 (Orange marocain)
- **Neutre** : #F5F5F5 (Gris clair)
- **Texte** : #212121 (Noir)
- **Accent** : #FFFFFF (Blanc)

### Typographie
- **Titres** : Roboto Bold, 24-32px
- **Sous-titres** : Roboto Medium, 18-20px
- **Texte** : Roboto Regular, 14-16px
- **Petit texte** : Roboto Light, 12px

### Icônes
- Utiliser Material Icons pour la légèreté
- Tailles : 16px, 24px, 32px
- Couleur : #2E7D32 (primaire)

### Espacements
- **Petit** : 8px
- **Moyen** : 16px
- **Grand** : 24px
- **Très grand** : 32px

### Composants UI

#### Boutons
```
[Bouton Primaire]
Background: #2E7D32
Text: #FFFFFF
Padding: 12px 24px
Border-radius: 4px

[Bouton Secondaire]
Background: transparent
Text: #2E7D32
Border: 2px solid #2E7D32
Padding: 12px 24px
Border-radius: 4px
```

#### Cartes
```
[Carte Ressource]
Background: #FFFFFF
Border: 1px solid #E0E0E0
Border-radius: 8px
Padding: 16px
Shadow: 0 2px 4px rgba(0,0,0,0.1)
```

#### Formulaires
```
[Champ Input]
Background: #FFFFFF
Border: 1px solid #E0E0E0
Border-radius: 4px
Padding: 12px
Font-size: 14px

[Focus]
Border-color: #2E7D32
Box-shadow: 0 0 0 2px rgba(46,125,50,0.2)
```

## Responsive Design

### Mobile (320px - 768px)
- Navigation hamburger
- Grille 1 colonne
- Cartes empilées
- Boutons pleine largeur

### Tablet (768px - 1024px)
- Navigation simplifiée
- Grille 2 colonnes
- Cartes côte à côte

### Desktop (1024px+)
- Navigation complète
- Grille 3-4 colonnes
- Sidebar pour filtres

## Optimisation Light-Tech

### Images
- Format WebP uniquement
- Taille max 200KB par image
- Lazy loading
- Compression 85%

### Polices
- Google Fonts avec display=swap
- Subset caractères latins
- Preload pour polices critiques

### Performance
- CSS minifié
- JavaScript async
- Cache statique 30 jours
- CDN pour assets

### Accessibilité
- Contraste WCAG AA minimum
- Navigation clavier complète
- Alt text pour images
- ARIA labels pour formulaires

## Flux Utilisateur

### Flux d'Inscription
1. Page d'accueil > "S'inscrire"
2. Formulaire inscription
3. Email validation
4. Tableau de bord (statut attente)

### Flux de Vente
1. Tableau de bord > "Déposer annonce"
2. Formulaire ressource
3. Upload images
4. Publication
5. Gestion annonces

### Flux d'Achat
1. Marketplace > Recherche/Filtres
2. Vue détail annonce
3. Contact vendeur
4. Transaction
5. Historique

## Notes Techniques Figma

### Structure des Frames
```
Kif-Kif_Platform/
  01_Home/
    Header
    Hero
    Features
    Footer
  02_Authentication/
    Login
    Register
    Forgot_Password
  03_Dashboard/
    Overview
    My_Listings
    Transactions
    Profile
  04_Marketplace/
    Browse
    Search_Results
    Listing_Detail
    Contact_Form
  05_Admin/
    Statistics
    User_Management
    Content_Moderation
```

### Components Réutilisables
- Boutons (Primary, Secondary, Ghost)
- Cards (Resource, Company, Transaction)
- Forms (Input, Select, Textarea)
- Navigation (Header, Sidebar, Breadcrumb)
- Modals (Contact, Confirmation, Error)

### Prototypes
- Liens entre pages principales
- Transitions simples (fade, slide)
- États hover et focus
- Validation formulaire en temps réel


https://www.figma.com/design/q0yAMrXpWO8NyHcesEhNPz/Untitled?node-id=0-1&t=zBGxGMCYvyJ6DDjH-1