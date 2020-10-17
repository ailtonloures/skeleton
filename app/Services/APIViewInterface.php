<?php
namespace App\Services;

use Slim\Http\Request;

interface APIViewInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function get(Request $request);

    /**
     * @param Request $request
     * @return mixed
     */
    public function post(Request $request);

    /**
     * @param Request $request
     * @return mixed
     */
    public function put(Request $request);

    /**
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request);
}
