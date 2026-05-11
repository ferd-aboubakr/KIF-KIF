# Exercices SQL - Plateforme Kif-Kif

## Objectif
Dans ces exercices, vous allez :
- Manipuler une base de données relationnelle
- Travailler avec des jointures complexes
- Appliquer des filtres avancés
- Utiliser GROUP BY et HAVING
- Structurer des requêtes SQL claires

---

## 1. Script DDL (Schéma de la base)

### Base de données
```sql
CREATE DATABASE IF NOT EXISTS KifKif;
USE KifKif;
```

### Table : Users
```sql
CREATE TABLE Users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL
);
```

### Table : Particuliers
```sql
CREATE TABLE Particuliers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL UNIQUE,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    ville VARCHAR(255),
    telephone VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE
);
```

### Table : Entreprises
```sql
CREATE TABLE Entreprises (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    ice VARCHAR(255) NOT NULL,
    secteur_activite VARCHAR(255),
    ville VARCHAR(255),
    email VARCHAR(255),
    telephone VARCHAR(255),
    statut_validation ENUM('en_attente', 'validee', 'suspendue') DEFAULT 'en_attente',
    created_at DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE
);
```

### Table : Categories
```sql
CREATE TABLE Categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    description TEXT
);
```

### Table : Ressources
```sql
CREATE TABLE Ressources (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    type_ressource VARCHAR(50) NOT NULL,
    quantite DECIMAL(10,2),
    unite VARCHAR(50),
    etat VARCHAR(50),
    prix_unitaire DECIMAL(10,2),
    localisation VARCHAR(255),
    statut ENUM('active', 'inactive') DEFAULT 'active',
    entreprise_id INT NOT NULL,
    categorie_id INT,
    created_at DATETIME NOT NULL,
    FOREIGN KEY (entreprise_id) REFERENCES Entreprises(id) ON DELETE CASCADE,
    FOREIGN KEY (categorie_id) REFERENCES Categories(id)
);
```

---

## 2. Script DML (Données d'exemple)

### Users
```sql
INSERT INTO Users (email, password, created_at) VALUES
('admin@kifkif.ma', 'hashed_password', '2024-01-01 10:00:00'),
('particulier@kifkif.ma', 'hashed_password', '2024-02-15 14:30:00'),
('entreprise1@kifkif.ma', 'hashed_password', '2024-03-10 09:00:00'),
('entreprise2@kifkif.ma', 'hashed_password', '2024-04-20 11:00:00'),
('entreprise3@kifkif.ma', 'hashed_password', '2024-05-05 16:00:00'),
('entreprise4@kifkif.ma', 'hashed_password', '2024-06-01 08:00:00');
```

### Particuliers
```sql
INSERT INTO Particuliers (user_id, nom, prenom, ville, telephone) VALUES
(2, 'Dupont', 'Jean', 'Casablanca', '0612345678');
```

### Entreprises
```sql
INSERT INTO Entreprises (nom, ice, secteur_activite, ville, email, telephone, statut_validation, created_at) VALUES
('EcoMetal', '001234567890123', 'Métallurgie', 'Casablanca', 'contact@ecometal.ma', '0611111111', 'validee', '2024-03-10 09:00:00'),
('GreenPlast', '001234567890124', 'Plastique', 'Tanger', 'contact@greenplast.ma', '0622222222', 'validee', '2024-04-20 11:00:00'),
('RecyclePro', '001234567890125', 'Recyclage', 'Rabat', 'contact@recyclepro.ma', '0633333333', 'en_attente', '2024-05-05 16:00:00'),
('SteelCorp', '001234567890126', 'Acier', 'Fès', 'contact@steelcorp.ma', '0644444444', 'suspendue', '2024-06-01 08:00:00');
```

### Categories
```sql
INSERT INTO Categories (nom, description) VALUES
('Métaux', 'Ressources métalliques recyclables'),
('Plastiques', 'Matériaux plastiques réutilisables'),
('Papier/Carton', 'Produits en papier et carton'),
('Électronique', 'Composants électroniques et appareils'),
('Bois', 'Ressources en bois et déchets forestiers');
```

