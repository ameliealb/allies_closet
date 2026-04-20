# Allie's Closet 🐊

> Blog mode & forum communautaire — Projet de fin de formation DWFS, 3W Academy

---

## Présentation

**Allie's Closet** est un site web développé pour une cliente passionnée de mode. Elle combine un blog éditorial et un forum communautaire, le tout dans une direction artistique luxueuse et élégante (palette noire et dorée).

---

## Fonctionnalités

### Côté utilisateur
- Inscription / Connexion / Déconnexion sécurisée
- Consultation des articles par catégorie et recherche par mot-clé
- Système de likes sur les articles
- Commentaires sur les articles
- Participation au forum (topics & réponses imbriquées)
- Profil utilisateur personnalisable (avatar, description)
- Popup "produit du jour" alimenté par l'API Makeup

### Côté admin
- Dashboard d'administration
- Création, modification, archivage et suppression d'articles

Gestion des membres et gestion des commentaires à venir dans la V2.

### Pages statiques
- Page d'accueil
- Blog
- Forum
- À propos
- Contact
- Mentions légales
- Politique de confidentialité
- Règles du forum
- Pages d'erreur 403 et 404

---

## Stack technique

| Technologie | Usage |
|-------------|-------|
| PHP 8.1 | Backend, architecture MVC |
| MySQL | Base de données relationnelle |
| SCSS | Styles, mobile-first, mixins |
| JavaScript | Interactions DOM, API externe |
| HTML5 | Structure sémantique |
| Dotenv | Variables d'environnement |

---

## Architecture

Le projet suit une architecture **MVC** (Modèle - Vue - Contrôleur) :

```
allies_closet/
├── app/
│   ├── controllers/     # Logique métier
│   ├── models/          # Accès à la base de données
│   └── views/           # Templates PHP
│       ├── layouts/     # Header & Footer
│       ├── articles/    # Vues blog
│       ├── forum/       # Vues forum
│       ├── admin/       # Vues dashboard
│       ├── errors/      # Pages 403 & 404
│       └── legal/       # Pages légales
├── config/
│   ├── database.php     # Connexion PDO
│   └── routes.php       # Router (switch/case)
├── public/
│   ├── images/          # Images uploadées
│   ├── styles/          # CSS compilé
│   └── js/              # Scripts JS
├── vendor/              # Dépendances Composer
├── .env                 # Variables d'environnement (non versionné)
├── .htaccess            # Configuration Apache
└── index.php            # Point d'entrée
```

---

## Installation en local

### Prérequis
- PHP 8.1+
- MySQL
- Composer
- Serveur Apache (LAMP, WAMP, Docker...)
- Node.js + npm (pour compiler le SCSS)

### Étapes

**1. Cloner le dépôt**
```bash
git clone https://github.com/ton-username/allies_closet.git
cd allies_closet
```

**2. Installer les dépendances PHP**
```bash
composer install
```

**3. Configurer l'environnement**
```bash
cp .env.example .env
```
Remplir le fichier `.env` :
```env
DB_NAME="nom_de_ta_base"
DB_HOST="localhost"
DB_PORT="3306"
DB_LOGIN="ton_login"
DB_PASSWORD="ton_mot_de_passe"
MAIL_USER="ton@gmail.com"
MAIL_PASSWORD="ton_mot_de_passe_application"
```

**4. Importer la base de données**

Importer le fichier SQL fourni dans phpMyAdmin ou via la commande :
```bash
mysql -u root -p nom_de_ta_base < allies_closet.sql
```

**5. Compiler le SCSS**
```bash
cd public/styles
sass --watch sass/style.scss:css/style.css
```

**6. Configurer le BASE_URL**

Dans `index.php`, adapter selon ton environnement :
```php
define("BASE_URL", "/allies_closet"); // en local
// define("BASE_URL", "/amelie-bourdin/allies_closet"); // en prod
```

---

## Variables d'environnement

| Variable | Description |
|----------|-------------|
| `DB_NAME` | Nom de la base de données |
| `DB_HOST` | Hôte MySQL |
| `DB_PORT` | Port MySQL (3306 par défaut) |
| `DB_LOGIN` | Identifiant MySQL |
| `DB_PASSWORD` | Mot de passe MySQL |

---

## Base de données

Le projet utilise les tables suivantes :

| Table | Description |
|-------|-------------|
| `USER_` | Utilisateurs (membres et admin) |
| `ARTICLE` | Articles du blog |
| `COMMENTARY` | Commentaires sur les articles |
| `MESSAGE` | Topics et réponses du forum |
| `LIKE_` | Likes sur les articles |
| `SAVE_AS_FAVORITE` | Favoris (prévu) |
| `LIKING` | Likes sur les topics (prévu) |

---

## API externe

Le projet utilise l'**API Makeup** pour afficher un produit de beauté aléatoire chaque jour sur la page d'accueil :

```
https://makeup-api.herokuapp.com/api/v1/products.json
```

---

## Sécurité

- Mots de passe hashés avec `password_hash()` (bcrypt)
- Sessions PHP pour l'authentification
- Vérification du rôle admin sur chaque action sensible
- Protection contre les injections SQL via PDO et requêtes préparées
- Validation des données côté serveur
- Vérification `REQUEST_METHOD` sur les actions POST

---

## Axes d'amélioration

- Responsive mobile-first complet
- Système de likes sur les topics du forum
- Système de favoris sur les articles
- Notifications en temps réel
- Dashboard avec statistiques
- Déploiement avec HTTPS et optimisation des performances
- Accessibilité RGAA

---

## Auteure

**Bourdin Amélie** — Formation DWFS, 3W Academy  
Projet réalisé du 23 mars au 20 avril 2026

---

## Licence

Projet réalisé dans le cadre d'une formation professionnelle. Tous droits réservés.
