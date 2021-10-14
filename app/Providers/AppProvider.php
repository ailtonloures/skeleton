<?php

namespace App\Providers;

use Slim\App;
use Slim\Container;
use League\Event\Emitter;
use Slim\Views\PhpRenderer;
use App\Services\Api\Response;
use App\Providers\EventProvider;
use App\Services\Utils\Redirect;
use Tuupola\Middleware\CorsMiddleware;
use Tuupola\Middleware\JwtAuthentication;
use Slim\Handlers\Strategies\RequestResponseArgs;

final class AppProvider extends App
{
    /**
     * @return mixed
     */
    public function __construct()
    {
        parent::__construct(
            [
                'settings'     => [
                    'displayErrorDetails'    => getenv('APP_ENV') != 'prod' ? true : false,
                    'addContentLengthHeader' => getenv('APP_ENV') != 'prod' ? true : false,
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
                    $response = new Response();

                    return $response;
                },
                'redirect'     => function (Container $container) {
                    $redirect = new Redirect($container->get('response'));

                    return $redirect;
                },
                'emitter'      => function () {
                    $emitter = new Emitter();
                    $emitter->useListenerProvider(new EventProvider());

                    return $emitter;
                },
            ]
        );

        $this->middlewares();
    }

    /**
     * @return void
     */
    private function middlewares(): void
    {
        // Jwt
        $this->add(
            new JwtAuthentication(
                [
                    'path'      => [], // Irá validar tudo a parrtir desta rota
                    'ignore'    => [], // Irá ignorar a validação de tudo a partir desta rota
                    'secret'    => getenv('JWT_SECRET_KEY'),
                    'attribute' => 'jwt',
                    'secure'    => false,
                    'error'     => function ($response) {
                        return $response->withStatus(401);
                    },
                ]
            )
        );

        // Cors
        $this->add(
            new CorsMiddleware(
                [
                    'origin'         => '*',
                    'methods'        => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],
                    'headers.allow'  => ['Authorization', 'Content-Type'],
                    'headers.expose' => [],
                    'credentials'    => true,
                    'cache'          => 0,
                ]
            )
        );
    }
}
