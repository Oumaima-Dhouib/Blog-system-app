# Blog-system-app
Laravel/Bootstrap app pour un système de blog dans le cadre d'une tâche d'entretien pour le poste de Développeur Laravel - Création de modules et conception responsive.


# prérequis
La version du PHP doit d'être >= 8.1

# Installation
# Cloner le projet
git clone "https://github.com/Oumaima-Dhouib/Blog-system-app.git"
# Installez les dépendances
composer install
# Copiez le fichier d'environnement
Vous devrez copier le fichier .env.example pour créer un fichier .env qui contiendra la configuration spécifique à votre environnement local.
# Configuration de la base de données 
Ouvrez le fichier .env nouvellement créé et configurez les paramètres de votre base de données. Assurez-vous que les paramètres DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME et DB_PASSWORD correspondent à votre configuration locale.
# Générez une nouvelle clé d'application
php artisan key:generate
# Install NPM:
npm install
# Run NPM
npm run build
# Exécutez les migrations et les seeders
php artisan migrate --seed
# Lancez le serveur de développement
php artisan serve
# Se Connecter
email: admin@gmail.com &
mot de passe: password
