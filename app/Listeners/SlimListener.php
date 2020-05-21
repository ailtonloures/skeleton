<?php

namespace App\Listeners;

use League\Event\AbstractListener;
use League\Event\EventInterface;

class ExampleListener extends AbstractListener
{
    /**
     * @param EventInterface $event
     * @param mixed $param
     * @return void
     */
    public function handle(EventInterface $event, $param = null)
    {}
}
