<?php

if (!function_exists('path')) {
    /**
     * @return string
     */
    function path(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
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

if (!function_exists('session_flush')) {
    /**
     * @param string|array $keys
     * @return void
     */
    function session_flush($keys = null): void
    {
        if (is_string($keys) && !empty($_SESSION[$keys])) {
            unset($_SESSION[$keys]);
        } else if (is_array($keys)) {
            foreach ($keys as $key) {
                if (!empty($_SESSION[$key])) {
                    unset($_SESSION[$key]);
                }
            }
        }

        return;
    }
}

if (!function_exists('slim')) {
    /**
     * @return \App\Providers\SlimProvider
     */
    function slim(): \App\Providers\SlimProvider
    {
        return new \App\Providers\SlimProvider;
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

if (!function_exists('response')) {
    /**
     * @return \App\Services\Response
     */
    function response(): \App\Services\Response
    {
        return slim()->getContainer()->get('response');
    }
}

if (!function_exists('redirect')) {
    /**
     * @return \App\Services\Redirect
     */
    function redirect(): \App\Services\Redirect
    {
        return slim()->getContainer()->get('redirect');
    }
}

if (!function_exists('event')) {
    /**
     * @return \League\Event\Emitter
     */
    function event(): \League\Event\Emitter
    {
        return slim()->getContainer()->get('emitter');
    }
}

if (!function_exists('view')) {
    /**
     * @param string $path
     * @param array $data
     * @return \App\Services\Response
     */
    function view(string $path, array $data = null): \App\Services\Response
    {
        return slim()->getContainer()->get('view')->render(response(), "{$path}.phtml", $data);
    }
}

if (!function_exists('getContent')) {
    /**
     * @param string $path
     * @param array $data
     * @return string
     */
    function getContent(string $path, array $data = null): string
    {
        return slim()->getContainer()->get('view')->fetch("{$path}.phtml", $data);
    }
}
