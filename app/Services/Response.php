<?php

namespace App\Services;

use Slim\Http\Response as HttpResponse;
use Slim\Views\PhpRenderer;

class Response extends HttpResponse
{
    /** @var PhpRenderer */
    private $view;

    /** @var array */
    private $data;

    /**
     * @param PhpRenderer $view
     * @return Response
     */
    public function setViewer(PhpRenderer $view) : Response
    {
        $this->view = $view;
        return $this;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return Response
     */
    public function addData(string $key, $value) : Response
    {
        $this->data[$key] = $value;
        return $this;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getData(string $key = null)
    {
        return !empty($key) ? $this->data[$key] : $this->data;
    }

    /**
     * @param string $path
     * @param array $data
     * @return HttpResponse
     */
    public function view(string $path, array $data = []): HttpResponse
    {   
        return $this->view->render($this, "{$path}.phtml", array_merge($data, $this->data ?? []));
    }

    /**
     * @param string $path
     * @param array $data
     * @return mixed
     */
    public function content(string $path, array $data = [])
    {
        return $this->view->fetch("{$path}.phtml", array_merge($data, $this->data ?? []));
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
