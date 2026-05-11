# SQL 2 - Séance de Renforcement — Jointures

**Contexte :** Gestion de la plateforme Kif-Kif

**Objectif**
Dans ce projet, vous allez :
- Manipuler une base de données relationnelle
- Travailler avec des jointures doubles, triples et quadruples
- Appliquer des filtres avancés
- Utiliser ORDER BY, GROUP BY, LIMIT
- Structurer des requêtes SQL claires

---

## 1. Script DDL (Création de la base)

### Création de la base de données
```sql
CREATE DATABASE IF NOT EXISTS KifKif;
USE KifKif;
```

### Table : USERS
```sql
CREATE TABLE USERS (
    id            INT PRIMARY KEY AUTO_INCREMENT,
    nom           VARCHAR(255) NOT NULL,
    prenom        VARCHAR(255) NOT NULL,
    email         VARCHAR(255) UNIQUE NOT NULL,
    password      VARCHAR(255) NOT NULL,
    role          ENUM('responsable_tpm', 'administrateur') DEFAULT 'responsable_tpm',
    type          ENUM('particulier', 'entreprise') DEFAULT 'particulier',
    date_creation DATETIME NOT NULL,
    created_at    DATETIME NOT NULL,
    updated_at    DATETIME NOT NULL
);
```

### Table : PARTICULIERS
```sql
CREATE TABLE PARTICULIERS (
    id               INT PRIMARY KEY AUTO_INCREMENT,
    nom              VARCHAR(255) NOT NULL,
    prenom           VARCHAR(255) NOT NULL,
    ville            VARCHAR(255),
    telephone        VARCHAR(255),
    email            VARCHAR(255),
    date_inscription DATETIME NOT NULL,
    created_at       DATETIME NOT NULL,
    updated_at       DATETIME NOT NULL
);
```

### Table : ENTREPRISES
```sql
CREATE TABLE ENTREPRISES (
    id                INT PRIMARY KEY AUTO_INCREMENT,
    nom               VARCHAR(255) NOT NULL,
    ice               VARCHAR(255) UNIQUE NOT NULL,
    secteur_activite  VARCHAR(255),
    ville             VARCHAR(255),
    email             VARCHAR(255) UNIQUE NOT NULL,
    telephone         VARCHAR(255),
    statut_validation ENUM('en_attente', 'validee', 'rejetee', 'suspendue') DEFAULT 'en_attente',
    date_creation     DATETIME NOT NULL,
    created_at        DATETIME NOT NULL,
    updated_at        DATETIME NOT NULL
);
```

### Table : CATEGORIES
```sql
CREATE TABLE CATEGORIES (
    id          INT PRIMARY KEY AUTO_INCREMENT,
    nom         VARCHAR(255) NOT NULL,
    description TEXT,
    icone       VARCHAR(255),
    parent_id   INT NULL,
    created_at  DATETIME NOT NULL,
    updated_at  DATETIME NOT NULL,
    FOREIGN KEY (parent_id) REFERENCES CATEGORIES(id) ON DELETE SET NULL
);
```

### Table : RESSOURCES
```sql
CREATE TABLE RESSOURCES (
    id              INT PRIMARY KEY AUTO_INCREMENT,
    titre           VARCHAR(255) NOT NULL,
    description     TEXT,
    type_ressource  ENUM('matiere_premiere', 'sous_produit', 'machine', 'espace_stockage') NOT NULL,
    quantite        DECIMAL(10,2),
    unite           VARCHAR(50),
    etat            VARCHAR(50),
    prix_unitaire   DECIMAL(10,2),
    localisation    VARCHAR(255),
    photos          JSON,
    statut          ENUM('active', 'vendue', 'en_attente', 'archivee') DEFAULT 'active',
    date_publication DATETIME NOT NULL,
    entreprise_id   INT NOT NULL,
    categorie_id    INT NULL,
    created_at      DATETIME NOT NULL,
    updated_at      DATETIME NOT NULL,
    FOREIGN KEY (entreprise_id) REFERENCES ENTREPRISES(id) ON DELETE CASCADE,
    FOREIGN KEY (categorie_id) REFERENCES CATEGORIES(id) ON DELETE SET NULL
);
```

---

## 2. Script DML (Insertion des données)

