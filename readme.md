## Diceware

[![Build Status](https://travis-ci.org/tecnom1k3/diceware.svg?branch=features%2Fdevelop)](https://travis-ci.org/tecnom1k3/diceware)
[![Coverage Status](https://coveralls.io/repos/tecnom1k3/diceware/badge.svg)](https://coveralls.io/r/tecnom1k3/diceware)

#Install
- Create an `.env` file in root directory, use `.env.example` as a boilerplate.  in the file make sure you have the key `DB_CONNECTION=sqlite` and `DB_DATABASE=storage/app/database.sqlite`.
- Create a `database.sqlite`, you can copy/rename the file `storage/app/database.sqlite.dist` which already has the laravel migrations table installed.
- Run `composer install` to install dependencies
- If you did not copied/renamed the `storage/app/database.sqlite.dist` file and created an empty `storage/app/database.sqlite` file by your own, please run `php artisan migrate:install` to install the migration table
- Run `php artisan migrate` to create the persistence infraestructure
