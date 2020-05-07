<?php

if (!function_exists('first')) {
    /**
     * @param array $param
     * @return string|integer|float|boolean|null
     */
    function first(array $param)
    {
        if (!empty($param)) {
            return $param[0];
        }
    }
}

if (!function_exists('last')) {
    /**
     * @param array $param
     * @return string|integer|float|boolean|null
     */
    function last(array $param)
    {
        if (!empty($param)) {
            return $param[count($param) - 1];
        }
    }
}

if (!function_exists('url')) {
    /**
     * @param string $path
     * @return null|string
     */
    function url(string $path = null): ?string
    {
        return getenv("APP_HOST") != null ? getenv("APP_HOST") . "{$path}" : null;
    }
}

if (!function_exists('flash')) {
    /**
     * @param string $key
     * @param mixed $value
     * @return null|mixed
     */
    function flash(string $key, $value = null)
    {
        if (!empty($value)) {
            $_SESSION[$key] = $value;
            return;
        }

        if (isset($_SESSION[$key]) && $flash = $_SESSION[$key]) {
            unset($_SESSION[$key]);
            return $flash;
        }

        return null;
    }
}

if (!function_exists('session')) {
    /**
     * @param string $key
     * @param mixed $value
     * @return null|mixed
     */
    function session(string $key, $value = null)
    {
        if (!empty($value)) {
            $_SESSION[$key] = $value;
            return;
        }

        if (isset($_SESSION[$key]) && $session = $_SESSION[$key]) {
            return $session;
        }

        return null;
    }
}

if (!function_exists('notification')) {
    /**
     * @return \App\Services\Notification
     */
    function notification(): \App\Services\Notification
    {
        return new \App\Services\Notification;
    }
}

if (!function_exists('mailer')) {
    /**
     * @return \App\Services\Mail
     */
    function mailer(): \App\Services\Mail
    {
        return new \App\Services\Mail;
    }
}

if (!function_exists('pdf')) {
    /**
     * @return \SlimDatalayer\App\Services\PDF
     */
    function pdf(string $filename = 'document.pdf', string $paper = 'A4', string $orientation = 'portrait', $options = null): \App\Services\PDF
    {
        return new \App\Services\PDF($filename, $paper, $orientation, $options);
    }
}