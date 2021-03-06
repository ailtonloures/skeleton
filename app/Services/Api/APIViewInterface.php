<?php
namespace App\Services\Api;

use App\Services\Utils\Response;
use Slim\Http\Request;

interface APIViewInterface
{
    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function get(Request $request, Response $response);

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function post(Request $request, Response $response);

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function put(Request $request, Response $response);

    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function delete(Request $request, Response $response);
}
