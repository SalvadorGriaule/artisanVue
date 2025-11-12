# 🧰 artisanVue

[![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)
[![Vue.js](https://img.shields.io/badge/Vue.js-3.x-42b883?logo=vue.js&logoColor=white)](https://vuejs.org)
[![Vite](https://img.shields.io/badge/Vite-frontend-646CFF?logo=vite&logoColor=white)](https://vitejs.dev)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)
[![Build](https://img.shields.io/github/actions/workflow/status/SalvadorGriaule/artisanVue/ci.yml?label=Build&logo=github)](https://github.com/SalvadorGriaule/artisanVue/actions)
[![Issues](https://img.shields.io/github/issues/SalvadorGriaule/artisanVue)](https://github.com/SalvadorGriaule/artisanVue/issues)

---

## 📝 Description  

**artisanVue** est une plateforme dédiée à la vente de produits artisanaux ou locaux, avec création de profils vendeurs, ajout d’articles et avis acheteurs.

---

## 🚀 Fonctionnalités principales  

- ⚙️ Backend Laravel avec API RESTful  
- 🎨 Frontend en Vue 3 (Composition API + TypeScript)  
- ⚡ Compilation rapide via Vite  
- 🧩 Architecture modulaire (composants, stores, routes)  
- 🧪 Tests backend avec PHPUnit  
- 💅 Linting et formatage automatiques (ESLint / Prettier)  
- 🔐 Authentification intégrée (si implémentée)  
- 🗂️ Communication fluide entre backend et frontend  

---

## 🧠 Architecture du projet  

graph TD
    subgraph Backend (Laravel)
        A1[app/ ← contrôleurs, modèles] 
        A2[config/ & bootstrap/]
        A3[database/ ← migrations et seeders]
        A4[routes/ ← web & api]
        A5[tests/ ← PHPUnit tests]
        A6[artisan ← CLI entrypoint]
    end

    subgraph Frontend (Vue + Vite)
        B1[resources/js/ ← composants Vue, stores, routes]
        B2[resources/css/ ← styles]
        B3[package.json & pnpm-lock ← dépendances]
        B4[vite.config.ts ← config Vite]
    end

    subgraph Public & Env
        C1[public/ ← fichiers statiques, point d’entrée web]
        C2[.env.example ← variables d’environnement]
    end

    subgraph Shared & Tools
        D1[.editorconfig / .prettierrc / eslint.config.js]
        D2[composer.json & composer.lock ← dépendances PHP]
    end

    %% Relations
    C1 -->|serve| A1
    A1 --> A3
    A1 --> A4
    A1 --> A5
    B1 --> B4
    B3 --> B4
    B2 --> B1
    D2 --> A1
    D1 --> B1
    C2 --> A1
    C2 --> B1
    B1 -->|uses API| A4
    A4 -->|returns data| B1


---

## 🧩 Technologies utilisées  

| Domaine | Technologie |
|----------|--------------|
| **Backend** | PHP · Laravel |
| **Frontend** | Vue.js · TypeScript · Vite |
| **Base de données** | MySQL / PostgreSQL |
| **Tests** | PHPUnit |
| **Qualité de code** | ESLint · Prettier |
| **Gestion des dépendances** | Composer · npm / pnpm |

---

## ⚙️ Installation et configuration  

### 🧱 Prérequis  

- PHP >= 8.x  
- Composer  
- Node.js >= 18  
- npm ou pnpm  
- MySQL ou PostgreSQL

### 🪜 Étapes d’installation  

1. **Cloner le dépôt**  
   ```bash
   git clone https://github.com/SalvadorGriaule/artisanVue.git
   cd artisanVue
   ```
2. **Installer les dépendances backend**
   ```bash
   composer install
   ```
4. **Configurer les variables d’environnement**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
  Modifier le fichier .env et remplacer la partie connexion à la base de données par:
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=artisanVue
  DB_USERNAME=root
  DB_PASSWORD=
5. **Installer les dépendances frontend**
   ```bash
    npm install
   ```
6. **Exécuter les migrations**
   ```bash
   php artisan migrate
   ```
7. **Créer le lien pour stocker les images**
   ```bash
   php artisan storage:link
   ```
8. **Build l'applcation frontend**
   ```bash
   npm run build
   ```
9. **Lancer les serveurs de développement**
    ```bash
   composer run dev
   ```
    Accéder à l’application sur http://localhost:8000