### Ressources
```sql
INSERT INTO Ressources (titre, description, type_ressource, quantite, unite, etat, prix_unitaire, localisation, statut, entreprise_id, categorie_id, created_at) VALUES
('Ferraille industrielle', 'Ferraille de haute qualité', 'Métal', 5000, 'kg', 'Bon', 15.50, 'Casablanca', 'active', 1, 1, '2024-07-01 10:00:00'),
('Granulés plastique', 'Granulés PEHD recyclés', 'Plastique', 2000, 'kg', 'Neuf', 8.00, 'Tanger', 'active', 2, 2, '2024-07-05 14:00:00'),
('Cartons ondulés', 'Cartons de déménagement', 'Papier', 500, 'unité', 'Bon', 2.50, 'Rabat', 'active', 3, 3, '2024-07-10 09:00:00'),
('Cuivre pur', 'Fils de cuivre recyclé', 'Métal', 300, 'kg', 'Excellent', 45.00, 'Casablanca', 'active', 1, 1, '2024-07-12 11:00:00'),
('Aluminium compacté', 'Briques d\'aluminium', 'Métal', 1500, 'kg', 'Bon', 22.00, 'Tanger', 'inactive', 2, 1, '2024-07-15 16:00:00'),
('Palettes bois', 'Palettes réutilisables', 'Bois', 100, 'unité', 'Usagé', 5.00, 'Fès', 'active', 4, 5, '2024-07-18 08:00:00'),
('Bouteilles PET', 'Bouteilles plastique compactées', 'Plastique', 800, 'kg', 'Bon', 3.50, 'Rabat', 'active', 3, 2, '2024-07-20 10:00:00'),
('Cartons industriels', 'Gros cartons usine', 'Papier', 1200, 'kg', 'Excellent', 1.80, 'Casablanca', 'active', 1, 3, '2024-07-22 14:00:00');
```

---

## 3. Challenges SQL

### Challenge 1 : Entreprises en attente de validation
**Contexte**
Identifier les entreprises dont l'inscription est toujours en attente de validation.

**Tâche**
Afficher :
- Nom de l'entreprise
- Email de contact
- Secteur d'activité
- Date d'inscription

**Contraintes**
- Jointure entre Users et Entreprises
- Condition : `statut_validation = 'en_attente'`
- Trier par date d'inscription croissante

**Indice**
Utilisez une jointure simple `JOIN` ou utilisez directement la table Entreprises.

**Résultat attendu**
Liste des entreprises en attente avec leurs informations de contact.

---

### Challenge 2 : Ressources par catégorie
**Contexte**
Compter le nombre de ressources disponibles dans chaque catégorie.

**Tâche**
Afficher :
- Nom de la catégorie
- Nombre de ressources
- Prix moyen des ressources

**Contraintes**
- Jointure entre Ressources et Categories
- Utiliser `GROUP BY` sur le nom de la catégorie
- Utiliser `COUNT()` et `AVG()`
- Trier par nombre de ressources décroissant

**Indice**
Regroupez par `c.nom` et utilisez les fonctions d'agrégation.

**Résultat attendu**
Tableau récapitulatif des ressources par catégorie avec statistiques.

---

### Challenge 3 : Entreprises avec ressources actives
**Contexte**
Lister uniquement les entreprises validées qui ont au moins une ressource active.

**Tâche**
Afficher :
- Nom de l'entreprise
- Ville
- Nombre de ressources actives
- Quantité totale disponible

**Contraintes**
- Jointure entre Entreprises et Ressources
- Condition : `statut_validation = 'validee'` ET `statut = 'active'`
- Utiliser `GROUP BY` sur l'entreprise
- Trier par nombre de ressources décroissant

**Indice**
Filtrez d'abord sur les statuts, puis groupez par entreprise.

**Résultat attendu**
Liste des entreprises actives avec leur inventaire.

---

### Challenge 4 : Ressources chères par ville
**Contexte**
Identifier les ressources dont le prix unitaire est supérieur à 20 DH, groupées par ville.

**Tâche**
Afficher :
- Ville
- Titre de la ressource
- Prix unitaire
- Nom de l'entreprise propriétaire

**Contraintes**
- Jointure entre Ressources, Entreprises
- Condition : `prix_unitaire > 20`
- Trier par prix décroissant
- Filtrer par ville si nécessaire

**Indice**
Utilisez une jointure pour récupérer le nom de l'entreprise.

**Résultat attendu**
Liste des ressources premium avec leur localisation et propriétaire.

---

### Challenge 5 : Catégories avec stock minimum
**Contexte**
Trouver les catégories où la quantité totale de ressources est inférieure à 1000 unités.

**Tâche**
Afficher :
- Nom de la catégorie
- Quantité totale disponible
- Nombre de ressources dans cette catégorie

**Contraintes**
- Jointure entre Ressources et Categories
- Utiliser `GROUP BY` sur la catégorie
- Utiliser `HAVING` pour filtrer après agrégation
- Condition : `SUM(quantite) < 1000`

**Indice**
La clause `HAVING` s'utilise après `GROUP BY` pour filtrer les agrégats.

**Résultat attendu**
Catégories nécessitant un réapprovisionnement.

---

