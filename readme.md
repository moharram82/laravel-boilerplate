# Laravel Boilerplate

**Laravel boilerplate** is a Laravel project with simple admin panel featuring user roles & permissions management.

## Requirements
This application uses Laravel 8 framework so its requirements are the same of laravel 8:
- PHP >= 7.3
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- MySQL >= 5.7.8 (for json fields)

## Installation
- Clone the repository `git clone https://github.com/moharram82/laravel-boilerplate.git`
- Run `composer install`
- Run `npm install`
- Run `npm run dev`
- Rename `.env.example` file to `.env`
- Update `.env` file to reflect your environment and database settings
- Run `php artisan key:generate`
- Run migrations `php artisan migrate:refresh --seed`

## Login Info
- To login to the application as an `Admin` use (moharram82@hotmail.com) and password (12345678).
- Check `database/seeders/UsersTableSeeder.php` for accounts details.
- All accounts have the same password of (12345678).
