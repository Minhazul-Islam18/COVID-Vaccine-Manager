

## Tech stack

[Laravel](https://laravel.com) for backend, [React](https://react.dev) for frontend and [Inertia](https://inertiajs.com) for "glueing" them together. 
For the frontend React UI components, the awesome [Mantine](https://mantine.dev) library was used.

## Setup

### Project

1. Clone the repository using `git clone https://github.com/Minhazul-Islam18/COVID-Vaccine-Manager.git`
2. Cd into the project
3. Install npm dependencies with `npm install`
4. Copy the `.env` file with `cp .env.example .env`
5. Install composer dependencies with `composer install`
6. Create an empty database for the application
7. Generate an app encryption key with `php artisan key:generate`
8.  In the `.env` file, add database credentials to allow Laravel to connect to the database (variables prefixed with `DB_`)
9. Migrate the database with `php artisan migrate --seed`
10. Lastly, Run `php artisan serve` & `npm run dev` in different terminal.

### Admin user

New admin user will be created after running migrations with seed.

email: `admin@mail.com`

password: `password`
