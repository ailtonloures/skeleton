<?php
namespace App\Services\Api;

use Slim\Http\Request;
use App\Services\Api\Response;
use App\Services\Api\APIViewInterface;

abstract class APIView implements APIViewInterface
{   
    public function asView(
        Request $request,
        Response $response
    ): mixed {
        $method = strtolower($request->getMethod());

        return $this->$method($request, $response);
    }

    public function delete(
        Request $request,
        Response $response
    ): Response {
        return $response;
    }

    public function get(
        Request $request,
        Response $response
    ): Response {
        return $response;
    }

    public function post(
        Request $request,
        Response $response
    ): Response {
        return $response;
    }

    public function put(
        Request $request,
        Response $response
    ): Response {
        return $response;
    }
}
