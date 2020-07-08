<?php

namespace App\Providers;

use App\Providers\EventProvider;
use App\Services\Redirect;
use App\Services\Response;
use League\Event\Emitter;
use Slim\App;
use Slim\Container;
use Slim\Handlers\Strategies\RequestResponseArgs;
use Slim\Views\PhpRenderer;
use Tuupola\Middleware\CorsMiddleware;
use Tuupola\Middleware\JwtAuthentication;

final class SlimProvider extends App
{
    public function __construct()
    {
        parent::__construct($this->config());

        $this->middlewares();
    }

    /**
     * @return array
     */
    private function config(): array
    {
        return [
            'settings'     => [
                'displayErrorDetails'    => ($_SERVER["SERVER_NAME"] == "localhost") ? getenv('DISPLAY_ERROR_DETAILS') : false,
                'addContentLengthHeader' => getenv('ADD_CONTENT_LENGTH_HEADER'),
            ],
            'foundHandler' => function () {
                return new RequestResponseArgs();
            },
            'view'         => function () {
                $view = new PhpRenderer(__DIR__ . '/../../templates/views/');
                $view->setLayout('index.phtml');

                return $view;
            },
            'response'     => function () {
                $response = new Response;

                return $response;
            },
            'redirect'     => function (Container $container) {
                $redirect = new Redirect($container->get('response'));

                return $redirect;
            },
            'emitter'      => function () {
                $emitter = new Emitter;
                $emitter->useListenerProvider(new EventProvider);

                return $emitter;
            },
        ];
    }

    /**
     * @return void
     */
    private function middlewares(): void
    {
        $this->add(new JwtAuthentication($this->auth_api()));
        $this->add(new CorsMiddleware($this->cors()));
    }

    /**
     * @return array
     */
    private function cors(): array
    {
        return [
            "origin"         => "*",
            "methods"        => ["GET", "POST", "PUT", "PATCH", "DELETE"],
            "headers.allow"  => ["Authorization", "Content-Type"],
            "headers.expose" => [],
            "credentials"    => true,
            "cache"          => 0,
        ];
    }

    /**
     * @return array
     */
    private function auth_api(): array
    {
        return [
            "path"      => [], // Irá validar tudo a parrtir desta rota
            "ignore"    => [], // Irá ignorar a validação de tudo a partir desta rota
            "secret"    => getenv('JWT_SECRET_KEY'),
            "attribute" => "jwt",
            "error"     => function ($response) {
                return $response->withStatus(401);
            },
        ];
    }
}
