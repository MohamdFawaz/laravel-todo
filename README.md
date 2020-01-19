# LaravelTODO

This project was generated with [Laravel](https://laravel.com/) version 6.9.0.
This is a backend todo system for listing and storing tasks using 
[React TODO](https://github.com/MohamdFawaz/react-todo) as a frontend and mysql as DB engine.

## How to Setup

To get this system working you have to have the following prerequisites installed:
[PHP](https://www.php.net/),
[Composer](https://getcomposer.org/)

Once cloned run create a database in mysql with related name e.g. laravel_todo,

Take a copy of .env.example into .env file and replace the following with your created database info:

`DB_CONNECTION=mysql
 DB_HOST=127.0.0.1
 DB_PORT=5432
 DB_DATABASE=laravel_todo
 DB_USERNAME=root
 DB_PASSWORD=
`

After doing so, run `php artisan migrate` to create the tables in database.

Also you'll need to install all the dependencies using `composer install` 

## Running the Server

Run `php artisan serve` for a dev server. Navigate to `http://localhost:800/`.
If everything is installed correctly you should be able to see laravel welcome screen

