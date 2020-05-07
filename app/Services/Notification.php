<?php

namespace App\Services;

use Pusher\Pusher;

final class Notification extends Pusher
{
    public function __construct()
    {
        $options = [
            'cluster' => getenv('CLUSTER'),
            'useTLS'  => true,
        ];

       parent::__construct(getenv('AUTH_KEY'), getenv('SECRET'), getenv('APP_ID'), $options);
    }
    
}