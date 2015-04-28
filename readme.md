## Diceware

[![Build Status](https://travis-ci.org/tecnom1k3/diceware.svg)](https://travis-ci.org/tecnom1k3/diceware)

#Install
create an `.env` file in root directory, use `.env.example` as a boilerplate.  in the file make sure you have the key `DB_CONNECTION=sqlite` and `DB_DATABASE=storage/app/database.sqlite`.  create the sqlite file!!

run `composer install` to install dependencies

run `php artisan migrate:install` to install the migration table

run `php artisan migrate` to create the persistence infraestructure
