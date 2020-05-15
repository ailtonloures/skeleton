<?php

namespace App\Services;

use Slim\Container;
use App\Services\Response;

class Redirect 
{  
    /** @var Response */
    private $response;

    public function __construct(Container $container)
    {
        $this->response = $container->get('response');
    }

    /**
     * @param string $path
     * @param integer $code
     * @return Response
     */
    public function url(string $path, array $params = [], int $code = 302): Response
    {
        if (!empty($params)) {
            $path .= "?" . http_build_query($params);
        }

        return $this->response->withRedirect($path, $code);
    }
}
