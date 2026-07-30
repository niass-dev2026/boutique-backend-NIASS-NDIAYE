# Gestion de boutique — Backend (Laravel)

Projet réalisé dans le cadre de l'examen CCP 2026, par **Aïssatou Niass** et **Birame Ndiaye**.

## Stack technique
- Laravel 12
- MySQL
- API REST + Swagger (L5-Swagger)
- Blade (Laravel Breeze pour l'authentification)

## Installation

### 1. Cloner le dépôt
```bash
git clone https://github.com/niass-dev2026/boutique-backend-NIASS-NDIAYE.git
cd boutique-backend-NIASS-NDIAYE
```

### 2. Installer les dépendances
```bash
composer install
npm install
```

### 3. Configurer l'environnement
Copier `.env.example` en `.env` :
```bash
cp .env.example .env
```

Configurer la base de données dans `.env` :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=boutique_ccp2026
DB_USERNAME=root
DB_PASSWORD=
```

Créer la base de données `boutique_ccp2026` (via phpMyAdmin ou en ligne de commande MySQL), puis générer la clé d'application :
```bash
php artisan key:generate
```

### 4. Lancer les migrations et le seeder
```bash
php artisan migrate --seed
```

### 5. Compiler les assets et lancer le serveur
```bash
npm run build
php artisan serve
```

L'application est accessible sur `http://127.0.0.1:8000`.

## Comptes de test

| Rôle | Email | Mot de passe |
|------|-------|---------------|
| Admin | admin@boutique.com | password123 |
| Gestionnaire | gestionnaire@boutique.com | password123 |
| Employé | employe@boutique.com | password123 |

## URLs utiles

- Application web : `http://127.0.0.1:8000`
- API REST : `http://127.0.0.1:8000/api`
- Documentation Swagger : `http://127.0.0.1:8000/api/documentation`

## Fonctionnalités

- Authentification (connexion, inscription, déconnexion)
- Gestion des catégories, produits et acheteurs (CRUD), avec restrictions selon le rôle
- Enregistrement d'achats depuis la fiche d'un acheteur
- API REST documentée avec Swagger

## Présentation complète du projet

📄 [NIASS_NDIAYE_boutique.pdf](./NIASS_NDIAYE_boutique.pdf) — présentation des vues, de la documentation Swagger, des vues par rôle et des liens du projet.