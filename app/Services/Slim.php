<?php

namespace App\Services;

use App\Services\Response;
use Slim\App;
use Slim\Container;
use Slim\Handlers\Strategies\RequestResponseArgs;
use Slim\Views\PhpRenderer;
use Tuupola\Middleware\CorsMiddleware;
use Tuupola\Middleware\JwtAuthentication;

final class Slim extends App
{
    public function __construct()
    {
        parent::__construct($this->config());

        /*
        /-----------------------
        /
        / Middlewares globais serão adicionadas aqui
        /
        /-----------------------
         */
        $this->add(new JwtAuthentication($this->jwt())); // Verifica se o Token é válido
        $this->add(new CorsMiddleware($this->cors())); // Valida o CORS da requisição
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
            'response'     => function (Container $container) {
                $response = new Response;
                $response->setViewer($container->get('view'));

                return $response;
            },            
            'redirect'     => function (Container $container) {
                $redirect = new Redirect($container);

                return $redirect;
            },
        ];
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
    private function jwt(): array
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
