<?php

namespace DMT\Test\Laravel\Providers;

use DMT\Laravel\Providers\GuzzlePsrServiceProvider;
use GuzzleHttp\Psr7\ServerRequest;
use Orchestra\Testbench\TestCase;
use Psr\Http\Message\ServerRequestInterface;

class GuzzlePsrServiceProviderTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            GuzzlePsrServiceProvider::class
        ];
    }

    public function testRouteUsesGuzzlePsrServerRequest()
    {
        $this->app->router->get('/', function (ServerRequestInterface $request) {
            $this->assertInstanceOf(ServerRequest::class, $request);
        });

        $this->app->handle($this->app->make('request'));
    }
}
