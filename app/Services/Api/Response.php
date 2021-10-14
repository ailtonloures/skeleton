<?php

namespace App\Services\Api;

use Slim\Http\Response as HttpResponse;

class Response extends HttpResponse
{
    /** @var array $data */
    private $data;

    /**
     * @param string $key
     * @param mixed $value
     * @return Response
     */
    public function addData(
        string $key,
        $value
    ): Response {
        $this->data[trim($key)] = $value;

        return $this;
    }

    /**
     * @param array|string|mixed $data
     * @param integer $code
     * @return Response
     */
    public function error(
        $data,
        int $code = 400
    ): Response {
        return $this->json(['error' => $data], $code);
    }

    /**
     * @param string $path
     * @param array $data
     * @return string
     */
    public function getContent(
        string $path,
        array $data = []
    ): string {
        return getContent(trim($path), array_merge($data, $this->data ?? []));
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getData(string $key = null)
    {
        return !empty($key) ? $this->data[trim($key)] : $this->data;
    }

    /**
     * @param array|string|mixed $data
     * @param integer $code
     * @return Response
     */
    public function json(
        $data,
        int $code = 200
    ): Response {
        return $this->withStatus($code)->withJson($data);
    }

    /**
     * @param string $path
     * @param array $data
     * @return Response
     */
    public function view(
        string $path,
        array $data = []
    ): Response {
        return view(trim($path), array_merge($data, $this->data ?? []));
    }
}
