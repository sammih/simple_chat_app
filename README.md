## Simple Chat App

The forthcoming chat application will be developed utilizing the Laravel framework, specifically integrating the Laravel Jetstream starter kit, Inertia stack, Vue 3, and, naturally, Tailwind CSS.

- [Laravel Installation](https://laravel.com/docs/10.x/installation).
- [Installing Jetstream](https://jetstream.laravel.com/installation.html).


## Create Chat-app project

After you have installed PHP and Composer, you may create a new Laravel project (Chat-app) via the Composer create-project command:

> - `composer create-project laravel/laravel chat-app`
> - `cd chat-app`



## Installing Jetstream

Laravel Jetstream is a beautifully designed application starter kit for Laravel and provides the perfect starting point for your next Laravel application. Jetstream provides the implementation for your application's login, registration, email verification, two-factor authentication, session management, API via <u>**[Laravel Sanctum](https://github.com/laravel/sanctum)**</u>, and optional team management features.

> - `composer require laravel/jetstream`


## Install Jetstream With Inertia Stack and Pest PHP

> - `php artisan jetstream:install inertia --pest`

## Finalizing The Installation 

> - `npm install`
> - `npm run build`
> - `php artisan migrate`

