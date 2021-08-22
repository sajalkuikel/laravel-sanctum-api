Notes: 

Autogenerate methos for controllers : 


```sh
php artisan make:model  Product -m -c --api
```


Sanctum setup :

```
composer require laravel/sanctum

php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

php artisan migrate
```


In kernel.php


```
'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],
```
