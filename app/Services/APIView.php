<?php
namespace App\Services;

use App\Services\APIViewInterface;
use App\Services\Response;
use Slim\Http\Request;

abstract class APIView implements APIViewInterface
{
    /**
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function asView(Request $request, Response $response)
    {
        $method = strtolower($request->getMethod());
        return $this->$method($request, $response);
    }
}