### Challenge 6 : Entreprises récentes sans ressources
**Contexte**
Identifier les entreprises validées inscrites après le 1er mai 2024 qui n'ont pas encore publié de ressources.

**Tâche**
Afficher :
- Nom de l'entreprise
- Email
- Date d'inscription
- Ville

**Contraintes**
- Jointure gauche (`LEFT JOIN`) entre Entreprises et Ressources
- Condition : `statut_validation = 'validee'` ET `created_at > '2024-05-01'`
- Filtrer : `ressource.id IS NULL` (pas de ressources)
- Trier par date décroissante

**Indice**
Utilisez `LEFT JOIN` pour inclure les entreprises sans ressources, puis filtrez avec `IS NULL`.

**Résultat attendu**
Entreprises validées mais inactives sur la marketplace.

---

### Challenge 7 : Top 3 ressources par vues (simulé)
**Contexte**
Simuler un classement des ressources les plus consultées (basé sur la quantité comme proxy).

**Tâche**
Afficher :
- Titre de la ressource
- Quantité disponible
- Prix unitaire
- Valeur totale (quantité × prix)
- Nom de l'entreprise

**Contraintes**
- Jointure entre Ressources et Entreprises
- Calculer une colonne : `quantite * prix_unitaire AS valeur_totale`
- Trier par quantité décroissant
- Limiter à 3 résultats

**Indice**
Vous pouvez créer une colonne calculée dans le `SELECT` avec un alias.

**Résultat attendu**
Top 3 des ressources les plus importantes en volume.

---

### Challenge 8 : Analyse par secteur d'activité
**Contexte**
Analyser la distribution des ressources par secteur d'activité des entreprises.

**Tâche**
Afficher :
- Secteur d'activité
- Nombre d'entreprises dans ce secteur
- Nombre total de ressources
- Quantité moyenne par entreprise

**Contraintes**
- Jointure entre Entreprises et Ressources
- `GROUP BY` sur secteur_activite
- Calculer : nombre d'entreprises (DISTINCT), ressources totales, quantité moyenne
- Trier par nombre de ressources décroissant

**Indice**
Utilisez `COUNT(DISTINCT entreprise.id)` pour compter les entreprises uniques.

**Résultat attendu**
Analyse sectorielle de la plateforme.

---

### Challenge 9 : Ressources avec classification de prix
**Contexte**
Classer les ressources selon leur prix : 'Économique' (<10), 'Moyen' (10-30), 'Premium' (>30).

**Tâche**
Afficher :
- Titre de la ressource
- Prix unitaire
- Classification (calculée avec CASE)
- Nom de la catégorie

**Contraintes**
- Jointure entre Ressources et Categories
- Utiliser `CASE WHEN` pour la classification
- Trier par prix décroissant

**Indice**
```sql
CASE 
    WHEN prix_unitaire < 10 THEN 'Économique'
    WHEN prix_unitaire BETWEEN 10 AND 30 THEN 'Moyen'
    ELSE 'Premium'
END AS classification
```

**Résultat attendu**
Liste des ressources avec leur gamme de prix.

---

### Challenge 10 : Statistiques globales de la plateforme
**Contexte**
Générer un tableau de bord avec les statistiques clés de la plateforme.

**Tâche**
Afficher en une seule requête :
- Nombre total d'entreprises
- Nombre d'entreprises validées
- Nombre total de ressources
- Nombre de ressources actives
- Prix moyen de toutes les ressources
- Quantité totale disponible

**Contraintes**
- Utiliser des sous-requêtes ou des agrégations sur différentes tables
- Peut nécessiter plusieurs SELECT combinés ou des sous-requêtes

**Indice**
Vous pouvez utiliser des sous-requêtes dans le SELECT pour calculer chaque statistique :
```sql
SELECT 
    (SELECT COUNT(*) FROM Entreprises) as total_entreprises,
    (SELECT COUNT(*) FROM Entreprises WHERE statut_validation = 'validee') as entreprises_validees,
    ...
```

**Résultat attendu**
Une ligne avec toutes les statistiques clés de la plateforme.

---

## Conclusion

Ces exercices permettent de maîtriser :
- ✅ Les jointures (INNER, LEFT)
- ✅ Le filtrage avancé (WHERE, HAVING)
- ✅ L'agrégation (COUNT, SUM, AVG)
- ✅ Le groupement (GROUP BY)
- ✅ Les colonnes calculées (CASE WHEN)
- ✅ Les sous-requêtes
- ✅ Le tri et la limitation (ORDER BY, LIMIT)

**Prochaine étape :**
- Transactions et verrouillage
- Indexation et optimisation
- Vues et procédures stockées