### USERS
```sql
INSERT INTO USERS (nom, prenom, email, password, role, type, date_creation, created_at, updated_at) VALUES
('Admin', 'Principal', 'admin@kifkif.ma', 'hashed_password', 'administrateur', 'entreprise', '2024-01-01 08:00:00', NOW(), NOW()),
('Dupont', 'Jean', 'jean.dupont@mail.ma', 'hashed_password', 'responsable_tpm', 'particulier', '2024-02-15 10:30:00', NOW(), NOW()),
('EcoMetal', 'SARL', 'contact@ecometal.ma', 'hashed_password', 'responsable_tpm', 'entreprise', '2024-03-10 09:00:00', NOW(), NOW()),
('GreenPlast', 'SA', 'contact@greenplast.ma', 'hashed_password', 'responsable_tpm', 'entreprise', '2024-04-20 14:00:00', NOW(), NOW()),
('RecyclePro', 'Ltd', 'contact@recyclepro.ma', 'hashed_password', 'responsable_tpm', 'entreprise', '2024-05-05 16:00:00', NOW(), NOW()),
('SteelCorp', 'Inc', 'contact@steelcorp.ma', 'hashed_password', 'responsable_tpm', 'entreprise', '2024-06-01 11:00:00', NOW(), NOW());
```

### PARTICULIERS
```sql
INSERT INTO PARTICULIERS (nom, prenom, ville, telephone, email, date_inscription, created_at, updated_at) VALUES
('Dupont', 'Jean', 'Casablanca', '0612345678', 'jean.dupont@mail.ma', '2024-02-15 10:30:00', NOW(), NOW());
```

### ENTREPRISES
```sql
INSERT INTO ENTREPRISES (nom, ice, secteur_activite, ville, email, telephone, statut_validation, date_creation, created_at, updated_at) VALUES
('EcoMetal', '001234567890123', 'Métallurgie', 'Casablanca', 'contact@ecometal.ma', '0611111111', 'validee', '2024-03-10 09:00:00', NOW(), NOW()),
('GreenPlast', '001234567890124', 'Plastique', 'Tanger', 'contact@greenplast.ma', '0622222222', 'validee', '2024-04-20 14:00:00', NOW(), NOW()),
('RecyclePro', '001234567890125', 'Recyclage', 'Rabat', 'contact@recyclepro.ma', '0633333333', 'en_attente', '2024-05-05 16:00:00', NOW(), NOW()),
('SteelCorp', '001234567890126', 'Acier', 'Fès', 'contact@steelcorp.ma', '0644444444', 'suspendue', '2024-06-01 11:00:00', NOW(), NOW());
```

### CATEGORIES
```sql
INSERT INTO CATEGORIES (nom, description, icone, parent_id, created_at, updated_at) VALUES
('Métaux', 'Ressources métalliques recyclables', 'metal', NULL, NOW(), NOW()),
('Plastiques', 'Matériaux plastiques réutilisables', 'plastic', NULL, NOW(), NOW()),
('Papier/Carton', 'Produits en papier et carton', 'paper', NULL, NOW(), NOW()),
('Électronique', 'Composants électroniques et appareils', 'electronic', NULL, NOW(), NOW()),
('Bois', 'Ressources en bois et déchets forestiers', 'wood', NULL, NOW(), NOW()),
('Fer/Acier', 'Fers et aciers divers', 'steel', 1, NOW(), NOW()),
('Cuivre', 'Ressources en cuivre pur', 'copper', 1, NOW(), NOW()),
('PET', 'Bouteilles et granulés PET', 'bottle', 2, NOW(), NOW());
```

