<?php
namespace App\Services;

use App\Services\APIViewInterface;
use Slim\Http\Request;

abstract class APIView implements APIViewInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function asView(Request $request)
    {
        $method = strtolower($request->getMethod());
        return $this->$method($request);
    }
}
