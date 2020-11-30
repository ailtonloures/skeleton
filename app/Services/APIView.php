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

    public function get(Request $request, Response $response)
    { 
        # implements here 
    }

    public function post(Request $request, Response $response)
    { 
        # implements here 
    }

    public function put(Request $request, Response $response)
    { 
        # implements here 
    }

    public function delete(Request $request, Response $response)
    { 
        # implements here 
    }
}