### RESSOURCES
```sql
INSERT INTO RESSOURCES (titre, description, type_ressource, quantite, unite, etat, prix_unitaire, localisation, statut, date_publication, entreprise_id, categorie_id, created_at, updated_at) VALUES
('Ferraille industrielle', 'Ferraille de haute qualité pour recyclage', 'matiere_premiere', 5000.00, 'kg', 'Bon', 15.50, 'Casablanca', 'active', '2024-07-01 10:00:00', 1, 6, NOW(), NOW()),
('Granulés plastique', 'Granulés PEHD recyclés de grade A', 'sous_produit', 2000.00, 'kg', 'Neuf', 8.00, 'Tanger', 'active', '2024-07-05 14:00:00', 2, 7, NOW(), NOW()),
('Cartons ondulés', 'Cartons de déménagement réutilisables', 'sous_produit', 500.00, 'unité', 'Bon', 2.50, 'Rabat', 'active', '2024-07-10 09:00:00', 3, 3, NOW(), NOW()),
('Cuivre pur', 'Fils de cuivre recyclé 99.9% pur', 'matiere_premiere', 300.00, 'kg', 'Excellent', 45.00, 'Casablanca', 'active', '2024-07-12 11:00:00', 1, 7, NOW(), NOW()),
('Aluminium compacté', 'Briques d\'aluminium pressé', 'sous_produit', 1500.00, 'kg', 'Bon', 22.00, 'Tanger', 'inactive', '2024-07-15 16:00:00', 2, 6, NOW(), NOW()),
('Palettes bois', 'Palettes EUR standard réutilisables', 'sous_produit', 100.00, 'unité', 'Usagé', 5.00, 'Fès', 'active', '2024-07-18 08:00:00', 4, 5, NOW(), NOW()),
('Bouteilles PET', 'Bouteilles plastique compactées lavées', 'matiere_premiere', 800.00, 'kg', 'Bon', 3.50, 'Rabat', 'active', '2024-07-20 10:00:00', 3, 7, NOW(), NOW()),
('Cartons industriels', 'Gros cartons usine 5 couches', 'sous_produit', 1200.00, 'kg', 'Excellent', 1.80, 'Casablanca', 'active', '2024-07-22 14:00:00', 1, 3, NOW(), NOW()),
('Press hydraulique', 'Presse à balles 50 tonnes', 'machine', 1.00, 'unité', 'Bon état', 150000.00, 'Casablanca', 'active', '2024-07-25 09:00:00', 1, 1, NOW(), NOW()),
('Entrepôt 500m²', 'Entrepôt avec quai de chargement', 'espace_stockage', 1.00, 'm²', 'Disponible', 25.00, 'Tanger', 'active', '2024-07-28 16:00:00', 2, NULL, NOW(), NOW());
```

---

## 3. Challenges SQL

**Objectif**
Ces exercices visent à renforcer :
- Les jointures
- Le filtrage avancé
- Le tri des résultats

---

### Challenge 1 : Ressources par ville et leur entreprise

**Contexte**
Identifier les ressources publiées par les entreprises, en affichant leur ville de localisation et l'entreprise propriétaire.

**Tâche**
Afficher :
- Titre de la ressource
- Type de ressource
- Ville de localisation
- Nom de l'entreprise
- Secteur d'activité de l'entreprise
- Prix unitaire

**Contraintes**
- Utiliser une double jointure entre RESSOURCES, ENTREPRISES
- Filtrer uniquement les ressources de Casablanca ou Tanger
- Trier par ville puis par prix décroissant
- Condition : `localisation IN ('Casablanca', 'Tanger')`

**Indice**
```sql
SELECT r.titre, r.type_ressource, r.localisation, e.nom, e.secteur_activite, r.prix_unitaire
FROM RESSOURCES r
JOIN ENTREPRISES e ON r.entreprise_id = e.id
WHERE r.localisation IN ('Casablanca', 'Tanger')
ORDER BY r.localisation, r.prix_unitaire DESC;
```

**Résultat attendu**
Liste des ressources des deux villes avec leur entreprise propriétaire et détails.

---

### Challenge 2 : Ressources actives avec leur catégorie

**Contexte**
Lister toutes les ressources actives avec leur catégorie et sous-catégorie (si applicable).

**Tâche**
Afficher :
- Titre de la ressource
- Nom de la catégorie principale
- Nom de la sous-catégorie (parent)
- Quantité disponible
- Prix unitaire
- Statut de la ressource

**Contraintes**
- Double jointure : RESSOURCES → CATEGORIES (deux fois pour parent)
- Filtrer uniquement les ressources actives
- Trier par nom de catégorie puis par prix
- Condition : `r.statut = 'active'`

**Indice**
Utilisez deux jointures sur la table CATEGORIES : une pour la catégorie directe, une pour la catégorie parente.

```sql
SELECT r.titre, c.nom as categorie, parent.nom as sous_categorie, 
       r.quantite, r.prix_unitaire, r.statut
FROM RESSOURCES r
LEFT JOIN CATEGORIES c ON r.categorie_id = c.id
LEFT JOIN CATEGORIES parent ON c.parent_id = parent.id
WHERE r.statut = 'active'
ORDER BY c.nom, r.prix_unitaire DESC;
```

**Résultat attendu**
Liste des ressources actives avec leur hiérarchie de catégories.

---

