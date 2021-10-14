<?php

namespace App\Providers;

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
        # add listeners here...
    }
}
