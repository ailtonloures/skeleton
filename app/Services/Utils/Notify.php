<?php

namespace App\Services\Utils;

use Pusher\Pusher;

final class Notify
{
    /**
     * @return Pusher
     */
    public static function on(): Pusher
    {
        $options = [
            'cluster' => getenv('CLUSTER'),
            'useTLS'  => true,
        ];

        $pusher = new Pusher(
            getenv('AUTH_KEY'),
            getenv('SECRET'),
            getenv('APP_ID'),
            $options
        );

        return $pusher;
    }
}