### Challenge 3 : Statistiques par entreprise avec filtre

**Contexte**
Calculer les statistiques de ressources par entreprise validée et identifier celles dont le prix moyen dépasse 15 DH.

**Tâche**
Afficher :
- Nom de l'entreprise
- Ville de l'entreprise
- Secteur d'activité
- Nombre de ressources publiées
- Quantité totale disponible
- Prix moyen des ressources
- Prix minimum
- Prix maximum

**Contraintes**
- Double jointure : RESSOURCES → ENTREPRISES
- Filtrer uniquement les entreprises validées
- Utiliser GROUP BY sur l'entreprise
- Appliquer HAVING pour filtrer le prix moyen
- Trier par prix moyen décroissant
- Conditions : `e.statut_validation = 'validee'` et `HAVING AVG(r.prix_unitaire) > 15`

**Indice**
```sql
SELECT e.nom, e.ville, e.secteur_activite,
       COUNT(r.id) as nb_ressources,
       SUM(r.quantite) as quantite_totale,
       AVG(r.prix_unitaire) as prix_moyen,
       MIN(r.prix_unitaire) as prix_min,
       MAX(r.prix_unitaire) as prix_max
FROM ENTREPRISES e
JOIN RESSOURCES r ON e.id = r.entreprise_id
WHERE e.statut_validation = 'validee'
GROUP BY e.id, e.nom, e.ville, e.secteur_activite
HAVING AVG(r.prix_unitaire) > 15
ORDER BY prix_moyen DESC;
```

**Résultat attendu**
Liste des entreprises validées avec des ressources premium (prix moyen > 15 DH).

---

### Challenge 4 : Classement général des entreprises

**Contexte**
Produire un tableau de bord complet : pour chaque entreprise, afficher ses résultats globaux en croisant toutes les tables — entreprises, ressources, catégories — puis classer les 3 meilleures entreprises par valeur totale d'inventaire.

**Tâche**
Afficher :
- Nom de l'entreprise
- Ville
- Secteur d'activité
- Nombre de catégories différentes utilisées
- Nombre total de ressources
- Quantité totale disponible
- Valeur totale de l'inventaire (quantité × prix)
- Prix moyen par ressource
- Nom de la catégorie la plus représentée

**Contraintes**
- Triple jointure : RESSOURCES → ENTREPRISES, CATEGORIES
- Utiliser GROUP BY sur l'entreprise
- Calculer la valeur totale : SUM(quantite * prix_unitaire)
- Utiliser ORDER BY sur la valeur totale décroissante
- Utiliser LIMIT pour ne garder que les 3 meilleures
- Conditions : `GROUP BY e.id, e.nom, e.ville, e.secteur_activite`
- `ORDER BY valeur_totale DESC`
- `LIMIT 3`

**Indice**
```sql
SELECT e.nom, e.ville, e.secteur_activite,
       COUNT(DISTINCT r.categorie_id) as nb_categories,
       COUNT(r.id) as nb_ressources,
       SUM(r.quantite) as quantite_totale,
       SUM(r.quantite * r.prix_unitaire) as valeur_totale,
       AVG(r.prix_unitaire) as prix_moyen,
       (SELECT c2.nom FROM CATEGORIES c2 
        JOIN RESSOURCES r2 ON c2.id = r2.categorie_id 
        WHERE r2.entreprise_id = e.id 
        GROUP BY c2.id 
        ORDER BY COUNT(r2.id) DESC 
        LIMIT 1) as categorie_top
FROM ENTREPRISES e
JOIN RESSOURCES r ON e.id = r.entreprise_id
WHERE e.statut_validation = 'validee'
GROUP BY e.id, e.nom, e.ville, e.secteur_activite
ORDER BY valeur_totale DESC
LIMIT 3;
```

**Résultat attendu**
Classement des 3 entreprises les plus importantes en valeur d'inventaire avec leur profil complet.

---

## Conclusion

Ces exercices permettent de maîtriser :
- ✅ Les jointures doubles et triples
- ✅ Le filtrage avancé avec WHERE et HAVING
- ✅ Le regroupement avec GROUP BY
- ✅ Le tri avec ORDER BY
- ✅ La pagination avec LIMIT
- ✅ Les calculs sur colonnes (quantité × prix)
- ✅ Les sous-requêtes pour des agrégations complexes

**Prochaine étape :**
- Transactions et verrouillage
- Indexation et optimisation
- Vues et procédures stockées
