<?php
namespace App\Services\Api;

use Slim\Http\Request;
use App\Services\Api\Response;

interface APIViewInterface
{   
    /**
     * Delete Http function
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function delete(
        Request $request,
        Response $response
    ): Response;

    /**
     * Get Http function
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function get(
        Request $request,
        Response $response
    ): Response;

    /**
     * Post Http function
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function post(
        Request $request,
        Response $response
    ): Response;

    /**
     * Put Http function
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function put(
        Request $request,
        Response $response
    ): Response;
}
