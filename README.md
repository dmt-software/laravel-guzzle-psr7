# Laravel Guzzle PSR 7

Enable Guzzle Http Client to act as provider for PSR-7 compliant ServerRequestInterface instances in Laravel.

## Installation
```
composer require dmt-software/laravel-guzzle-psr7
```

The service provider maybe automatically registered by auto-discovery. To register it manually add is to 
_config/app.php:   

```php
'providers' => [
    DMT\Laravel\Providers\GuzzlePsrServiceProvider::class,
    // ...
];

```

## Usage 

```
use Psr\Http\Message\ServerRequestInterface;
 
Route::get('/', function (ServerRequestInterface $request) {
    // 
});
```