
## Routes

```
# Public

GET   /api/products
GET   /api/products/{id}
GET   /api/products/search/{name}

POST   /api/login
@body: email, password

POST   /api/register
@body: name, email, password


# Protected

POST   /api/products
@body: name, description, price

PUT   /api/products/{id}
@body: ?name, ?description, ?price

DELETE  /api/products/{id}

POST    /api/logout
```


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

