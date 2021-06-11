<?php

namespace App\Services\Utils;

use App\Services\Response;

class Redirect
{
    /** @var Response $response */
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @param string $path
     * @param array $params
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
