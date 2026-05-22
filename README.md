# Portfolio Backend - Benjamin BEUGNARE

Backend de mon portfolio personnel developpe avec Laravel 12 et Filament.

## A propos

Ce projet est le coeur de mon portfolio. Il gere toutes les donnees affichees sur le site : projets, competences, experiences, articles de blog, temoignages et messages de contact.

## Technologies utilisees

- **Laravel 12** - Framework PHP
- **Filament 3** - Interface d'administration
- **MySQL** - Base de donnees
- **Laravel Sanctum** - Authentification API

## Fonctionnalites

- API RESTful pour le frontend
- Backoffice complet pour gerer le contenu
- Gestion des medias (photos, CV)
- Notifications email lors des messages de contact
- Statistiques de visites

## Installation

bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
php artisan serve


## Auteur

**Benjamin BEUGNARE** - Ingenieur Informatique
- Email : bwadikabeugnare@gmail.com
- LinkedIn : https://shorturl.at/EughH
- GitHub : https://github.com/Benjamin2299