<?php

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

if (!function_exists('session_flush')) {
    /**
     * @param string|array $keys
     * @return void
     */
    function session_flush($keys = null) : void
    {
        if(is_string($keys) && !empty($_SESSION[$keys])) {
            unset($_SESSION[$keys]);
        } else if(is_array($keys)) {
            foreach($keys as $key) {
                if(!empty($_SESSION[$key])) {
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

if (!function_exists('pdf')) {
    /**
     * @return \SlimDatalayer\App\Services\PDF
     */
    function pdf(string $filename = 'document.pdf', string $paper = 'A4', string $orientation = 'portrait', $options = null): \App\Services\PDF
    {
        return new \App\Services\PDF($filename, $paper, $orientation, $options);
    }
}

if(!function_exists('response')) {
    /**
     * @return \App\Services\Response
     */
    function response() : \App\Services\Response
    {
        return slim()->getContainer()->get('response');
    }
}

if(!function_exists('redirect')) {
    /**
     * @return \App\Services\Redirect
     */
    function redirect() : \App\Services\Redirect
    {
        return slim()->getContainer()->get('redirect');
    }
}

if(!function_exists('event')) {
    /**
     * @return \League\Event\Emitter
     */
    function event() : \League\Event\Emitter
    {
        return slim()->getContainer()->get('emitter');
    }
}