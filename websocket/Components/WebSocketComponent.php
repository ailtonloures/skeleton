<?php
namespace WebSocket\Components;

use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\WebSocket\MessageComponentInterface;
use SplObjectStorage;

class WebSocketComponent implements MessageComponentInterface
{
    /** @var SplObjectStorage $connections */
    private $connections;

    public function __construct()
    {
        $this->connections = new SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        echo "Connected!\n";

        $this->connections->attach($conn);
    }

    public function onClose(ConnectionInterface $conn)
    {
        echo "Connection closed\n";

        $this->connections->detach($conn);
    }

    public function onError(ConnectionInterface $conn, Exception $e)
    {
        echo "Error: {$e->getTraceAsString()}";

        $this->connections->detach($conn);
    }

    public function onMessage(ConnectionInterface $from, MessageInterface $msg)
    {
        foreach ($this->connections as $conn) {
            if ($conn !== $from) {
                $conn->send((string) $msg);
            }
        }
    }
}
