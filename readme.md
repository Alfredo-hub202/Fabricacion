Requirements
 "require": {
        "php": "^7.1.3",
        "fideloper/proxy": "^4.0",
        "laravel/framework": "5.7.*",
        "laravel/tinker": "^1.0"
    },

Download
First, clone project:

# clone
git clone https://github.com/Alfredo-hub202/Fabricacion.git

# Access project
cd  Project

Config

# Install dependencies
composer install

# Create file .env
cp .env.example .env

# Generate key
php artisan key:generate

# Generate Migrations
php artisan migrate


# Generate Fatories
php artisan tinker

# Generate Fatories
php artisan tinker

# Create a User
factory('App\User')->create()

# Exit
exit()

# Create Server
php artisan serve

# Access project
http://localhost:8080

--------------------- VUEJS -----------------------------------

# VUE - 
Npm Install

# Run  

npm run watch
