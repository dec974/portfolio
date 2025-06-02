# 🚀 Portfolio

Portfolio professionnel développé avec Symfony, permettant de présenter mes projets, compétences, soft skills, mon CV et de gérer le contenu via un back-office CMS personnalisé.

---

## Sommaire

- [Fonctionnalités](#fonctionnalités)
- [Stack technique](#stack-technique)
- [Installation](#installation)
- [Utilisation du CMS](#utilisation-du-cms)
- [Structure du projet](#structure-du-projet)
- [Déploiement](#déploiement)
- [Sécurité & accessibilité](#sécurité--accessibilité)
- [Roadmap](#roadmap)
- [Contact](#contact)

---

## Fonctionnalités

- Présentation de projets (grille filtrable, fiches détaillées, liens GitHub)
- Mise en avant des compétences techniques et soft skills
- Page CV web et téléchargement PDF
- Formulaire de contact sécurisé (reCAPTCHA)
- Thèmes sombre/clair
- Back-office CMS personnalisé pour gérer les contenus
- Synchronisation dynamique avec l’API GitHub pour les projets
- Responsive et accessible (RGAA 60%)

---

## Stack technique

- **Backend** : Symfony 7, Doctrine ORM, API Platform
- **Frontend** : Twig, Stimulus, CSS natif (Design System custom)
- **Base de données** : MySQL
- **Sécurité** : reCAPTCHA, NelmioSecurityBundle, gestion des rôles
- **Déploiement** : GitHub Actions, hébergement OVH

---

## Installation

1. **Cloner le dépôt**

    ```
    git clone https://github.com/ton-compte/portfolio.git
    cd portfolio
    ```

2. **Installer les dépendances**

    ```
    composer install
    npm install
    ```

3. **Configurer l’environnement**

    Copier `.env` en `.env.local` et adapter les variables (DB, reCAPTCHA, etc.) :

    ```
    DATABASE_URL="mysql://user:password@127.0.0.1:3306/portfolio"
    RECAPTCHA_SITE_KEY=xxx
    RECAPTCHA_SECRET_KEY=xxx
    ```

4. **Créer la base de données et lancer les migrations**

    ```
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    ```

5. **Lancer le serveur de développement**

    ```
    symfony serve
    # ou
    php -S localhost:8000 -t public
    ```

---

## Utilisation du CMS

- Accéder au back-office via `/admin` (EasyAdmin ou interface custom)
- Gérer : projets, compétences, blocs de contenu, médias, CV
- Créer des blocs personnalisés (texte, image, dynamique)
- Sélectionner les projets à mettre en avant sur l’accueil
- Modifier les compétences et soft skills via l’interface dédiée

---

## Structure du projet

