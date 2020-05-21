<?php

namespace App\Providers;

use App\Listeners\ExampleListener;
use League\Event\ListenerAcceptorInterface;
use League\Event\ListenerProviderInterface;

class EventProvider implements ListenerProviderInterface
{
    /**
     * @param ListenerAcceptorInterface $acceptor
     * @return void
     */
    public function provideListeners(ListenerAcceptorInterface $acceptor)
    {
        $acceptor->addListener('event', new ExampleListener);
    }
}
