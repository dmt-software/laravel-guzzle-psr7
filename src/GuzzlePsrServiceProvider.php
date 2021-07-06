<?php

namespace DMT\Laravel\Providers;

use Http\Factory\Guzzle\ResponseFactory;
use Http\Factory\Guzzle\ServerRequestFactory;
use Http\Factory\Guzzle\StreamFactory;
use Http\Factory\Guzzle\UploadedFileFactory;
use Illuminate\Container\Container;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Bridge\PsrHttpMessage\HttpMessageFactoryInterface;

/**
 * Class GuzzlePsrServiceProvider
 */
class GuzzlePsrServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register(): void
    {
        $this->app->singleton(HttpMessageFactoryInterface::class, function () {
            return new PsrHttpFactory(
                new ServerRequestFactory(),
                new StreamFactory(),
                new UploadedFileFactory(),
                new ResponseFactory()
            );
        });

        $this->app->singleton(ServerRequestInterface::class, function (Container $app) {
            return $app->get(HttpMessageFactoryInterface::class)->createRequest($app->make('request'));
        });

        $this->app->singleton(ResponseInterface::class, function (Container $app) {
            return (new ResponseFactory())->createResponse();
        });
    }

    public function provides(): array
    {
        return [
            HttpMessageFactoryInterface::class,
            ServerRequestInterface::class,
            ResponseInterface::class
        ];
    }
}
