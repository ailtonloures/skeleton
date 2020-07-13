<?php

namespace App\Services;

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
    public function addData(string $key, $value): Response
    {
        $this->data[trim($key)] = $value;
        return $this;
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
     * @param string $path
     * @param array $data
     * @return Response
     */
    public function view(string $path, array $data = []): Response
    {
        return view(trim($path), array_merge($data, $this->data ?? []));
    }

    /**
     * @param string $path
     * @param array $data
     * @return mixed
     */
    public function getContent(string $path, array $data = [])
    {
        return getContent(trim($path), array_merge($data, $this->data ?? []));
    }

    /**
     * @param array|string|mixed $data
     * @param integer $code
     * @return Response
     */
    public function json($data, int $code = 200): Response
    {
        return $this->withStatus($code)->withJson($data);
    }

    /**
     * @param array|string|mixed $data
     * @param integer $code
     * @return Response
     */
    public function error($data, int $code = 400): Response
    {
        return $this->json(['error' => $data], $code);
    }
}
