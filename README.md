# Prevention

The project, codenamed ACP, consists of the development of a SaaS service for training driving professionals.

## First installation of the project

This section covers the first installation of the project, including the setup of various components and dependencies.

### installation of LARAVEL

`composer create-project laravel/laravel`  

### installation of BREEZE
Authentication starter kit

`php artisan breeze:install`

### installation of VUE

`npm install vue@latest vue-router@4`

### installation of TYPE SCRIPT

`npm add typescript`

### installation of DEBUGBAR

`composer require barryvdh/laravel-debugbar --dev`

from the projet : https://github.com/barryvdh/laravel-debugbar.git

### installation LARAVEL IDE HELPER GENERATOR  

`composer require --dev barryvdh/laravel-ide-helper`

from the projet : https://github.com/barryvdh/laravel-ide-helper.git



## Project Installation in Development Environment

This section describes the steps required to install the project in a development environment. It is important to note that the project uses a Gitflow architecture for better organization. This means that development is done on a dedicated branch and production updates are merged onto another branch.  

#### Clone the project on develop branch

`git clone https://gitlab.com/mobility-service-provider/prestations/acp/prevention/-/tree/develop`

#### Install the composer dependencies

`composer install`

#### Create the .env file and configure database access for mariadb

`DB_CONNECTION=mysql`  
`DB_HOST=127.0.0.1`  
`DB_PORT=3306`  
`DB_DATABASE=prevention`  
`DB_USERNAME=`  
`DB_PASSWORD=`

#### Create the database ACPreventionDB by running the sql command

`CREATE DATABASE prevention;`

#### Run the migrations to create the database tables

`php artisan migrate`

#### Run actual data

`php artisan create:all`  

This command launches all the commands to add the data to the database

Simple command can be issued like this

`php artisan create:objects`

With one of the following parameters:  `vehicles`, `users`, `themes`, `roles`, `progress`, `offers`, `evaluations`, `criteria`, `courses`, `companies`,`features`,`centers`.


#### Generate test objects

`php artisan db:seed` 

this will run all test objects 

#### Generate a unique application key

`php artisan key:generate`

#### Install Vite

`npm install -g vite`

#### Run the project in development mode on port: 5173

`npm run dev`

#### Start the local server on port:8000

`php artisan serve`

Now Server running on http://127.0.0.1:8000



